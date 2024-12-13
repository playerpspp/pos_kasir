@include('head')

@include('nav')


<head>
    <title>Outcome Input</title>
</head>

@include('inputcss')


<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <a onclick="history.back()"><button class="btn btn-primary">
                        <i class="ti-arrow-left"></i>
                    </button></a>  

                    <h3>Outcome Form</h3>
                    
                    @if($errors->any())
                    {!! implode('', $errors->all('<div id=alert-box>:message</div>')) !!}
                    @endif
                    <div class="basic-form">
                        <form autocomplete="on" action="/transaction_out/actinput" id="form_input" method="POST">
                            @csrf

                            <!-- Custom input fields container -->
                            <div id="input-fields" class="input-fields-container">
                                <!-- First input group (existing one) -->
                                <div class="custom-card">
                                    <div class="custom-form-group">
                                        <label for="product">Product:</label><br>
                                        <select required class="form-control" id="product" name="product[]" required>
                                            <option>Choose product</option>
                                            @foreach ($products as $product)
                                            <option value="{{$product->id}}">{{$product->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="custom-form-group">
                                        <label for="amount">Jumlah:</label><br>
                                        <input required class="form-control" type="number" id="amount" name="amount[]" placeholder="amount" value="{{old('amount')}}" required>
                                    </div><br>
                                    <button class="custom-remove-btn" type="button" onclick="removeInput(this)">Remove</button>
                                </div>
                            </div>

                            <!-- Add more input fields -->
                            <button title="Add" class="custom-add-btn" type="button" id="button-add" onclick="addInput()">Add Input</button>
                            <button title="Submit" class="custom-submit-btn" type="submit" id="submitBtn">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function addInput() {
        var inputFieldsContainer = document.querySelector('#input-fields'); 

        // Create new custom input card container
        var newInputGroup = document.createElement('div');
        newInputGroup.classList.add('custom-card');
        
        // Create the HTML structure for the new input fields
        newInputGroup.innerHTML = `
            <div class="custom-form-group">
                <label for="product">Product:</label><br>
                <select required class="form-control" name="product[]" required>
                    <option>Choose product</option>
                    @foreach ($products as $product)
                    <option value="{{$product->id}}">{{$product->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="custom-form-group">
                <label for="amount">Jumlah:</label><br>
                <input required class="form-control" type="number" name="amount[]" placeholder="amount" value="{{old('amount')}}" required>
            </div><br>
            <button class="custom-remove-btn" type="button" onclick="removeInput(this)">Remove</button>
        `;

        // Append the new input card to the container
        inputFieldsContainer.appendChild(newInputGroup);
    }

    function removeInput(el) {
        var inputGroups = document.querySelectorAll('.custom-card');
        if (inputGroups.length > 1) {
            var inputGroup = el.closest('.custom-card');
            inputGroup.remove();
        } else {
            alert("Cannot remove last input group.");
        }
    }

    document.getElementById("form_input").addEventListener("submit", function(event) {
        var form = this;
        var products = form.querySelectorAll("select[name='product[]']");
        var amounts = form.querySelectorAll("input[name='amount[]']");

        var isValid = true;

        // Check if all required fields are filled
        for (var i = 0; i < products.length; i++) {
            if (!products[i].value || !amounts[i].value) {
                isValid = false;
                alert("Please fill in all fields.");
                break;
            }
        }

        // If not valid, prevent form submission
        if (!isValid) {
            event.preventDefault();
        }
    });
</script>



@include('foot')