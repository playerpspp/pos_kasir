<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\Topic;
use App\Models\Ticket;
use App\Models\Department;
use Illuminate\Support\Facades\DB;



class TopicController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (auth()->user()->level->level != "Admin" && auth()->user()->level->level != "head" ) {
                abort(403, 'Unauthorized action.');
            }if (!Auth::check() ) {
                return redirect('/');
            }
            return $next($request);
        });
    }

    public function index()
    {
    // retrieve topics and their usage from database
        if (auth::User()->level->level == 'Admin') {
            $topics = Topic::all();
        } else {
            $topics = Topic::where('department_id', auth::user()->worker->department_id)->get();
        }
        foreach ($topics as $topic) {
            $topicID[]=$topic->id;
        }
        $topicID[]= 0;
        $use = Ticket::select(DB::raw('count(topic_id) as count'),'topic_id')
        ->whereIn('topic_id', $topicID)
        ->groupBy('topic_id')
        ->get()
        ->keyBy('topic_id');
            // dd($use);
        

    // return view with topics data
        return view('topic.topic', compact('topics', 'use'));
    }


    public function show()
    {

        $departments = Department::All();

        return view('topic.input', compact('departments'));

    }

    public function actInput(Request $request)
    {

        // validate topic input
        if(auth::User()->level->level == 'Admin'){
            $validate = Validator::make($request->all(), [
                'topic' => 'required|max:255',
                'department' => 'required|'
            ]);
        }else {
            $validate = Validator::make($request->all(), [
                'topic' => 'required|max:255',
            ]);
        }

        if ($validate->fails())
        {
            $id= $request->id;
            return redirect("/products/input")
            ->withErrors($validate)
            ->withInput();
        }

        // create new product
        $topic = new Topic();
        $topic->name = $request->input('topic');
        if(auth::User()->level->level == 'Admin'){
            $topic->department_id = $request->input('department');
        }else {
            $topic->department_id = auth::user()->worker->department_id;
        }


        $topic->save();

        // redirect to products list
        return redirect('/topics'); 


    }


    public function edit($id)
    {

        $topic = Topic::where('id', $id)->first();
        $departments = Department::All();

        return view('topic.edit', compact('topic','departments'));


    }

    public function update(Request $request)
    {

        if(auth::User()->level->level == 'Admin'){
            $validate = Validator::make($request->all(), [
                'topic' => 'required|max:255',
                'department' => 'required|'
            ]);
        }else {
            $validate = Validator::make($request->all(), [
                'topic' => 'required|max:255',
            ]);
        }

        if ($validate->fails())
        {
            $id= $request->id;
            return redirect("/products/input")
            ->withErrors($validate)
            ->withInput();
        }

        // create new product
        if(auth::User()->level->level == 'Admin'){
            $Topic = Topic::where('id', $request->id)
            ->update([
                'name' => $request->input('topic'),
                'department' => $request->input('department'),
            ]);       
        }else {
            $Topic = Topic::where('id', $request->id)
            ->update([
                'name' => $request->input('topic'),
            ]);        
        }



        return redirect('/topics');


    }
}
