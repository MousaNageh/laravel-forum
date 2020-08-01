<?php

namespace App\Http\Controllers;

use App\Discussion;
use App\Http\Requests\CreateDisscussionRequest;
use App\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str ; 

class DisscussionController extends Controller
{
    public function __construct()
    {
        $this->middleware(["auth","verified"])->only(["create","store"]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        
        
            return view("disscussion.index")->with("discussions",Discussion::FilterByChannel()->paginate(2)) ;
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("disscussion.create") ; 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDisscussionRequest $request)
    {
        auth()->user()->discussion()->create([
            "title"=>$request->title , 
            "content"=>$request->content , 
            "channel_slug"=>$request->channel , 
            "slug"=>Str::slug($request->title) 
        ]) ; 
        session()->flash("success","the disscussion created successfully") ; 
        return redirect(route("discussion.index")) ; 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Discussion $discussion)
    {
        return view("disscussion.show")
        ->with("discussion",$discussion)
        ->with("replies",$discussion->reply()->paginate(3)) ; 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function reply(Discussion $discussion , Reply $reply){
        $discussion->MarkAsBestReply($reply) ;
        session()->flash("success","this reply is marked as best reply successfully") ;  
        return redirect()->back() ; 
    }
}
