
@include('ticket.details.detail')

<head>
    <style type="text/css">
        .chat-box {
            width: 98%;
          height: 300px;
          border: 1px solid #000;
          overflow: auto;
          overflow-y: scroll;
          padding: 10px;
          background-color: white;
      }

      
  </style>
</head>

@if(auth::user()->worker->user_id == $ticket->assign_id || auth::user()->worker->user_id == $ticket->user_id)
<div class="row">
    <div class="col-lg-10">
        <div class="card">
            <div class="card-title">
                <h3>Chat</h3>
            </div>
            <div class="card-body">
                <div class="chat-box">
                  <div class="chat-messages" id="chat-messages">
                    @if (count($details) == 0)
                    <p>No Chat has happened.</p>
                    @else
                    <div class="recent-comment m-t-15">
                        @foreach ($details as $detail)
                        <div class="media">
                            <div class="media-body">
                                @if(Auth::user()->id == $detail->user_id)
                                <h4 class="media-heading color-primary">{{ $detail->worker->name }}</h4>
                                @else
                                <h4 class="media-heading color-danger">{{ $detail->worker->name }}</h4>
                                @endif
                                @if(isset($detail->photo))
                                <img width="400px" height="400px" src="{{ asset('storage/images/avatar/'. $detail->photo) }}" alt="Avatar">
                                @endif
                                <p>{{ $detail->chat }}</p>
                                <p class="comment-date">{{ $detail->date }}</p>
                                <br>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div><br>
            </div>
            <!-- <form id="chat-form" method="POST" onsubmit="event.preventDefault(); submitChatMessage();"> -->
                @if($ticket->status != "2")
                <h3>Send a message</h3>
                <form id="chat-form" method="POST" action="/tickets/details/input/{{$ticket->id}}"  enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <textarea required style="height: 80px;" class="form-control" placeholder="Give messages" type="text"  class="chat-message" id="chat-message" name="chat-message"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Want to sent photo?</label>
                        <input class="form-control" type="file" id="photo" name="photo">
                    </div>
                    <button type="submit" id="button-input" class="btn btn-success" title="Send Message">Send Message</i></button>
                </form>
                <br>


                @elseif($ticket->status == "2")

                
                <br>
                <a href="/tickets/actOpen/{{$ticket->id}}" class="btn btn-danger btn-box"><button title="Open Ticket" id="button-edit">Open</button></a>
                @endif

                @endif

            </div>
        </div>
    </div>
</div>








<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    function fetchChatMessages() {
        $('#chat-messages').load('/tickets/details/{{ $ticket->id }} #chat-messages');
    }

    $(document).ready(function() {
    // Call fetchChatMessages() initially to load the chat messages
        fetchChatMessages();

    // Call fetchChatMessages() every 10 seconds to update the chat messages
        setInterval(fetchChatMessages, 10000);

         // Set the scrollTop property to the maximum value to scroll to the bottom
        $('.chat-box').scrollTop($('.chat-box')[0].scrollHeight);

    });

    // function submitChatMessage() {
    //     // Get the chat message from the input field
    //     var message = $('#chat-message').val();

    //     // Send an Ajax request to submit the chat message
    //     $.ajax({
    //         url: '/tickets/details/input/{{$ticket->id}}',
    //         type: 'POST',
    //         data: {
    //             chat: message,
    //             _token: '{{ csrf_token() }}'
    //         },
    //         success: function(response) {
    //             // Clear the input field after the chat message is submitted
    //             $('#chat-message').val('');

    //             // Update the chat box with the new chat message
    //             $('#chat-messages').html(response);
    //         }
    //     });
    // }
</script>

@include('foot')