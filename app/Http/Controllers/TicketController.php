<?php

namespace App\Http\Controllers;

// use Validator;
use Illuminate\Support\Facades\Validator;


use Illuminate\Http\Request;
use App\Models\Worker;
use App\Models\User;
use App\Models\Level;
use App\Models\Department;
use App\Models\Topic;
use App\Models\Priority;
use App\Models\Ticket;
use App\Models\TicketDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;



class TicketController extends Controller
{

    public function __construct()
   {
    $this->middleware('auth');
    $this->middleware(function ($request, $next) {
     if (!Auth::check() ) {
        return redirect('/');
    }
    return $next($request);
    });
    }
    public function index()
    {
        if (Auth::user()->level->level != "head" && Auth::user()->level->level != "Admin") {return redirect('/tickets/assign');}

        $perPage = 10;
        
        if (Auth::user()->level->level == "head"){
            $tickets = Ticket::with('worker','assign','department','priority','topic');

            $tickets = $tickets->where('department_id', Auth::user()->worker->department_id);

            $tickets = $tickets->orderBy('priority_id', 'desc')
            ->orderBy('openDateTime', 'desc')
            ->get();
        }else {
            $tickets = Ticket::All();
        }

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $tickets = new LengthAwarePaginator(
            $tickets->forPage($currentPage, $perPage),
            $tickets->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );
        $departments = Department::all();
        return view('ticket.tickets', ['tickets' => $tickets, 'departments' => $departments]);

        
    }

    public function assigned()
    {


        $perPage = 10;
        $tickets = Ticket::with('worker','assign','department','priority','topic');

        
        $tickets = $tickets->where('assign_id', Auth::user()->worker->user_id);
        

        $tickets = $tickets->orderBy('priority_id', 'desc')
        ->orderBy('openDateTime', 'desc')
        ->get();

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $tickets = new LengthAwarePaginator(
            $tickets->forPage($currentPage, $perPage),
            $tickets->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );
        $departments = Department::all();
        return view('ticket.tickets', ['tickets' => $tickets, 'departments' => $departments]);
        
    }

    public function made()
    {

        $perPage = 10;
        $tickets = Ticket::with('worker','assign','department','priority','topic');
        $tickets = $tickets->where('user_id', Auth::user()->worker->user_id);
        

        $tickets = $tickets->orderBy('priority_id', 'desc')
        ->orderBy('openDateTime', 'desc')
        ->get();

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $tickets = new LengthAwarePaginator(
            $tickets->forPage($currentPage, $perPage),
            $tickets->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        
        $departments = Department::all();
        return view('ticket.tickets', ['tickets' => $tickets, 'departments' => $departments]);

    }


public function show()
{

    $departments = Department::all();
    $topics = Topic::all();
    $priorities = Priority::all();
    return view('ticket.input',compact('departments','topics','priorities'));
}

public function input(Request $request)
{
    $validate = Validator::make($request->all(), [
        'department_id' => 'required',
        'topic_id' => 'required',
        'priority_id' => 'required',
        'description' => 'required|min:4',
    ]);
    if ($validate->fails())
    {
        return redirect("/tickets/input")
        ->withErrors($validate)
        ->withInput();
    }


    $ticket = new Ticket();
    $ticket->user_id = Auth::User()->id;
    $ticket->topic_id = $request->input('topic_id');
    $ticket->department_id = $request->input('department_id');
    $ticket->priority_id = $request->input('priority_id');
    $ticket->description = $request->input('description');
    $ticket->openDateTime = Carbon::now()->setTimezone('Asia/Jakarta');

    $ticket->save();

    return redirect('/tickets/made');
}


public function details($id)
{

 $ticket = Ticket::with('worker','assign','department','priority','topic')
 ->where('id', $id)
 ->first();

 $details = TicketDetail::with('worker','ticket')
 ->where('ticket_id', $id)
 ->get();


 return view('ticket.details._chats', ['ticket' => $ticket,
  'details'=>$details ]);
}

public function inputDetail(Request $request, $id)
{
    
    $photo = $request->file('photo');
    if(isset($photo) ){

        $extension = $photo->getClientOriginalExtension();
        $filename = Str::random(20) . '.' . $extension;

        $path = $photo->storeAs('public/images/avatar', $filename);
        $chat = new TicketDetail([
            'chat' => $request->input('chat-message'),
            'user_id' => Auth::user()->id,
            'photo' => $filename,
            'ticket_id' => $id,
            'date' => Carbon::now()->setTimezone('Asia/Jakarta'),
        ]);
    }else{
        $chat = new TicketDetail([
            'chat' => $request->input('chat-message'),
            'user_id' => Auth::user()->id,
            'ticket_id' => $id,
            'date' => Carbon::now()->setTimezone('Asia/Jakarta'),
        ]);
    }
    $chat->save();
    $check  = Ticket::where('id',$id)->first();
    if( $check->status == null && Auth::user()->id == $check->assign_id){
        $ticket = Ticket::where('id', $id)
        ->update([
            'status' => "1",
        ]);
    }

    return redirect('/tickets/details/'.$id);
}

public function assign($id)
{
    $workers = Worker::where('department_id', Auth::user()->worker->department_id)
    ->get();
    $ticket = Ticket::with('worker','assign','department','priority','topic')
    ->where('id', $id)
    ->first();
    return view('ticket.assign', compact('workers', 'id', 'ticket'));
}

public function actAssign($id, Request $request)
{
    $workerID = $request->input('assign_id');
    $ticket = Ticket::where('id', $id)
    ->update([
        'assign_id' => $workerID,
    ]);
    return redirect('/tickets');
}

public function actClose($id)
{
    Ticket::where('id', $id)
    ->update([
        'status' => "2",
        'closeDateTime' => Carbon::now()->setTimezone('Asia/Jakarta'),
    ]);

    $chat = new TicketDetail([
        'chat' => "The ticket has been close by ".Auth::user()->worker->name,
        'user_id' => Auth::user()->id,
        'ticket_id' => $id,
        'date' => Carbon::now()->setTimezone('Asia/Jakarta'),
    ]);
    $chat->save();
    return redirect()->back();
}


public function actOpen($id)
{
    Ticket::where('id', $id)
    ->update([
        'status' => "1",
        'OpenDateTime' => Carbon::now()->setTimezone('Asia/Jakarta'),
        'CloseDateTime' => null,
    ]);

    $chat = new TicketDetail([
        'chat' => "The ticket has been Open Again by ".Auth::user()->worker->name,
        'user_id' => Auth::user()->id,
        'ticket_id' => $id,
        'date' => Carbon::now()->setTimezone('Asia/Jakarta'),
    ]);
    $chat->save();
    return redirect()->back();
}

public function actRating($id, Request $request)
{
    $rating = $request->input('rating');
    Ticket::where('id', $id)
    ->update([
        'Rating' => $rating,

    ]);
    return redirect()->back();
}




}