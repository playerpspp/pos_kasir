<?php

namespace App\Exports;

use App\Models\books;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class BooksExport implements FromView

{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View

    {
       $books = books::all();
       return view('book.pdf', ['books' => $books]);
    }
}
