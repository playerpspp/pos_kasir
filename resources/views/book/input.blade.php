@include('head')

@include('nav')

<head>
    <title>Input New Book</title>
</head>

<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-12">
                    <button class="btn btn-primary" title="Back" onclick="history.back()"><i class="ti-arrow-left"></i></button>
                    <div class="card">
                        <div class="card-title">
                            <h3>NEW BOOK</h3>
                        </div>
                        <br>
                        <div class="card-body">


                            @if($errors->any())
                            {!! implode('', $errors->all('<div id=alert-box>:message</div>')) !!}
                            @endif

                            
                            <div class="basic-form">
                                <form action="/books/actinput" id="form_input" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Book Name:</label><br>
                                        <input class="form-control" type="text" id="name" name="name" placeholder="Name" value="{{old('name')}}" required>
                                    </div><br>

                                    <div class="form-group">
                                        <label for="code">Book Code:</label><br>
                                        <input class="form-control" type="text" id="code" name="code" placeholder="code" value="{{old('code')}}" required>
                                    </div><br>

                                    <div class="form-group">
                                        <label for="price">Book Price:</label><br>
                                        <input class="form-control" type="text" id="price" name="price" placeholder="price" value="{{old('price')}}"  required >
                                    </div><br>

                                    <button title="Submit" class="btn btn-success" type="submit" id="submitBtn"><i class="ti-save-alt"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
               
<script type="text/javascript">
    document.getElementById("submitBtn").addEventListener("click", function(event){
        event.preventDefault();
        this.disabled = true;
        document.getElementById("form_input").submit();})
    </script>
    
    @include('foot')