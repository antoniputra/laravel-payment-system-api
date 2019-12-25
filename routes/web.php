<?php

use App\User;
use App\Jobs\SendSampleMail;
use App\Mail\SampleMail;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

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
    return view('welcome');
});

Route::get('mailable', function () {
    $user = App\User::find(1);

    return new SampleMail($user);
});

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
