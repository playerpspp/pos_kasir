@include('head')

@include('nav')

<head>
    <title>New Ticket</title>
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
                            <h3>New Ticket</h3>

                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                @if($errors->any())
                                {!! implode('', $errors->all('<div id=alert-box>:message</div>')) !!}
                                @endif

                                <form autocomplete="on" action="/tickets/actinput" id="form_input" method="POST">
                                    @csrf

                                    <div class="form-group">
                                        <label for="department_id">Department:</label>
                                        <select name="department_id" id="department_id" class="form-control">
                                            <option>Select Department</option>
                                            @foreach($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="topic_id">Topic:</label>
                                        <select name="topic_id" id="topic_id" class="form-control">
                                            <option value="">Select Department First</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="priority_id">Priority:</label>
                                        <select name="priority_id" id="priority_id" class="form-control">
                                            @foreach($priorities as $priority)
                                            <option value="{{ $priority->id }}">{{ $priority->priority }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Description:</label><br>
                                        <textarea class="form-control" name="description" id="description" rows="5" required>{{ old('description') }}</textarea>
                                    </div>

                                    <button type="submit" id="submitBtn" class="btn btn-success" >Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script type="text/javascript">
        document.getElementById("submitBtn").addEventListener("click", function(event){
            event.preventDefault();
            this.disabled = true;
            document.getElementById("form_input").submit();
        });

        $(function() {
        // Handle department select change event
            $('#department_id').on('change', function() {
                var department_id = $(this).val();

            // Fetch topics for selected department using AJAX
                $.ajax({
                    url: '/tickets/' + department_id + '/topics',
                    type: 'GET',
                    success: function(data) {
                    // Update topic select options
                        $('#topic_id').empty().append($('<option>', {
                            value: '',
                            text: 'Select Topic'
                        }));
                        $('#topic_id').append($('<option>', {
                            value: 0,
                            text: 'Others'
                        }));
                        $.each(data, function(key, value) {
                            $('#topic_id').append($('<option>', {
                                value: key,
                                text: value
                            }));
                        });
                    },
                    error: function() {
                        alert('Error fetching topics.');
                    }
                });
            });
        });
    </script>

    @include('foot')
