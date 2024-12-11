<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\out_transaction;
use App\Models\out_detail;
use App\Models\products;
use Illuminate\Support\Facades\DB;
use App\Exports\OutDetailsExport;
use Maatwebsite\Excel\Facades\Excel;
use Dompdf\Dompdf;

class transaction_outController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Auth::check() ) {
                return redirect('/');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $out_transaction = out_transaction::all();
        

        return view('transaction_out.Transaction_out', ['out_transactions' => $out_transaction]);

        
    }

    public function show()
    {
        $products = products::all();

        return view('transaction_out.input', ['products' => $products]);


    }

    public function input(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'product' => 'required',
            'amount' => 'required|max:10',
        ]);
        if ($validate->fails())
        {
            return redirect("/transaction_out/input")
            ->withErrors($validate)
            ->withInput();
        }

        $products = request()->input('product');
        $amounts = request()->input('amount');
        $prices = [];

        foreach ($products as $key => $product) {
            $data= products::where('id', $product)->first();
            $prices[$key]=$data->price;
        }

        $totalPrices = 0;
        for($i = 0; $i < count($prices); $i++) {
            $totalPrices += $prices[$i] * $amounts[$i];
        }
        $transaction = new out_transaction;
        $transaction->price = $totalPrices;
        $transaction->worker_id = auth::user()->worker->id;
        $transaction->save();
        $trans_id = $transaction->id;
        
        foreach ($products as $key => $product) {
            DB::table('transaction_out_details')->insert([
                'transaction_id'=> $trans_id,
                'product_id' => $product,
                'price' => $prices[$key],
                'amount' => $amounts[$key],
            ]);
        }

        return redirect('/transaction_out');


        
    }

    public function delete($id)
    {

     if (Auth::user()->level->level == "admin" || Auth::user()->level->level == "head") {
        abort(403, 'Unauthorized action.');
    }

    out_transaction::where('id', $id)->delete();
    out_detail::where('transaction_id', $id)->delete();


    return redirect('/transaction_out');


}

public function detail($id)
{

    $detail =  out_detail::select('product_id', DB::raw('SUM(price) as total_price'), DB::raw('SUM(amount) as total_amount'))
    ->where('transaction_id', $id)
    ->groupBy('product_id')
    ->get();
    $sum = out_detail::select(DB::raw('SUM(price * amount) as total_sum'))
    ->where('transaction_id', $id)
    ->first()->total_sum;


    return view('transaction_out.details', ['detail' => $detail,'sum' => $sum,'id' =>$id]);

}

public function exportPdf(Request $request)
{

 if (Auth::user()->level->level == "admin" || Auth::user()->level->level == "head") {
    abort(403, 'Unauthorized action.');
}

$start = request()->input('start_date');
$end = request()->input('end_date');

$transactionIDs = out_transaction::where('created_at','>=',$start)
->where('created_at','<=',$end)
->pluck('id');

$details = out_detail::whereIn('transaction_id', $transactionIDs)
->get();

foreach ($details as $detail){
    $totalPrices[$detail->id] = $detail->price * $detail->amount;
}

$pdf = new Dompdf();
$pdf->loadHtml(view('transaction_out.pdf', compact('details', 'totalPrices','start','end')));
$pdf->setPaper('A4', 'landscape');
$pdf->render();
$pdf->stream("Laporan Penjualan.pdf", array("Attachment" => false));

}

public function exportExcel()
{ 
    if (Auth::user()->level->level == "admin" || Auth::user()->level->level == "head") {
        abort(403, 'Unauthorized action.');
    }

    $start = request()->input('start_date');
    $end = request()->input('end_date');

    $transactionID = out_transaction::where('created_at','>=',$start)
    ->where('created_at','<=',$end)
    ->pluck('id');

    return Excel::download(new OutDetailsExport($transactionID), 'Laporan Penjualan.xlsx');
}
}