<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function notifications(){
        auth()->user()->unreadNotifications->markAsread() ; 
        //auth()->user()->notifications 
        return view("users.notifications")->with("notifications",auth()->user()->notifications()->paginate(5)) ; 
    }
}
