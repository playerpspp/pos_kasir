<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\User;
use App\Models\Level;
use App\Models\Department;
use App\Models\Worker;
use Illuminate\Support\Facades\Auth;

class WorkerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!Auth::check()) {
                return redirect('/');
            }
            if (auth()->user()->level->level != "Admin" ) {
                abort(403, 'Unauthorized action.');
            }
            return $next($request);
        });
    }
    
    public function index()
    {

        $workers = Worker::with('user','department')->get();
        return view('worker.workers', compact('workers'));
    }

    public function input()
    {
        $level = Level::all();
        $departments = Department::All();
        return view('worker.input', compact('level','departments'));
    }

    public function actInput(Request $request)
    {
            $validate = Validator::make($request->all(), [
                'username' => 'required|max:255',
                'name' => 'required|max:255',
                'password' => 'required|min:4',
                'NIK' => 'required|max:15',
                'number' => 'required|max:16',
                'level' => 'required',
                'email' => 'required',
                'department'=> 'required'
            ]);
            if ($validate->fails())
            {
                $id= $request->id;
                return redirect("/workers/input")
                ->withErrors($validate)
                ->withInput();
            }

            $password = bcrypt(12345);
            if ($request->input('password')){
                $password = bcrypt($request->input('password'));
            }
            $user = new User();
            $user->name = $request->input('username');
            $user->password = $password;
            $user->email = $request->input('email');
            $user->level_id= $request->input('level');
            $user->save();

            $worker = new Worker();
            $worker->name = $request->input('name');
            $worker->NIK = $request->input('NIK');
            $worker->number = $request->input('number');
            $worker->user_id = $user->id;
            $worker->department_id  = $request->input('department');
            $worker->save();


            return redirect('/workers');

    }

    public function edit($id)
    {

            $user = User::where('id', $id)->first();
            $level = Level::all();
            return view('worker.edit', compact('user','level'));

    }

    public function update(Request $request)
    {

            $validate = Validator::make($request->all(), [
                'username' => 'required|max:255',
                'name' => 'required|max:255',
                'NIK' => 'required|max:15',
                'number' => 'required|max:10',
                'level' => 'required',
                'email' => 'required',
            ]);
            if ($validate->fails())
            {
                $id= $request->id;
                return redirect("/workers/edit/". $request->id)
                ->withErrors($validate)
                ->withInput();
            }

            $user = User::where('id', $request->id)
            ->update([
                'name' => $request->username,
                'level_id' => $request->level,
                'email' => $request->email,
            ]);
            $worker = Worker::where('user_id', $request->id)
            ->update([
                'name' => $request->name,
                'NIK' => $request->NIK,
                'number' => $request->number,
            ]);

            return redirect('/workers');

    }

    public function delete($id)
    {

            $worker = new Worker();
            User::where('id', $id)->delete();
            $user = new User();
            User::where('id', $id)->delete();

            return redirect('/workers');

    }



}
