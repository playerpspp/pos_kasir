<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\books;
use App\Models\in_transaction;
use App\Models\in_detail;
use App\Models\out_transaction;
use App\Models\out_detail;
use App\Exports\BooksExport;
use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Facades\Excel;
use Dompdf\Dompdf;


class BookController extends Controller
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

        // retrieve books from database
    $books = books::all();

        // return view with books data
    return view('book.books', ['books' => $books]);

}

public function show()
{
   if (Auth::user()->level->level != "Admin" && Auth::user()->level->level != "head") {
    abort(403, 'Unauthorized action.');
}

return view('book.input',);

}

public function input(Request $request)
{
    if (Auth::user()->level->level != "Admin" && Auth::user()->level->level != "head") {
    abort(403, 'Unauthorized action.');
}

        // validate book input
    $validate = Validator::make($request->all(), [
        'name' => 'required|max:255',
        'code' => 'required|min:4|max:255',
        'price' => 'required|max:10',
    ]);
    if ($validate->fails())
    {
        $id= $request->id;
        return redirect("/books/input")
        ->withErrors($validate)
        ->withInput();
    }

        // create new book
    $book = new books();
    $book->name = $request->input('name');
    $book->code = $request->input('code');
    $book->price = $request->input('price');
    $book->worker_id = auth::user()->worker->id;
    $book->amount = 0;


    $book->save();

        // redirect to books list
    return redirect('/books'); 


}

public function delete($id)
{

   if (Auth::user()->level->level != "Admin" && Auth::user()->level->level != "head") {
    abort(403, 'Unauthorized action.');
}


$book = new books();
books::where('id', $id)->delete();

        // redirect to books list
return redirect('/books');



}

public function edit($id)
{
   if (Auth::user()->level->level != "Admin" && Auth::user()->level->level != "head") {
    abort(403, 'Unauthorized action.');
}


$book = books::where('id', $id)->first();

return view('book.edit', ['book' => $book]);


}

public function update(Request $request)
{
    if (Auth::user()->level->level != "Admin" && Auth::user()->level->level != "head") {
    abort(403, 'Unauthorized action.');
}


    $validate = Validator::make($request->all(), [
       'name' => 'required|max:255',
       'code' => 'required|min:4|max:255',
       'price' => 'required|max:10',
   ]);
    if ($validate->fails())
    {
        $id= $request->id;
        return redirect("/books/edit/{$id}")
        ->withErrors($validate)
        ->withInput();
    }

    $book = books::where('id', $request->id)
    ->update([
        'name' => $request->name,
        'code' => $request->code,
        'price' => $request->price,
    ]);

    return redirect('/books');


}

public function exportPdf()
{
    if (Auth::user()->level->level != "Admin" && Auth::user()->level->level != "head") {
    abort(403, 'Unauthorized action.');
}

    $start = request()->input('start_date');
    $end = request()->input('end_date');


    $transInIDs = in_transaction::where('created_at','>=',$start)
    ->where('created_at','<=',$end)
    ->pluck('id');

    $transIn = in_detail::select('book_id', 
        DB::raw('SUM(amount) as total_amount'),
        DB::raw('MIN(price) as min_price'),
        DB::raw('MAX(price) as max_price'))
    ->whereIn('transaction_id', $transInIDs)
    ->groupBy('book_id')
    ->orderBy('book_id', 'Asc')
    ->get()
    ->keyBy('book_id');

    $transOutIDs = out_transaction::where('created_at','>=',$start)
    ->where('created_at','<=',$end)
    ->pluck('id');

    $transOut = out_detail::select('book_id', 
        DB::raw('SUM(amount) as total_amount'),
        DB::raw('MIN(price) as min_price'),
        DB::raw('MAX(price) as max_price'))
    ->whereIn('transaction_id', $transOutIDs)
    ->groupBy('book_id')
    ->orderBy('book_id', 'Asc')
    ->get()
    ->keyBy('book_id');

    $books = books::all();
    $pdf = new Dompdf();
    $pdf->loadHtml(view('book.tes', compact('books','transIn','transOut','start','end')));
    $pdf->setPaper('A4', 'landscape');
    $pdf->render();
    $pdf->stream("Laporan Buku.pdf", array("Attachment" => false));
}

public function exportExcel()
{
   if (Auth::user()->level->level != "Admin" && Auth::user()->level->level != "head") {
    abort(403, 'Unauthorized action.');
}

return Excel::download(new BooksExport, 'Laporan Buku.xlsx');
}


}