@include('head')

@include('nav')

<head>
    <title>New Topic</title>
</head>

<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-10">

                    <a onclick="history.back()"><button class="btn btn-primary">
                        <i class="ti-arrow-left"></i>
                    </button></a>
                    
                    <div class="card">
                        <div class="card-title">
                            <h3>INPUT TOPIC</h3>
                        </div>

                        <div class="card-body">
                            <div class="basic-form">
                                @if($errors->any())
                                {!! implode('', $errors->all('<div id=alert-box>:message</div>')) !!}
                                @endif

                                <form autocomplete="on" action="/topics/actinput" id="form_input" method="POST">
                                    @csrf
                                    
                                    @if(Auth::User()->level->level == "Admin" )
                                    <div class="form-group">
                                        <label for="department">department:</label><br>
                                        <select type="text" class="form-control" id="department" name="department" value="{{old('department')}}" required>
                                            <option>Choose Level</option>
                                            @foreach ($departments as $department)
                                            <option value="{{$department->id}}">{{$department->name}}</option>
                                            @endforeach
                                        </select>
                                    </div><br>
                                    @endif

                                    <div class="form-group">
                                        <label for="topic">Topic Name:</label><br>
                                        <input type="text" class="form-control" id="topic" name="topic" placeholder="Department Name" value="{{old('topic')}}" required>
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
                            document.getElementById("form_input").submit();
                        });
                    </script>

                    @include('foot')