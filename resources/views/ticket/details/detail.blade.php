@include('head')

@include('nav')
<head>
  <title>Ticket #{{$ticket->id}} Detail</title>

</head>
<br>
@if($ticket->user_id == auth::user()->worker->user_id)
<a href="/tickets/made" title="Back" class="btn btn-primary"><i class="ti-arrow-left"></i></a>
@elseif($ticket->assign_id == auth::user()->worker->user_id)
<a href="/tickets/assign"><button id="button-back" title="Back">Back</button></a>
@endif
<br>
<div class="row">
  <div class="col-lg-4">
    <div class="card">
      <div class="card-title">
        <h3>TICKET #{{$ticket->id}} Detail</h3>
      </div>
      <div class="card-body">
        <label>
          @if (isset($ticket->topic))
          <br>Topics: {{ $ticket->topic->name }}
          @else
          <br>Topics: Others
          @endif
          <br>Priority: {{$ticket->priority->priority}}
          <br>Deskripsi: {{$ticket->description }}
          <br>Open: {{$ticket->openDateTime}}</label>
          <br>

          @if(auth::user()->worker->user_id == $ticket->assign_id || auth::user()->worker->user_id == $ticket->user_id)


          <a href="/tickets/actClose/{{$ticket->id}}" class="btn btn-danger btn-box" title="Close Ticket">Close Ticket</a>
          @endif
        </div>
      </div>
    </div>
  </div>
