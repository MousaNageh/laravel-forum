<?php

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
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home'); 
Route::get("/notifications","UserController@notifications")->name("notifications.read") ; 
Route::resource('/discussion', 'DisscussionController'); 
Route::middleware(["auth"])->post("discussion/{discussion}/reply}","RepliesController@create")->name("discussion.reply") ; 
Route::middleware(["auth"])->post("discussion/{discussion}/{reply}/best-reply}","DisscussionController@reply")->name("discussion.best-reply") ;
Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider')->name("login.google");
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
Route::delete('discussion/{reply}/delete',"RepliesController@delete")->name("reply.delete");
Route::post('discussion/{reply}/edit', "RepliesController@edit");
Route::patch("discussion/{discussion}/{reply}/update","RepliesController@update") ; 