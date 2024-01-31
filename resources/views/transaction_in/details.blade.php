@include('head')

@include('nav')
<head>
    <title>Detail Book Income</title>
</head>
<div class="row">
    <div class="col-md-12">

        <button class="btn btn-primary" title="Back" onclick="history.back()">Back</button>
        @php
        $num = $id;
        $num = sprintf("%03d", $num);
        @endphp
        <div class="card">

            <div class="card-title">
                <h3 style="margin-left: 3px;">Detail #{{$num}} Book Income</h3>
            </div>
            <div class="card-body">


                <br>
                
                <div class="card-body">
                    <br>
                    <div class="bootstrap-data-table-panel ">
                    <div class="table-responsive">
                    <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th width="10px">no</th>
                                    <th width="1000px">name</th>
                                    <th width="1000px">Amount</th>
                                    <th width="1000px">price/book</th>
                                    <th width="1000px">Total Price</th>
                                </tr>
                            </thead>
                            @php
                            $no = 0;
                            $no++;
                            @endphp

                            <tbody>
                                @foreach ($detail as $detail)
                                <tr>
                                    <td width="10px">{{$no}}</td>
                                    <td>{{ $detail->books->name }}</td>
                                    <td>{{ $detail->total_amount}}</td>
                                    <td>{{ $detail->price}}</td>
                                    <td>{{ $detail->total_price }}</td>

                                </tr>
                                @php
                                $no++;
                                @endphp
                                @endforeach
                            </tbody>
                            <tr>
                                <td>total</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>{{$sum}}</td>
                            </tr>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@include('foot')