@include('head')

@include('nav')

<head>
    <title>New Department</title>
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
                            <h3>INPUT DEPARTMENT</h3>
                        </div>

                        <div class="card-body">
                            <div class="basic-form">
                                @if($errors->any())
                                {!! implode('', $errors->all('<div id=alert-box>:message</div>')) !!}
                                @endif

                                <form action="/departments/actinput" id="form_input" method="POST">
                                    @csrf
                                    

                                    <div class="form-group">
                                        <label for="department">Department Name:</label><br>
                                        <input type="text" class="form-control" id="department" name="department" placeholder="Department Name" value="{{old('department')}}" required>
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