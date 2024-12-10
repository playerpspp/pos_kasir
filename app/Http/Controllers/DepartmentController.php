<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use App\Models\Worker;
use App\Models\User;
use App\Models\Level;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;



class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (auth()->user()->level->level != "admin" && auth()->user()->level->level == "head") {
                abort(403, 'Unauthorized action.');
            }if (!Auth::check() ) {
                return redirect('/');
            }
            return $next($request);
        });
    }

    public function index()
    {
        

            $perPage = 10;
        // retrieve users from database
            $departments = Department::all();
            $workers = [];

            foreach ($departments as $department) {
                $worker = Worker::where('user_id', $department->head_id)->first();
                if ($worker) {
                    $workers[$worker->user_id] = $worker;
                }
            }

            // dd($workers);

            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $departments = new LengthAwarePaginator(
                $departments->forPage($currentPage, $perPage),
                $departments->count(),
                $perPage,
                $currentPage,
                ['path' => LengthAwarePaginator::resolveCurrentPath()]
            );
        // return view with users data
            return view('department.departments', ['departments' => $departments, 'worker' => $workers]);
        
    }

    public function show()
    {
        



            return view('department.input');

    }

    public function input(Request $request)
    {
        
        // validate user input
            $validate = Validator::make($request->all(), [
                'department' => 'required|max:255',
            ]);
            if ($validate->fails())
            {
                return redirect("/departments/input")
                ->withErrors($validate)
                ->withInput();
            }


            $department = new Department;
            $department->name = $request->input('department');
            $department->head_id = null;
            $department->save();

            $departmentID = $department->id;

            // $work = new Worker();
            // $work->name = $request->input('name');
            // $work->user_id = $userID;
            // $work->department_id= $departmentID;
            // $work->save();


        // redirect to users list
            return redirect('/departments');

    }

    public function reset($id)
    {
        

            $user = new User();

            $password = bcrypt('12345');

            $user = User::where('id', $id)
            ->update([
                'password' => $password,
            ]);


        // redirect to users list
            return redirect()->back();


    }

    public function delete($id)
    {
        

            $department = Department::find($id);
            $worker = Worker::where('department_id', $department->id)->first();
            if ($worker) {
                return back()->withErrors(['error' => 'Department cannot be deleted as it is associated with a worker']);
            }
            $department->delete();
            return redirect('/departments')->with('success', 'Department deleted successfully');
        // redirect to users list

    }

    public function edit($id, $head)
    {
        

            $department = Department::with('user')->where('id', $id)->first();

            $work = Worker::where('user_id', $department->head_id)->get();

            return view('department.edit', [
                'work' => $work,
                'department' => $department,
            ]);

    }

    public function update(Request $request)
    {
        


            $validate = Validator::make($request->all(), [
                'worker' => 'required',
                'department' => 'required|max:255',
            ]);
            if ($validate->fails())
            {
                $id= $request->id;
                return redirect("/departments/edit/{$id}")
                ->withErrors($validate)
                ->withInput();
            }

            $head = level::where('level', 'head')->pluck('id')->first();
            $pekerja = level::where('level', 'pekerja')->pluck('id')->first();

            $worker = User::find($request->worker);
            if (!$worker) {
                return back()->withErrors(['error' => 'Worker not found.']);
            }

            $department = Department::find($request->id);
            if (!$department) {
                return back()->withErrors(['error' => 'Department not found.']);
            }

            $department->head_id = $request->worker;
            $department->save();

            if ($request->head_id) {
                $headUser = User::find($request->head_id);
                if ($headUser) {
                    $headUser->level_id = $pekerja;
                    $headUser->save();
                }
            }

            $worker->level_id = $head;
            $worker->save();

            return redirect('/departments');

    }

    public function search(Request $request)
    {
       $search = $request->get('search');
       $perPage = 10;

       $departmentID = DB::table('departments')
       ->join('workers', 'departments.head_id', '=', 'workers.user_id')
       ->where('departments.name', 'like', "%$search%")
       ->orwhere('workers.name', 'like', "%$search%")
       ->pluck('departments.id');

       $departments = Department::with(['worker'])->whereIn('id', $departmentID)->get();

       $currentPage = LengthAwarePaginator::resolveCurrentPage();
       $departments = new LengthAwarePaginator(
        $departments->forPage($currentPage, $perPage),
        $departments->count(),
        $perPage,
        $currentPage,
        ['path' => LengthAwarePaginator::resolveCurrentPath()]
    );



       return view('department.departments', compact('departments'));
   }

   public function members($id)
   {
    if (Auth::user()->level->level != "Admin" && (Auth::user()->level->level != "head")) {
        abort(403, 'Unauthorized action.');
    }
    $perPage = 10;
    if($id == 0){

        $departmentID = Worker::where('user_id', Auth::User()->id)
        ->pluck('department_id')
        ->first();

        $workers = Worker::with('user','department')
        ->where('department_id', $departmentID)
        ->get();

        $department = DB::table('departments')
        ->where('departments.id', $departmentID)
        ->first();

    }else{

        $workers = Worker::with('user','department')->where('department_id', $id)->get();
        $department = DB::table('departments')
        ->where('departments.id', $id)
        ->first();

    }
    $currentPage = LengthAwarePaginator::resolveCurrentPage();
    $workers = new LengthAwarePaginator(
        $workers->forPage($currentPage, $perPage),
        $workers->count(),
        $perPage,
        $currentPage,
        ['path' => LengthAwarePaginator::resolveCurrentPath()]
    );

    return view('department.members.members', ['workers' => $workers,
      'department'=>$department ]);
}

