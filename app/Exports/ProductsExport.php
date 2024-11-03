<?php

namespace App\Exports;

use App\Models\products;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class ProductsExport implements FromView

{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View

    {
       $products = products::all();
       return view('product.pdf', ['products' => $products]);
    }
}
