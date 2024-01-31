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
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->level->level != "head" && Auth::user()->level->level != "Admin") {return redirect('/tickets/assign');}

            $perPage = 10;
        // retrieve tickets from database
            if (Auth::user()->level->level == "head"){
            $tickets = Ticket::with('worker','assign','department','priority','topic');

            $tickets = $tickets->where('department_id', Auth::user()->worker->department_id);

            $tickets = $tickets->orderBy('priority_id', 'desc')
            ->orderBy('openDateTime', 'desc')
            ->get();
        }else {
            $tickets = Ticket::All();
        }

          
            $departments = Department::all();
        // return view with tickets data
            return view('ticket.tickets', ['tickets' => $tickets, 'departments' => $departments]);

        } else {
            return redirect('/');
        }
        
    }

    public function assigned()
    {

        if (Auth::check()) {

            $perPage = 10;
        // retrieve tickets from database
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
        // return view with tickets data
            return view('ticket.tickets', ['tickets' => $tickets, 'departments' => $departments]);

        } else {
            return redirect('/');
        }
        
    }

    public function made()
    {

        if (Auth::check()) {

            $perPage = 10;
        // retrieve tickets from database
            $tickets = Ticket::with('worker','assign','department','priority','topic');
            $tickets = $tickets->where('user_id', Auth::user()->worker->user_id);
            

            $tickets = $tickets->orderBy('priority_id', 'desc')
            ->orderBy('openDateTime', 'desc')
            ->get();

           
            $departments = Department::all();
        // return view with tickets data
            return view('ticket.tickets', ['tickets' => $tickets, 'departments' => $departments]);

        } else {
            return redirect('/');
        }
        
    }


//     public function search(Request $request)
//     {
//         // dd($request);
//      $search = $request->get('search');
//      $perPage = 10;

// // retrieve tickets from database
//      $ticketID = DB::table('tickets')
//      ->join('workers','tickets.user_id', '=', 'workers.user_id')
//      ->join('departments', 'tickets.department_id', '=', 'departments.id')
//      ->join('priorities', 'tickets.priority_id', '=', 'priorities.id')
//      ->join('topics', 'tickets.topic_id', '=', 'topics.id')
//      ->where('departments.name', 'like', "%$search%")
//      ->orWhere('workers.name', 'like', "%$search%")
//      ->orWhere('priorities.priority', 'like', "%$search%")
//      ->orWhere('topics.name', 'like', "%$search%");

//      $ticketIDs = $ticketID->pluck('tickets.id')->toArray();

//      $tickets = Ticket::with('worker','assign','department','priority','topic')
//      ->whereIn('id', $ticketIDs);

//      $status = $request->get('status');

//      if ($status == 1) {
//         $tickets->whereNull('status');
//     } elseif ($status == 2) {
//         $tickets->where('status', 1);
//     } elseif ($status == 3) {
//         $tickets->where('status', 2);
//     }
//     $departmentID = $request->input('department_id');
//     if ($departmentID != "" && Auth::user()->level->level == "Admin"){
//         $tickets->where('department_id', $departmentID);
//     }elseif (Auth::user()->level->level != "Admin"){
//         $tickets->where('department_id', Auth::user()->worker->department_id);
//     }
//     $tickets->orderBy('priority_id', 'desc')
//     ->orderBy('openDateTime', 'desc')
//     ->get();

//     $currentPage = LengthAwarePaginator::resolveCurrentPage();
//     $tickets = new LengthAwarePaginator(
//         $tickets->forPage($currentPage, $perPage),
//         $tickets->count(),
//         $perPage,
//         $currentPage,
//         ['path' => LengthAwarePaginator::resolveCurrentPath()]
//     );
//     $departments = Department::all();
// dd($tickets);
//     // return view('ticket.tickets', ['tickets' => $tickets , 'departments' => $departments]);
// }


public function show()
{
    if (Auth::check()) {

        $departments = Department::all();
        $topics = Topic::all();
        $priorities = Priority::all();
        return view('ticket.input',compact('departments','topics','priorities'));

    } else {
        return redirect('/');
    }
}

public function input(Request $request)
{
    if (Auth::check()) {
        // validate user input
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

        // create new ticket

        $ticket = new Ticket();
        $ticket->user_id = Auth::User()->id;
        $ticket->topic_id = $request->input('topic_id');
        $ticket->department_id = $request->input('department_id');
        $ticket->priority_id = $request->input('priority_id');
        $ticket->description = $request->input('description');
        $ticket->openDateTime = Carbon::now()->setTimezone('Asia/Jakarta');

        $ticket->save();

        // redirect to users list
        return redirect('/tickets/made');

    } else {
        return redirect('/');
    }
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
    // Create a new chat message with the user ID and ticket ID
    // dd($request);
    $photo = $request->file('photo');
    // dd($photo);
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
    // dd($request);
    $workerID = $request->input('assign_id');
    $ticket = Ticket::where('id', $id)
    ->update([
        'assign_id' => $workerID,
        // 'status' => "1",
    ]);
    return redirect('/tickets');
}

public function actClose($id)
{
    // dd($request);
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
    // dd($request);
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
    // dd($request);
    $rating = $request->input('rating');
    Ticket::where('id', $id)
    ->update([
        'Rating' => $rating,

    ]);
    return redirect()->back();
}




}