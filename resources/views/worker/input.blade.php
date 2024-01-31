@include('head')

@include('nav')

<head>
    <title>New Worker</title>
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
                            <h3>New Worker Form</h3>

                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                @if($errors->any())
                                {!! implode('', $errors->all('<div id=alert-box>:message</div>')) !!}
                                @endif
                                <form action="/workers/actinput" id="form_input" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Name:</label><br>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{old('name')}}" required>
                                    </div><br>

                                    <div class="form-group">
                                        <label for="id_number">NIK:</label><br>
                                        <input type="text" class="form-control" id="NIK" name="NIK" placeholder="NIK" value="{{old('NIK')}}"  required >
                                    </div><br>

                                    <div class="form-group">
                                        <label for="number">Phone number:</label><br>
                                        <input type="text" class="form-control" id="number" name="number" placeholder=" number" value="{{old('number')}}" required >
                                    </div><br>

                                    <div class="form-group">
                                        <label for="department">department:</label><br>
                                        <select type="text" class="form-control" id="department" name="department" value="{{old('department')}}" required>
                                            <option>Choose Level</option>
                                            @foreach ($departments as $department)
                                            <option value="{{$department->id}}">{{$department->name}}</option>
                                            @endforeach
                                        </select>
                                    </div><br>

                                    <div class="form-group">
                                        <label for="name">Username:</label><br>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="{{old('username')}}" required>
                                    </div><br>

                                    <div class="form-group">
                                        <label for="password">password</label><br>
                                        <input type="text" class="form-control" id="password" name="password" placeholder="password" value="{{old('password')}}" required>
                                    </div><br>

                                    <div class="form-group">
                                        <label>Level</label>
                                        <select required id="level" name="level" class="form-control">
                                            <option>-</option>
                                            @foreach($level as $level)
                                            <option value="{{$level->id}}">{{$level->level}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="email">email</label><br>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="xx@gmail.com" value="{{old('email')}}" required>
                                    </div><br>

                                    <button type="submitBtn" class="btn btn-success">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>

                        <script type="text/javascript">
                            document.getElementById("submitBtn").addEventListener("click", function(event){
                                event.preventDefault();
                                this.disabled = true;
                                document.getElementById("form_input").submit();
                            </script>

                            @include('foot')