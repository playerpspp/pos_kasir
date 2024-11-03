@include('head')

@include('nav')


<head>
    <title>Input Outcome</title>
</head>

<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-10">
                    <a onclick="history.back()"><button class="btn btn-primary">
                        Back
                    </button></a>                   
                    <h3>Outcome Form</h3>

                    <div class="basic-form">
                        @if($errors->any())
                        {!! implode('', $errors->all('<div id=alert-box>:message</div>')) !!}
                        @endif

                        <form autocomplete="on" action="/transaction_out/actinput" id="form_input" method="POST">
                            @csrf

                            <div id="input-fields">
                                <div class="input-group">
                                    <div class="col-lg-5">

                                        <div class="card">
                                            <div class="card-body">

                                                <div class="form-group">
                                                    <label for="product">Buku:</label><br>
                                                    <select required class="form-control" type="text" id="product" name="product[]" required>
                                                        <option>Choose product</option>
                                                        @foreach ($products as $product)
                                                        <option value="{{$product->id}}">{{$product->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <br>
                                                <div class="form-group">
                                                    <label for="amount">Jumlah:</label><br>
                                                    <input required class="form-control" type="number" id="amount" name="amount[]" placeholder="amount" value="{{old('amount')}}" required ><br>
                                                </div>

                                                <button class="btn btn-danger" type="button" id="button-remove" onclick="removeInput(this)"><i class="ti-trash"></i></button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button title="Add" class="btn btn-primary" type="button" id="button-add" onclick="addInput()"><i class="ti-plus"></i></button>
                            <button title="Submit" class="btn btn-success" type="submit" id="submitBtn"><i class="ti-save-alt"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
   function addInput() {
    var inputGroups = document.querySelectorAll('.input-group');
    var inputFields = document.querySelector('#input-fields');
    var lastInputGroup = inputGroups[inputGroups.length - 1];
    var newInputGroup = lastInputGroup.cloneNode(true);
    inputFields.appendChild(newInputGroup);
}

function removeInput(el) {
    var inputGroups = document.querySelectorAll('.input-group');
    if (inputGroups.length > 1) {
        var inputGroup = el.closest('.input-group');
        inputGroup.remove();
    } else {
        alert("Cannot remove last input group.");
    }
}

document.getElementById("submitBtn").addEventListener("click", function(event){
    event.preventDefault();
    this.disabled = true;
    document.getElementById("form_input").submit();
});
</script>
@include('foot')