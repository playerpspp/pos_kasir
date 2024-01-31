@include('head')

@include('nav')

<head>
    <title>>Detail Book Outcome</title>
    <link href="/css/lib/jsgrid/jsgrid-theme.min.css" rel="stylesheet" />
    <link href="/css/lib/jsgrid/jsgrid.min.css" type="text/css" rel="stylesheet" />
</head>
<div class="row">
    <div class="col-md-12">
        
        <a onclick="history.back()"><button class="btn btn-primary">
            Back
        </button></a>
        <div class="card">
            <div class="card-body">
                @php
                $num = $id;
                $num = sprintf("%03d", $num);
                @endphp

                <div class="card-title">
                    <h3 style="margin-left: 3px;">Detail #{{$num}} Book Outcome</h3>
                </div>

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
                                    <th width="1000px">Price</th>
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