public function inputMember($id)
{
        $level = DB::table('levels')->where('level', 'perkerja')->first();
        $department = DB::table('departments')
        ->where('departments.id', $id)
        ->first();

        return view('department.members.input', ['level' => $level, 'departments' => $department]);
}

public function actInputMember(Request $request)
{
        // validate user input
    $validate = Validator::make($request->all(), [
        'name' => 'required|max:255',
        'NIK' => 'required|max:15',
        'number' => 'required|max:16',
        'department' => 'required',
        'username' => 'required|max:255',
        'password' => 'required|min:4',
        'level' => 'required',
        'email' => 'required',
    ]);
    if ($validate->fails())
    {
        $id= $request->input('department');
        return redirect("/departments/members/input/{$id}")
        ->withErrors($validate)
        ->withInput();
    }

        // create new user
        $id= $request->input('department');

    $password = bcrypt($request->password);
    $user = new User();
    $user->name = $request->input('username');
    $user->password = $password;
    $user->email = $request->input('email');
    $user->level_id = $request->input('level');
    $user->save();

    $userID = $user->id;

    $work = new Worker();
    $work->name = $request->input('name');
    $work->user_id = $userID;
    $work->NIK = $request->input('NIK');
    $work->number = $request->input('number');
    $work->department_id = $request->input('department');
    $work->save();

    $level_id = $request->input('level');
    $level = Level::where('id', $level_id)
    ->first();

        // redirect to users list
    return redirect("/departments/members/{$id}");


}



public function deleteMember($id)
{

    $work = Worker::where('id', $id)
    ->update([
        'department_id'=>null,
    ]);

    return back();

}

public function memberSearch($id,Request $request)
{
   $search = $request->get('search');
   $perPage = 10;
   if($id == 0){

    $departmentID = Worker::where('user_id', Auth::User()->id)
    ->pluck('department_id')
    ->first();

    $workers = Worker::with('user','department')
    ->where('department_id', $departmentID)
    ->Where('workers.name', 'like', "%$search%")
    ->get();

    $department = DB::table('departments')
    ->where('departments.id', $departmentID)
    ->first();

}else{

    $workers = Worker::with('user','department')
    ->where('department_id', $id)
    ->Where('workers.name', 'like', "%$search%")
    ->get();

    $department = DB::table('departments')
    ->where('departments.id', $id)
    ->first();

}
$currentPage = LengthAwarePaginator::resolveCurrentPage();
$workers = new LengthAwarePaginator(
    $workers->forPage($currentPage, $perPage),
    $workers->count(),
    $perPage,
    $currentPage,
    ['path' => LengthAwarePaginator::resolveCurrentPath()]
);

if (!$department) {
    return back()->withErrors(['error' => 'Department Does not exist']);
}

return view('department.members.members', ['workers' => $workers,
  'department'=>$department ]);
}

}