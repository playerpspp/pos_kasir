<?php

namespace App\Http\Controllers;

// use Validator;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Level;
use App\Models\Worker;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {

        if(auth::user()->level->level == "Admin") {


        // retrieve users from database
            $users = User::all();

        // return view with users data
            return view('user.users', ['users' => $users]);

        } else {
            return redirect('/');
        }
        
    }

    public function dashboard()
    {
        // dd(auth::user());
        return view('dashboard');
    }

    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('name', 'password');

        if (Auth::attempt($credentials)) {
        // if the login is successful
            $user = Auth::user();
            return redirect()->intended('/dashboard');
        } else {
        // if the login is not successful
         return back()->withInput()->withErrors(['name' => 'Invalid Name or Password']);

     }
 }



 public function Logout()
 {
     Auth::logout();
     return redirect('/');

 }

 public function input()
 {
        // dd(auth::user());
    $level = Level::all();
    return view('user.input', compact('level'));
}

public function actInput(Request $request)
{
    if(auth::user()->level->level == "Admin") {
        // validate user input
        $validate = Validator::make($request->all(), [
            'username' => 'required|max:255',
            'level' => 'required',
            'email' => 'required',
        ]);
        if ($validate->fails())
        {
            $id= $request->id;
            return redirect("/users/input")
            ->withErrors($validate)
            ->withInput();
        }

        // create new user
        $pass=12345;
        $password = bcrypt($pass);
        $user = new User();
        $user->name = $request->input('username');
        $user->password = $password;
        $user->email = $request->input('email');
        $user->level_id= $request->input('level');
        $user->save();

        // redirect to users list
        return redirect('/users');

    } else {
        return redirect('/');
    }
}

public function edit($id)
{
    if(auth::user()->level->level == "Admin") {


        $user = User::where('id', $id)->first();
        $level = Level::all();
        return view('user.edit', compact('user','level'));
        
    } else {
        return redirect('/');
    }
}

public function update(Request $request)
{
    if(auth::user()->level->level == "Admin") {


        $validate = Validator::make($request->all(), [
            'username' => 'required|max:255',
            'level' => 'required',
            'email' => 'required',
        ]);
        if ($validate->fails())
        {
            $id= $request->id;
            return redirect("/users/edit/". $request->id)
            ->withErrors($validate)
            ->withInput();
        }

        $user = User::where('id', $request->id)
        ->update([
            'name' => $request->username,
            'level_id' => $request->level,
            'email' => $request->email,
        ]);
        return redirect('/users');
        
    } else {
        return redirect('/');
    }
}

public function delete($id)
{
    if(auth::user()->level->level == "Admin") {

        $worker = new Worker();
        User::where('id', $id)->delete();
        $user = new User();
        User::where('id', $id)->delete();

        // redirect to users list
        return redirect('/users');
        
    } else {
        return redirect('/');
    }
}


public function akun()
{
   $id = Auth::user()->id;

   $user = User::where('id', $id )
   ->first();

   return view('user.profile', ['user' => $user]);
}


public function password()
{
   return view('user.password');
}

public function actProfile(Request $request)
{
    $id = Auth::user()->id;
    // $oldPhoto = Auth::user()->photo;

    $validate = Validator::make($request->all(), [
        'username' => 'required',
        'email' => 'required'
    ]);
    if ($validate->fails())
    {
        $id= $request->id;
        return redirect("/akun/password/")
        ->withErrors($validate)
        ->withInput();
    }
    

    // $photo = $request->file('photo');

    // if(isset($photo) ){

    //     $extension = $photo->getClientOriginalExtension();
    //     $filename = Str::random(20) . '.' . $extension;

    //     $path = $photo->storeAs('public/images/avatar', $filename);

    //     if (!empty($oldPhoto)) {
    //         Storage::delete('public/images/avatar/' . $oldPhoto);
    //     }
    // }
    $user = User::where('id', $id)
    ->update([
        'name' => $request->input('username'),
        'email' => $request->input('email'),
        // 'photo' => $filename,
    ]);
    

    return redirect('/dashboard');
}

public function actPassword(Request $request)
{
    $id = Auth::user()->id;


    $validate = Validator::make($request->all(), [
        'password' => 'required|max:255|min:4|confirmed',
    ]);
    if ($validate->fails())
    {
        $id= $request->id;
        return redirect("/profile/password/")
        ->withErrors($validate)
        ->withInput();
    }

    $password = bcrypt($request->password);

    $user = User::where('id', $id)
    ->update([
        'password' => $password,
    ]);

    return redirect('/Logout');
}

public function reset($id)
{
    if(auth::user()->level->level == "Admin") {

        $pass = 12345;
        $password = bcrypt($pass);

        $user = User::where('id', $id)
        ->update([
            'password' => $password,
        ]);

        return redirect('/users');
        
    } else {
        return redirect('/');
    }
}

}