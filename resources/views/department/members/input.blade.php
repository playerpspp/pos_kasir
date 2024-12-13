@include('head')

@include('nav')
<head>
    <title>New Department {{$departments->name}} Member</title>
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
                            <h3>Input New Member department {{$departments->name}} </h3>
                        </div>

                        <div class="card-body">
                            <div class="basic-form">
                                @if($errors->any())
                                {!! implode('', $errors->all('<div id=alert-box>:message</div>')) !!}
                                @endif

                                <form autocomplete="on" action="/departments/members/actinput" id="form_input" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Name:</label><br>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{old('name')}}" >
                                    </div><br>

                                    <div class="form-group">
                                        <label for="id_number">NIK:</label><br>
                                        <input type="text" class="form-control" id="NIK" name="NIK" placeholder="NIK" value="{{old('NIK')}}"  required >
                                    </div><br>

                                    <div class="form-group">
                                        <label for="number">Phone number:</label><br>
                                        <input type="tel" class="form-control" id="number" name="number" placeholder=" number" value="{{old('number')}}" required >
                                    </div><br>

                                    <input type="hidden" id="department" name="department" value="{{$departments->id}}" >


                                    <div class="form-group">
                                        <label for="username">Username:</label><br>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="username" value="{{old('name')}}" >
                                    </div><br>


                                    <div class="form-group">
                                        <label for="password">password</label><br>
                                        <input type="text" class="form-control" id="password" name="password" placeholder="password" value="{{old('password')}}" >
                                    </div><br>

                                    <div class="form-group">
                                        <label for="level">level:</label><br>
                                        <select type="text" class="form-control" id="level" name="level" value="{{old('level')}}" readonly>
                                            <option value="{{$level->id}}">{{$level->level}}</option>
                                        </select>
                                    </div><br>


                                    <div class="form-group">
                                        <label for="email">email</label><br>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="xx@gmail.com" value="{{old('email')}}" >
                                    </div><br>

                                    <button type="submit" id="submitBtn" class="btn btn-success" >Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>

                        <script type="text/javascript">
                            document.getElementById("submitBtn").addEventListener("click", function(event){
                                event.preventDefault();
                                this.disabled = true;
                                document.getElementById("form_input").submit();});
                            </script>

                            @include('foot')