@include('head')

@include('nav')

<head>
    <title>Edit TOPIC: {{$topic->name}}</title>
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
                            <h3>EDIT Topic: {{$topic->name}}</h3>
                        </div>

                        <div class="card-body">
                            <div class="basic-form"> 
                                @if($errors->any())
                                {!! implode('', $errors->all('<div id=alert-box>:message</div>')) !!}
                                @endif

                                <form autocomplete="on" action="/topics/update" id="form_input" method="POST">
                                    @csrf

                                    <input type="hidden" id="id" name="id" value="{{ $topic->id }}">

                                    @if(Auth::User()->level->level == "Admin" )
                                    <div class="form-group">
                                        <label for="department">department:</label><br>
                                        <select type="text" class="form-control" id="department" name="department" value="{{old('department')}}" required>
                                            <option value="{{$topic->department_id}}">{{$topic->department->name}}</option>
                                            @foreach ($departments as $department)
                                            <option value="{{$department->id}}">{{$department->name}}</option>
                                            @endforeach
                                        </select>
                                    </div><br>
                                    @endif


                                    <div class="form-group">
                                        <label for="department">topic Name:</label><br>
                                        <input type="text" class="form-control" id="topic" name="topic" value="{{$topic->name}}" required>
                                    </div>

                                    

                                        <button type="submit" class="btn btn-success" >Submit</button>

                                    </form>
                                </div>
                            </div>
                        </div>

                        @include('foot')