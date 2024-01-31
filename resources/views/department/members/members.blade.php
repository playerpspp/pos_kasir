@include('head')

@include('nav')
<head>
    <title>Members {{$department->name}} department List</title>
</head>

<section id="main-content">
    <div class="row">
       <div class="col-lg-12">

        <a onclick="history.back()"><button class="btn btn-primary">
            Back
        </button></a>
        
        <div class="card">
            <div class="card-title pr">
                <h3>Members {{$department->name}} department list</h3>
            </div>
            <div class="card-body">
                @if(Auth::User()->level_id == 1)
                <a href="/departments/members/input/{{$department->id}}" class="btn btn-success btn-box"><i class="ti-plus"></i></a><br>
                @endif

                <!-- <form action="/departments/members/search/{{$department->id}}" method="POST">
                    @csrf
                    <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>  -->
                <!-- <a href="/departments/members/{{$department->id}}" class="btn btn-danger btn-box">Cancel Search</a><br>-->
                <br>

                @if($errors->any())
                {!! implode('', $errors->all('<div style="margin-top: 10px;" id=alert-box>:message</div>')) !!}
                @endif


                @if (count($workers) == 0)
                <p>No Member is in this department.</p>
                @else

                <div class="bootstrap-data-table-panel ">
                    <div class="table-responsive">
                    <table id="bootstrap-data-table" class="table table-striped table-bordered">
                        <tr>
                            <th width="10px">No</th>
                            <th width="1000px">Name</th>
                            <th width="1000px">Username</th>
                            <th width="1000px">Level</th>
                            <th width="1000px">Email</th>

                            @if(Auth::User()->level_id == 1)
                            <th width="1000px">action</th>

                            @endif
                        </tr>
                        @php
                        $no = ($workers->currentPage() - 1) * $workers->perPage() + 1;
                        @endphp

                        @foreach ($workers as $worker)
                        <tr>
                            <td width="10px">{{ $no++ }}</td>
                            <td>{{ $worker->name }}</td>
                            <td>{{ $worker->user->name }}</td>
                            <td>{{ $worker->user->level->level }}</td>
                            <td>{{ $worker->user->email}}</td>

                            @if(Auth::User()->level_id == 1)
                            <td>
                                <!-- <a href="/departments/reset/{{$worker->user_id}}" class=" btn btn-warning ">Reset Password</a> -->
                                <!-- <a href="/workers/edit/{{$worker->user_id}}" class="btn btn-primary "><i class="ti-pencil-alt" title="Edit"></i></a> -->
                                <a href="/departments/members/actdelete/{{$worker->user_id}}" class="btn btn-danger " title="Delete"><i class="ti-trash"></i></a>
                            </td>
                            @endif

                        </tr>
                        @endforeach
                    </table>
                </div>
                </div>
                @endif
                <div id="pagination-container">
                   @if ($workers->previousPageUrl())
                   <div id="previous-container">
                      <a href="{{ $bridges->previousPageUrl() }}">Previous</a>
                  </div>
                  @endif

                  @if ($workers->nextPageUrl())  
                  <div id="next-container">
                    <a href="{{ $bridges->nextPageUrl() }}">Next</a>  
                </div>

                @endif
            </div>
        </div>
    </div>


    @include('foot')