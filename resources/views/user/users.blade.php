@include('head')

@include('nav')


<head>
    <title>Users Table</title>
    <link href="/css/lib/jsgrid/jsgrid-theme.min.css" rel="stylesheet" />
    <link href="/css/lib/jsgrid/jsgrid.min.css" type="text/css" rel="stylesheet" />
</head>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <div class="card-title">
                    <h3 style="margin-left: 3px;">Users Table</h3>
                </div>

                <!-- <a style="margin-left: 5px;" href="/users/input"><button class="btn btn-box" title="Add new"><i class="ti-plus"></i></button></a> -->
                <div class="card-body">
                    <br>
                    <div class="bootstrap-data-table-panel ">
                    <div class="table-responsive">
                    <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th width="10px">no</th>
                                    <th width="1000px">Username</th>
                                    <th width="1000px">Email</th>
                                    <th width="1000px">Level</th>
                                    <th width="1000px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no = 0;
                                $no++;
                                @endphp

                                @foreach ($users as $user)
                                <tr>
                                    <td width="10px">{{$no}}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email}}</td>
                                    <td>{{ $user->level->level }}</td>
                                    <td>
                                        <a href="/users/reset/{{$user->id}}"><button class="btn btn-warning" title="Reset Password"><i class="ti-key"></i></button></a>

                                        <!-- <a href="/users/edit/{{$user->id}}"><button class="btn btn-box" title="Edit"><i class="ti-pencil-alt"></i></button></a> -->

                                        <!-- <a href="/users/actdelete/{{$user->id}}"><button class="btn btn-box" title="Delete"><i class="ti-trash"></i></button></a> -->
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