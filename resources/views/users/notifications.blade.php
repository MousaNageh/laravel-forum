@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header"> <h3>notifications</h3></div>
    <div class="card-body">
        <ul class="list-group mb-2 ">
            @foreach ($notifications as $notification)
                @if ($notification->type == "App\Notifications\NewReplyAdded")
                    <li class="list-group-item">
                        a new reply added to your discussion of <strong> " {{$notification->data["discussion"]["title"] }} "</strong> 
                        <a href="{{route("discussion.show",$notification->data["discussion"]["slug"])}}" class="btn btn-info btn-sm float-right"> view </a>
                    </li> 
                @endif
                @if ($notification->type == "App\Notifications\MarkAsBestReply")
                <li class="list-group-item">
                    your reply  on discussion of <strong> " {{$notification->data["bestReply"]["title"] }} " maked as best reply </strong> 
                    <a href="{{route("discussion.show",$notification->data["bestReply"]["slug"])}}" class="btn btn-info btn-sm float-right"> view </a>
                </li> 
                @endif
                
            @endforeach
            
        </ul> 
        {{$notifications->links()}}
    </div>
</div>
@endsection