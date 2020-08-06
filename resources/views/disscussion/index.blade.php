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
                    <a href="{{ route("discussion.edit",$discussion->slug)}}" class="btn btn-success"> edit</a>
                    <a href="" class="btn btn-danger" data-toggle="modal" data-target="#deleteDiscussion"> delete</a>
                </span>
            @endif
            @endauth
        </div>
        
        <div class="card-body"> 
            <h2 class="h1 text-center"> {{$discussion->title}}  </h2>
        
            <a href="{{route("discussion.show",$discussion->slug)}}" class="btn btn-info"> view and make reply </a> 

        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="deleteDiscussion" tabindex="-1" role="dialog" aria-labelledby="deleteDiscussionLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="deleteDiscussionLabel">delete {{$discussion->title}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            are you sure you wqant to delete this discussion
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <form action="{{route("discussion.destroy",$discussion->slug)}}" method="POST" style="display: inline">
                @csrf
                @method("DELETE") 
            <input type="submit" value="delete" class="btn btn-danger">
            </form>
        </div>
        </div>
    </div>
    @endforeach
    
    {{$discussions->appends(["channel"=>request()->query("channel")])->links()}}

@endsection


