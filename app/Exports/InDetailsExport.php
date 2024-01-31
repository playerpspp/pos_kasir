<?php

namespace App\Exports;

use App\Models\in_detail;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;


class InDetailsExport implements FromView

{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $transactionID;

    public function __construct($transactionID)
    {
        $this->transactionID = $transactionID;
    }

    public function view(): View
    {
        $details = in_detail::whereIn('transaction_id', $this->transactionID)
        ->get();

        foreach ($details as $detail){
            $totalPrices[$detail->id] = $detail->price * $detail->amount;
        }

        return view('transaction_in.excel', ['details' => $details, 'totalPrices' => $totalPrices]);
    }
}
