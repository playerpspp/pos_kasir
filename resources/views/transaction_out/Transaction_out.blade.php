@include('head')

@include('nav')

<head>
    <title>product Purchases Outcome Table</title>
    <link href="/css/lib/jsgrid/jsgrid-theme.min.css" rel="stylesheet" />
    <link href="/css/lib/jsgrid/jsgrid.min.css" type="text/css" rel="stylesheet" />
</head>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <div class="card-title">
                    <h3 style="margin-left: 3px;">product Purchases Outcome Table</h3>
                </div>

                <a style="margin-left: 5px;" href="/transaction_out/input"><button class="btn btn-success" title="Add new"><i class="ti-plus"></i></button></a>
                
                <div class="card-body">
                    <br>
                    <div class="bootstrap-data-table-panel ">
                    <div class="table-responsive">
                    <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th width="5%">no</th>
                                    <th width="1000px">Waktu</th>
                                    <th width="1000px">kode</th>
                                    <th width="1000px">Total Harga</th>
                                    <th width="1000px">Pembuat</th>
                                    <th width="1000px">action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no = 0;
                                $no++;
                                @endphp

                                @foreach ($out_transactions as $transaction)
                                @php
                                $num = $transaction->id;
                                $num = sprintf("%03d", $num);
                                @endphp
                                <tr>
                                    <td width="10px">{{$no}}</td>
                                    <td>{{ $transaction->created_at }}</td>
                                    <td>#{{$num}}</td>
                                    <td>RP {{ $transaction->price }}</td>
                                    @if(isset($transaction->worker->name))
                                    <td>{{ $transaction->worker->name }}</td>
                                    @else
                                    <td>unknown</td>
                                    @endif
                                    <td>
                                        <a href="/transaction_out/details/{{$transaction->id}}"><button class="btn btn-primary" title="Detail"><i class="ti-file"></i></button></a>
                                        @if(auth::user()->level->level != "pekerja")
                                        <a href="/transaction_out/actdelete/{{$transaction->id}}"><button class="btn btn-danger" title="Delete"><i class="ti-trash"></i></button></a>
                                        @endif
                                    </td>
                                </tr>
                                @php
                                $no++;
                                @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@include('foot')