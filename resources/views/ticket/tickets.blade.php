@include('head')

@include('nav')
<head>
    <title>Tickets List</title>
    <link href="/css/lib/jsgrid/jsgrid-theme.min.css" rel="stylesheet" />
    <link href="/css/lib/jsgrid/jsgrid.min.css" type="text/css" rel="stylesheet" />
</head>


<div class="row">
    <div class="col-md-12">
        <div class="card">
        <div class="card-body">

         <div class="card-title">
            <h3 style="margin-left: 3px;">Tickets</h3><br>
            <a href="/tickets/input" class="btn btn-success btn-box"><i class="ti-plus"></i></a><br>
            
        </div>

        <div class="card-body"><br>
            <div class="bootstrap-data-table-panel ">
                    <div class="table-responsive">
                    <table id="bootstrap-data-table" class="table table-striped table-bordered">
                        <thead>
                <tr>
                    <th width="2%">No</th>
                    <th width="1000px">Sender</th>
                    <th width="1000px">Department</th>
                    <th width="1000px">Topic</th>
                    <th width="1000px">Priority</th>
                    <th width="1000px">Open Time</th>
                    <th width="1000px">Assign</th>
                    <th width="1000px">Status</th>
                    <th width="1000px">action</th>
                </tr>
                </thead>
                <tbody>

                @php
                $no = 0;
                @endphp


                @foreach ($tickets as $ticket)
                <tr>
                    <td width="10px">{{ $no++ }}</td>
                    <td>{{ $ticket->worker->name }}</td>
                    <td>{{ $ticket->department->name}}</td>

                    @if (isset($ticket->topic))
                    <td>{{ $ticket->topic->name }}</td>
                    @else
                    <td>Others</td>
                    @endif
                    
                    @if ($ticket->priority->priority == "High")
                    <td style=" color: red;">{{$ticket->priority->priority}}</td>

                    @elseif ($ticket->priority->priority == "Mid")
                    <td style=" color: orange;">{{$ticket->priority->priority}}</td>

                    @elseif ($ticket->priority->priority == "Low")
                    <td>{{$ticket->priority->priority}}</td>

                    @endif

                    <th>{{ $ticket->openDateTime }}</th>

                    <!-- //assign -->
                    @if (isset($ticket->assign))
                    <td>  {{ $ticket->assign->name }}</td>
                    @else
                    <td style="color: red;">No one</td>
                    @endif

                    <!-- //status -->

                    @if (isset($ticket->assign) && $ticket->status == 1)
                    <td style="color: orange;">sedang dikerjakan</td>

                    @elseif (isset($ticket->assign) && $ticket->status == 2)
                    <td style="color: green;">Sudah selesai</td>

                    @else
                    <td style="color: red;">Belum dikerjakan</td>

                    @endif

                    <!-- //rating -->

                   

                    <td>
                        @if(Auth::user()->worker->user_id == $ticket->department->head_id && !isset($ticket->assign) && $ticket->department_id == Auth::user()->worker->department_id)
                        <a href="/tickets/assign/{{$ticket->id}}" class="btn btn-primary btn-box"><i class="ti-pencil"></i></a>
                        @endif

                        <a href="/tickets/details/{{$ticket->id}}" class="btn btn-warning btn-box" title="detail"><i class="ti-clipboard"></i></a>

                        <!-- <a href="/tickets/actclose/{{$ticket->id}}" class="btn btn-danger btn-box"><button id="button-delete">close</button></a> -->
                    </td>
                </tr>
                @endforeach

                </tbody>
            </table>
    </div>
</div>
</div>
</div>
</div>


@include('foot')