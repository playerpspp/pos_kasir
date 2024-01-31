@include('head')

@include('nav')

<head>
    <title>Edit User {{$user->name}}</title>
</head>

<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-10">
                    
                    <a onclick="history.back()"><button class="btn btn-primary">
                        Back
                    </button></a>

                    <div class="card">
                        <div class="card-title">
                            <h3>Edit User Form</h3>

                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                @if($errors->any())
                                {!! implode('', $errors->all('<div id=alert-box>:message</div>')) !!}
                                @endif
                                <form action="/users/update" method="POST">
                                    @csrf

                                    <input type="hidden" id="id" name="id" value="{{ $user->id }}">


                                    <div class="form-group">
                                        <label>Level</label>
                                        <select id="level" name="level" class="form-control">
                                            <option value="{{$user->level->id}}">{{$user->level->level}}</option>
                                            @foreach($level as $level)
                                            <option value="{{$level->id}}">{{$level->level}}</option>
                                            @endforeach
                                        </select>
                                    </div><br>

                                    <div class="form-group">
                                        <label for="department">department:</label><br>
                                        <select type="text" id="department" name="department" value="{{$work->department_id}}" required>
                                            <option value="{{$work->department_id}}">Choose department</option>
                                            @foreach ($departments as $department)
                                            <option value="{{$department->id}}">{{$department->name}}</option>
                                            @endforeach
                                        </select>
                                    </div><br>

                                    <div class="form-group">
                                        <label for="name">Username:</label><br>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="{{$user->name}}" required>
                                    </div><br>

                                    <div class="form-group">
                                        <label for="email">email</label><br>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" readonly>
                                    </div><br>


                                    <button type="submit" class="btn btn-default" >Submit</button>

                                </form>
                            </div>
                        </div>

                        @include('foot')