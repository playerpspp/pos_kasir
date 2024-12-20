<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\in_transaction;
use App\Models\in_detail;
use App\Models\products;
use Illuminate\Support\Facades\DB;
use App\Exports\InDetailsExport;
use Maatwebsite\Excel\Facades\Excel;
use Dompdf\Dompdf;


class transaction_inController extends Controller
{
 public function __construct()
 {
    $this->middleware('auth');
    $this->middleware(function ($request, $next) {
        if (!Auth::check() ) {
            return redirect('/');
        }
        return $next($request);
    });
}
public function index()
{


    $in_transaction = in_transaction::all();

    return view('transaction_in.Transaction_in', ['in_transactions' => $in_transaction]);

    
}

public function show()
{

    $products = products::all();

    return view('transaction_in.input', ['products' => $products]);


}

public function input(Request $request)
{
    $validate = Validator::make($request->all(), [
        'product' => 'required|max:255',
        'price' => 'required|max:10',
        'amount' => 'required|max:10',
    ]);
    if ($validate->fails())
    {
        return redirect("/transaction_in/input")
        ->withErrors($validate)
        ->withInput();
    }

    $products = request()->input('product');
    $prices = request()->input('price');
    $amounts = request()->input('amount');

    $totalPrices = 0;
    for($i = 0; $i < count($prices); $i++) {
        $totalPrices += $prices[$i] * $amounts[$i];
    }


    $transaction = new in_transaction;
    $transaction->price = $totalPrices;
    $transaction->worker_id = auth::user()->worker->id;
    $transaction->save();
    $trans_id = $transaction->id;

    foreach ($products as $key => $product) {
        DB::table('transaction_in_details')->insert([
            'transaction_id'=> $trans_id,
            'product_id' => $product,
            'price' => $prices[$key],
            'amount' => $amounts[$key],
        ]);
    }

    return redirect('/transaction_in');


    
}

public function delete($id)
{
   if (Auth::user()->level->level == "admin" && Auth::user()->level->level == "head") {
    abort(403, 'Unauthorized action.');
}

in_detail::where('transaction_id', $id)->delete();
in_transaction::where('id', $id)->delete();

return redirect('/transaction_in');


}

public function detail($id)
{


    $detail = in_detail::select('product_id', DB::raw('SUM(price * amount) as total_price'), DB::raw('SUM(amount) as total_amount'), DB::raw('SUM(price) as price'))
    ->where('transaction_id', $id)
    ->groupBy('product_id', 'price')
    ->get();
    $sum = in_detail::select(DB::raw('SUM(price * amount) as total_sum'))
    ->where('transaction_id', $id)
    ->first()->total_sum;


    return view('transaction_in.details', ['detail' => $detail,'sum' => $sum,'id' =>$id]);

}

public function exportPdf(Request $request)
{
   if (Auth::user()->level->level == "admin" && Auth::user()->level->level == "head") {
    abort(403, 'Unauthorized action.');
}
$start = request()->input('start_date');
$end = request()->input('end_date');
$transactionIDs = in_transaction::where('created_at','>=',$start)
->where('created_at','<=',$end)
->pluck('id');

$details = in_detail::whereIn('transaction_id', $transactionIDs)
->get();

foreach ($details as $detail){
    $totalPrices[$detail->id] = $detail->price * $detail->amount;
}

$pdf = new Dompdf();
$pdf->loadHtml(view('transaction_in.pdf', compact('details', 'totalPrices','start','end')));
$pdf->setPaper('A4', 'landscape');
$pdf->render();
$pdf->stream("Laporan Pemasukan.pdf", array("Attachment" => false));
}

public function exportExcel(Request $request)
{
   if (Auth::user()->level->level == "admin" && Auth::user()->level->level == "head") {
    abort(403, 'Unauthorized action.');
}
$start = $request->input('start_date');
$end = $request->input('end_date');
$transactionID = in_transaction::where('created_at','>=',$start)
->where('created_at','<=',$end)
->get('id');

return Excel::download(new InDetailsExport($transactionID), 'Laporan Pemasukan.xlsx');
}

}