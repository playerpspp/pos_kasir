<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\products;
use App\Models\in_transaction;
use App\Models\in_detail;
use App\Models\out_transaction;
use App\Models\out_detail;
use App\Exports\ProductsExport;
use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Facades\Excel;
use Dompdf\Dompdf;


class ProductController extends Controller
{
   public function __construct()
   {
    $this->middleware('auth');
    $this->middleware(function ($request, $next) {
    if (Auth::user()->level->level == "admin" && Auth::user()->level->level == "head") {
        abort(403, 'Unauthorized action.');
    }
     if (!Auth::check() ) {
        return redirect('/');
    }
    return $next($request);
});
}

public function index()
{

    $products = products::all();

    return view('product.products', ['products' => $products]);

}

public function show()
{

return view('product.input',);

}

public function input(Request $request)
{

    $validate = Validator::make($request->all(), [
        'name' => 'required|max:255',
        'code' => 'required|min:4|max:255',
        'price' => 'required|max:10',
    ]);
    if ($validate->fails())
    {
        $id= $request->id;
        return redirect("/products/input")
        ->withErrors($validate)
        ->withInput();
    }

    $product = new products();
    $product->name = $request->input('name');
    $product->code = $request->input('code');
    $product->price = $request->input('price');
    $product->worker_id = auth::user()->worker->id;
    $product->amount = 0;


    $product->save();

    return redirect('/products'); 


}

public function delete($id)
{

$product = new products();
products::where('id', $id)->delete();

return redirect('/products');



}

public function edit($id)
{

$product = products::where('id', $id)->first();

return view('product.edit', ['product' => $product]);


}

public function update(Request $request)
{
    
    $validate = Validator::make($request->all(), [
       'name' => 'required|max:255',
       'code' => 'required|min:4|max:255',
       'price' => 'required|max:10',
   ]);
    if ($validate->fails())
    {
        $id= $request->id;
        return redirect("/products/edit/{$id}")
        ->withErrors($validate)
        ->withInput();
    }

    $product = products::where('id', $request->id)
    ->update([
        'name' => $request->name,
        'code' => $request->code,
        'price' => $request->price,
    ]);

    return redirect('/products');


}

public function exportPdf()
{
    
    $start = request()->input('start_date');
    $end = request()->input('end_date');


    $transInIDs = in_transaction::where('created_at','>=',$start)
    ->where('created_at','<=',$end)
    ->pluck('id');

    $transIn = in_detail::select('product_id', 
        DB::raw('SUM(amount) as total_amount'),
        DB::raw('MIN(price) as min_price'),
        DB::raw('MAX(price) as max_price'))
    ->whereIn('transaction_id', $transInIDs)
    ->groupBy('product_id')
    ->orderBy('product_id', 'Asc')
    ->get()
    ->keyBy('product_id');

    $transOutIDs = out_transaction::where('created_at','>=',$start)
    ->where('created_at','<=',$end)
    ->pluck('id');

    $transOut = out_detail::select('product_id', 
        DB::raw('SUM(amount) as total_amount'),
        DB::raw('MIN(price) as min_price'),
        DB::raw('MAX(price) as max_price'))
    ->whereIn('transaction_id', $transOutIDs)
    ->groupBy('product_id')
    ->orderBy('product_id', 'Asc')
    ->get()
    ->keyBy('product_id');

    $products = products::all();
    $pdf = new Dompdf();
    $pdf->loadHtml(view('product.tes', compact('products','transIn','transOut','start','end')));
    $pdf->setPaper('A4', 'landscape');
    $pdf->render();
    $pdf->stream("Laporan Product.pdf", array("Attachment" => false));
}

public function exportExcel()
{
   
return Excel::download(new ProductsExport, 'Laporan Product.xlsx');
}


}