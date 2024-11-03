@include('head')

@include('nav')

<head>
    <title>Books Table</title>
    <link href="/css/lib/jsgrid/jsgrid-theme.min.css" rel="stylesheet" />
    <link href="/css/lib/jsgrid/jsgrid.min.css" type="text/css" rel="stylesheet" />
</head>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <div class="card-title">
                    <h3 style="margin-left: 3px;">Books Table</h3>
                </div>
                @if(auth::user()->level->level != "pekerja")
                <a style="margin-left: 5px;" href="/books/input"><button class="btn btn-success" title="Add new"><i class="ti-plus"></i></button></a>            
                @endif
                <div class="card-body">
                    <br>
                    <div class="bootstrap-data-table-panel ">
                    <div class="table-responsive">
                    <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>

                                <tr>
                                    <th width="10px">no</th>
                                    <th width="1000px">Name</th>
                                    <th width="1000px">Code</th>
                                    <th width="1000px">Amount</th>
                                    <th width="1000px">Price</th>
                                    <th width="1000px">Maker</th>
                                    <th width="1000px">action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no = 0;
                                $no++;
                                @endphp

                                @foreach ($books as $book)
                                <tr>
                                    <td width="10px">{{$no}}</td>
                                    <td>{{ $book->name }}</td>
                                    <td>{{ $book->code }}</td>
                                    <td>{{ $book->amount }}</td>
                                    <td>{{ $book->price }}</td>
                                    @if(isset($transaction->worker->name))
                                    <td>{{ $transaction->worker->name }}</td>
                                    @else
                                    <td>unknown</td>
                                    @endif
                                    <td>
                                        @if(auth::user()->level->level != "pekerja")
                                       <a href="/books/edit/{{$book->id}}"><button class="btn btn-warning" title="Detail"><i class="ti-pencil-alt"></i></button></a>

                                       <a href="/books/actdelete/{{$book->id}}"><button class="btn btn-danger" title="Delete"><i class="ti-trash"></i></button></a>
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