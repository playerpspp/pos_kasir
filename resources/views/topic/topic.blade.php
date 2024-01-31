@include('head')

@include('nav')

<head>
    <title>Ticket Topic Table</title>
    <link href="/css/lib/jsgrid/jsgrid-theme.min.css" rel="stylesheet" />
    <link href="/css/lib/jsgrid/jsgrid.min.css" type="text/css" rel="stylesheet" />
</head>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <div class="card-title">
                    <h4 style="margin-left: 3px;">Ticket Topic Table</h4>
                </div>

                <a style="margin-left: 5px;" href="/topics/input"><button class="btn btn-success" title="Add new"><i class="ti-plus"></i></button></a>            
                
                <div class="card-body">
                    <br>
                    <div class="bootstrap-data-table-panel ">
                    <div class="table-responsive">
                    <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>

                                <tr>
                                    <th width="10px">no</th>
                                    <th width="1000px">Topic</th>
                                    <th width="1000px">Department</th>
                                    <th width="1000px">Usage</th>
                                    <th width="1000px">action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no = 0;
                                $no++;
                                @endphp

                                @foreach ($topics as $topic)
                                <tr>
                                    <td width="10px">{{$no}}</td>
                                    <td>{{ $topic->name }}</td>
                                    <td>{{ $topic->department->name }}</td>
                                    @if (isset($use[$topic->id]))
                                    <td>{{ $use[$topic->id]->count }}</td>
                                    @else
                                    <td>0</td>
                                    @endif
                                    <td>
                                       <a href="/topics/edit/{{$topic->id}}"><button class="btn btn-warning" title="Detail"><i class="ti-pencil-alt"></i></button></a>
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