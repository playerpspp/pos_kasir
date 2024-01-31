@include('head')

@include('nav')


<head>
    <title>Workers Table</title>
    <link href="/css/lib/jsgrid/jsgrid-theme.min.css" rel="stylesheet" />
    <link href="/css/lib/jsgrid/jsgrid.min.css" type="text/css" rel="stylesheet" />
</head>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <div class="card-title">
                    <h3 style="margin-left: 3px;">Workers Table</h3>
                </div>

                <a style="margin-left: 5px;" href="/workers/input"><button class="btn btn-success" title="Add new"><i class="ti-plus"></i></button></a>
                <div class="card-body">
                    <br>
                    <div class="bootstrap-data-table-panel ">
                    <div class="table-responsive">
                    <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th width="3%">no</th>
                                    <th width="1000px">name</th>
                                    <th width="1000px">NIK</th>
                                    <th width="1000px">Phone</th>
                                    <th width="1000px">Level</th>
                                    <th width="1000px">Username</th>
                                    <th width="1000px">Department</th>
                                    <th width="1000px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no = 0;
                                $no++;
                                @endphp

                                @foreach ($workers as $worker)
                                <tr>
                                    <td width="10px">{{$no}}</td>
                                    <td>{{ $worker->name }}</td>
                                    <td>{{ $worker->NIK }}</td>
                                    <td>{{ $worker->number }}</td>
                                    <td>{{ $worker->user->level->level }}</td>
                                    <td>{{ $worker->user->name }}</td>
                                    @if(isset($worker->department->name))
                                    <td>{{ $worker->department->name}}</td>
                                    @else
                                    <td>N/A</td>
                                    @endif
                                    <td>
                                        <a href="/workers/edit/{{$worker->user->id}}"><button class="btn btn-warning" title="Edit"><i class="ti-pencil-alt"></i></button></a>

                                        <a href="/workers/actdelete/{{$worker->user->id}}"><button class="btn btn-danger" title="Delete"><i class="ti-trash"></i></button></a>
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