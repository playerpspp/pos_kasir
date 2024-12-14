@include('head')

@include('nav')
<head>
    <title>Departments List</title>
</head>

<section id="main-content">

  
<div class="row">
 <div class="col-lg-12">
    <div class="card">
        <div class="card-title pr">
            <h3>Departments List</h3>
        </div>
        <br>
        <div class="card-body">
            <a href="/departments/input"><button class="btn btn-success" title="Add new"><i class="ti-plus"></i></button></a><br><br>

            

            @if($errors->any())
            {!! implode('', $errors->all('<div style="margin-top: 10px;" id=alert-box>:message</div>')) !!}
            @endif

            @if (count($departments) == 0)
            <p>No results found.</p>
            @else
            <br>
            <div class="bootstrap-data-table-panel ">
                    <div class="table-responsive">
                    <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <tr>
                        <th width="10px">No</th>
                        <th width="1000px">Department Name</th>
                        <th width="1000px">Head Name</th>
                        <th width="1000px">action</th>
                    </tr>
                    @php
                    $no = ($departments->currentPage() - 1) * $departments->perPage() + 1;
                    @endphp


                    @foreach ($departments as $department)
                    <tr>
                        <td width="10px">{{ $no++ }}</td>
                        <td>{{ $department->name }}</td>

                        @if (isset($worker[$department->head_id]))
                        <td>  {{ $worker[$department->head_id]->name }}</td>
                        @else
                        <td style="background-color: darkred; color: white;">No one</td>
                        @endif

                        <td>
                            <a href="/departments/members/{{$department->id}}" class="btn btn-primary btn-box" title="Members"><i class="ti-user"></i></a>
                                <a href="/departments/edit/{{$department->id}}/{{$department->head_id}}" class="btn btn-warning btn-box" title="Edit"><i class="ti-pencil-alt"></i></a>
                                <!-- <a href="/departments/actdelete/{{$department->id}}" class="btn btn-danger btn-box" title="Delete"><i class="ti-trash"></i></a> -->
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                </div>
                @endif

                <div id="pagination-container">
                   @if ($departments->previousPageUrl())
                   <div id="previous-container">
                      <a href="{{ $departments->previousPageUrl() }}">Previous</a>
                  </div>
                  @endif

                  @if ($departments->nextPageUrl())  
                  <div id="next-container">
                    <a href="{{ $departments->nextPageUrl() }}">Next</a>  
                </div>
                @endif
            </div>
        </div>
    </div>


    @include('foot')