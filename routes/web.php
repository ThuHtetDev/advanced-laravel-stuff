<?php

use App\Models\User;
use App\Notifications\TaskCompleted;
use App\Notifications\WorkDoneNoti;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $user = User::find(1);
    $user->notify(new TaskCompleted);
    dd('success with queue');
    return view('welcome');
});

Route::get('/workdone',function(){
    $user = User::find(1);
    $user->notify(new WorkDoneNoti);
    dd('database notification done');
});

Route::get('getNoti',function(){
    $user = App\Models\User::find(1);

    foreach ($user->notifications as $notification) {
        echo $notification->data['data'] .'<br>';
    }
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
