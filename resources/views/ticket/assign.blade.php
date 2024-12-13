@include('head')

@include('nav')

<head>
    <title>Assign Ticket</title>
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
                            <h3>Assign Ticket</h3>
                        </div>
                        <div class="card-body">
                            @if($errors->any())
                            {!! implode('', $errors->all('<div id=alert-box>:message</div>')) !!}
                            @endif

                            <form autocomplete="on" action="/tickets/actAssign/{{$id}}" id="form_input" method="POST">
                                @csrf

                                <h3>Ticket #{{$ticket->id}}:

                                    @if (isset($ticket->topic))
                                    <br>Topics: {{ $ticket->topic->name }}
                                    @else
                                    <br>Topics: Others
                                    @endif

                                    <br>Priority: {{$ticket->priority->priority}}
                                    <br>Deskripsi: {{$ticket->description }}
                                    <br>Open: {{$ticket->openDateTime}}</h3>

                                    <div class="form-group">
                                        <label for="assign_id">Assign to who?</label>
                                        <select required name="assign_id" id="assign_id" class="form-control">
                                            <option>Select Worker</option>
                                            @foreach($workers as $worker)
                                            @if($worker->user_id == auth::user()->id)
                                            <option value="{{ $worker->user_id }}">assign to me</option>
                                            @endif
                                            @if($worker->user_id != auth::user()->id)
                                            <option value="{{ $worker->user_id }}">{{ $worker->name }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <button type="submit" id="submitBtn" class="btn btn-success" >Submit</button>
                                </form>
                            </div>
                        </div>

                        <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                        <script type="text/javascript">
                            document.getElementById("submitBtn").addEventListener("click", function(event){
                                event.preventDefault();
                                this.disabled = true;
                                document.getElementById("form_input").submit();
                            });
                        </script>

                        @include('foot')
