<?php

use Illuminate\Support\Facades\Route;
use App\Models\products;
use App\Models\Topic;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
})->name('login');

Route::get('/Logout', 'App\Http\Controllers\UserController@Logout');

Route::post('/actlogin', 'App\Http\Controllers\UserController@login');


Route::middleware(['auth'])->group(function () {

    Route::get('/laporan', function () {
        return view('laporan');});

    Route::get('/dashboard', 'App\Http\Controllers\UserController@dashboard');
    Route::get('/profile', 'App\Http\Controllers\UserController@akun');
    Route::get('/profile/password', 'App\Http\Controllers\UserController@password');

    Route::post('/profile/actProfile', 'App\Http\Controllers\UserController@actProfile');
    Route::post('/profile/actPassword', 'App\Http\Controllers\UserController@actPassword');

//user table
    Route::get('/users', 'App\Http\Controllers\UserController@index');
    // Route::get('/users/input', 'App\Http\Controllers\UserController@input');
    Route::get('/users/reset/{id}', 'App\Http\Controllers\UserController@reset');
    // Route::get('/users/edit/{id}', 'App\Http\Controllers\UserController@edit');
    // Route::get('/users/actdelete/{id}', 'App\Http\Controllers\UserController@delete');

    // Route::post('/users/update', 'App\Http\Controllers\UserController@update');
    // Route::post('/users/actinput', 'App\Http\Controllers\UserController@actInput');

//workers table
    Route::get('/workers', 'App\Http\Controllers\WorkerController@index');
    Route::get('/workers/actdelete/{id}', 'App\Http\Controllers\WorkerController@delete');
    Route::get('/workers/edit/{id}', 'App\Http\Controllers\WorkerController@edit');
    Route::get('/workers/input', 'App\Http\Controllers\WorkerController@input');

    Route::post('/workers/update', 'App\Http\Controllers\WorkerController@update');
    Route::post('/workers/actinput', 'App\Http\Controllers\WorkerController@actInput');

//products table

    Route::get('/products', 'App\Http\Controllers\ProductController@index');
    Route::get('/products/actdelete/{id}', 'App\Http\Controllers\ProductController@delete');
    Route::get('/products/edit/{id}', 'App\Http\Controllers\ProductController@edit');
    Route::get('/products/input','App\Http\Controllers\ProductController@show');

    Route::post('/products/pdf', 'App\Http\Controllers\ProductController@exportPdf');
    Route::post('/products/excel', 'App\Http\Controllers\ProductController@exportExcel');
    Route::post('/products/update', 'App\Http\Controllers\ProductController@update');
    Route::post('/products/actinput', 'App\Http\Controllers\ProductController@input');

    

//transactions in table

    Route::get('/transaction_in', 'App\Http\Controllers\transaction_inController@index');
    Route::get('/transaction_in/actdelete/{id}', 'App\Http\Controllers\transaction_inController@delete');
    Route::get('/transaction_in/details/{id}', 'App\Http\Controllers\transaction_inController@detail');
    Route::get('/transaction_in/edit/{id}', 'App\Http\Controllers\transaction_inController@edit');
    Route::get('/transaction_in/input', 'App\Http\Controllers\transaction_inController@show');

    Route::post('/transaction_in/pdf', 'App\Http\Controllers\transaction_inController@exportPdf');
    Route::post('/transaction_in/excel', 'App\Http\Controllers\transaction_inController@exportExcel');
    Route::post('/transaction_in/update', 'App\Http\Controllers\transaction_inController@update');
    Route::post('/transaction_in/actinput', 'App\Http\Controllers\transaction_inController@input');

//transactions out table

    Route::get('/transaction_out', 'App\Http\Controllers\transaction_outController@index');
    Route::get('/transaction_out/actdelete/{id}', 'App\Http\Controllers\transaction_outController@delete');
    Route::get('/transaction_out/details/{id}', 'App\Http\Controllers\transaction_outController@detail');
    Route::get('/transaction_out/edit/{id}', 'App\Http\Controllers\transaction_outController@edit');
    Route::get('/transaction_out/input', 'App\Http\Controllers\transaction_outController@show');

    Route::post('/transaction_out/pdf', 'App\Http\Controllers\transaction_outController@exportPdf');
    Route::post('/transaction_out/excel', 'App\Http\Controllers\transaction_outController@exportExcel');
    Route::post('/transaction_out/update', 'App\Http\Controllers\transaction_outController@update');
    Route::post('/transaction_out/actinput', 'App\Http\Controllers\transaction_outController@input');


    Route::get('/departments', 'App\Http\Controllers\DepartmentController@index');
    // Route::get('/departments/actdelete/{id}', 'App\Http\Controllers\DepartmentController@delete');
    Route::get('/departments/edit/{id}', 'App\Http\Controllers\DepartmentController@edit');
    Route::get('/departments/input', 'App\Http\Controllers\DepartmentController@show');
    Route::get('/departments/reset/{id}', 'App\Http\Controllers\DepartmentController@reset');
    Route::get('/departments/members/{id}', 'App\Http\Controllers\DepartmentController@members');
    Route::get('/departments/members/input/{id}',
      'App\Http\Controllers\DepartmentController@inputMember');
    // Route::get('/departments/members/edit/{id}', 'App\Http\Controllers\DepartmentController@editMember');
    Route::get('/departments/members/delete/{id}', 'App\Http\Controllers\DepartmentController@deleteMember');


    Route::post('/departments/update', 'App\Http\Controllers\DepartmentController@update');
    Route::post('/departments/actinput', 'App\Http\Controllers\DepartmentController@input');
    Route::post('/departments/search', 'App\Http\Controllers\DepartmentController@search');

    Route::post('/departments/members/actinput',
      'App\Http\Controllers\DepartmentController@actInputMember');

    Route::post('/departments/members/search/{id}', 'App\Http\Controllers\DepartmentController@memberSearch');

    Route::get('/tickets', 'App\Http\Controllers\TicketController@index');
    Route::get('/tickets/assign', 'App\Http\Controllers\TicketController@assigned');
    Route::get('/tickets/made', 'App\Http\Controllers\TicketController@made');
    Route::get('/tickets/actdelete/{id}', 'App\Http\Controllers\TicketController@delete');
    Route::get('/tickets/edit/{id}', 'App\Http\Controllers\TicketController@edit');
    Route::get('/tickets/input', 'App\Http\Controllers\TicketController@show');
    Route::get('/tickets/reset/{id}', 'App\Http\Controllers\TicketController@reset');
    Route::get('/tickets/details/{id}', 'App\Http\Controllers\TicketController@details');
    Route::get('/tickets/assign/{id}', 'App\Http\Controllers\TicketController@assign');
    Route::get('/tickets/actOpen/{id}', 'App\Http\Controllers\TicketController@actOpen');
    Route::get('/tickets/actClose/{id}', 'App\Http\Controllers\TicketController@actClose');


    Route::post('/tickets/actinput', 'App\Http\Controllers\TicketController@input');
    Route::post('/tickets/details/input/{id}','App\Http\Controllers\TicketController@inputDetail');
    Route::post('/tickets/search', 'App\Http\Controllers\TicketController@search');
    Route::post('/tickets/details/','App\Http\Controllers\TicketController@actInputMember');
    Route::post('/tickets/actAssign/{id}', 'App\Http\Controllers\TicketController@actAssign');
    Route::post('/tickets/actRating/{id}', 'App\Http\Controllers\TicketController@actRating');

//topic table
    Route::get('/topics', 'App\Http\Controllers\TopicController@index');
    Route::get('/topics/input', 'App\Http\Controllers\TopicController@show');
    Route::get('/topics/edit/{id}', 'App\Http\Controllers\TopicController@edit');

    Route::post('/topics/update', 'App\Http\Controllers\TopicController@update');
    Route::post('/topics/actinput', 'App\Http\Controllers\TopicController@actInput');


    Route::get('/tickets/{department_id}/topics', function($department_id) {
       $topics = Topic::where('department_id', $department_id)->pluck('name', 'id');
       return $topics;
   });
});
