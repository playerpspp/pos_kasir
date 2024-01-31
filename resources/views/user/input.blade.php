@include('head')

@include('nav')

<head>
    <title>New User</title>
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
                            <h3>New User Form</h3>

                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                @if($errors->any())
                                {!! implode('', $errors->all('<div id=alert-box>:message</div>')) !!}
                                @endif
                                <form action="/users/actinput" id="form_input" method="POST">
                                    @csrf

                                    <div class="form-group">
                                        <label for="name">Username:</label><br>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="{{old('username')}}" required>
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

                                    <button type="submitBtn" class="btn btn-default">Submit</button>
                                </form>
                            </div>
                        </div>

                        <script type="text/javascript">
                            document.getElementById("submitBtn").addEventListener("click", function(event){
                                event.preventDefault();
                                this.disabled = true;
                                document.getElementById("form_input").submit();
                            </script>

                            @include('foot')