<?php

namespace App\Http\Controllers;

use App\Discussion;
use App\Http\Requests\CreateReplyRequest;
use App\Notifications\NewReplyAdded;
use App\Reply;
use Illuminate\Http\Request;

class RepliesController extends Controller
{
    public function create(CreateReplyRequest $request , Discussion $discussion) {
        Reply::create([
            "user_id"=>auth()->user()->id , 
            "discussion_id"=> $discussion->id , 
            "content"=>$request->reply
        ]) ; 
        if(auth()->user()->id != $discussion->owner->id){
            $discussion->owner->notify(new NewReplyAdded($discussion)) ; 
        }
        session()->flash("success" , "reply created successfully") ; 
        return redirect()->back() ; 
    }
}
