@extends('layouts.app')

@section('content')
    @foreach ($discussions as $discussion)
    <div class="card mb-3">
        <div class="card-header d-flex justify-content-between">
            <span>
                <img src="{{ Gravatar::src($discussion->owner->email)}}" alt="notfound" style="width: 40px ; height: 40px; border-radius: 50%">
                <span class="font-weight-bold"> {{ $discussion->owner->name }}</span>
            </span> 
            @auth
                @if (auth()->user()->id == $discussion->user_id)
                <span>
                    <a href="#" class="btn btn-success"> edit</a>
                    <a href="#" class="btn btn-danger"> delete</a>
                </span>
            @endif
            @endauth
            
        </div>
        <div class="card-body"> 
            <h2 class="h1 text-center"> {{$discussion->title}}  </h2>
        
            <a href="{{route("discussion.show",$discussion->slug)}}" class="btn btn-info"> view and make reply </a> 

        </div>
    </div>
    @endforeach
    
    {{$discussions->appends(["channel"=>request()->query("channel")])->links()}}

@endsection