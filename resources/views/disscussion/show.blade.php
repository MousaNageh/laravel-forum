@extends('layouts.app')

@section('content')
    
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
        {!! $discussion->content !!}
        <a href="{{url()->previous() }}" class="btn btn-info"> back </a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3>Replies</h3>
    </div>
    <div class="card-body"> 
        @if ( $discussion->bestRely()->count()>0)
        <div class="alert alert-info" style="border-radius: 15px">
            <h2 class="text-center">best reply</h2>
            <div class="my-3 d-flex justify-content-between" >
                <span>
                    <img src="{{Gravatar::src( $discussion->bestRely->author->email) }}" alt="" style="width: 40px ; height: 40px ; border-radius: 50%">
                    <span class="font-weight-bold">{{$discussion->bestRely->author->name}}</span>
                </span>
                <span> 
                    @auth
                        @if (auth()->user()->id == $discussion->bestRely->author->id)
                            <a href="#" class="btn btn-success btn-sm"> edit</a> 
                            <a href="#" class="btn btn-danger btn-sm"> delete</a>
                        @endif
                        @if (auth()->user()->id==$discussion->id)
                        @endif
                    @endauth
                    
                </span>
            </div>
            {!! $discussion->bestRely->content !!} 
        </div>
        @endif
        @foreach ($replies as $reply)
        <div class="alert alert-success " style="border-radius: 15px"> 
            <div class="my-3 d-flex justify-content-between">
                <span>
                    <img src="{{Gravatar::src($reply->author->email) }}" alt="" style="width: 40px ; height: 40px ; border-radius: 50%">
                    <span class="font-weight-bold">{{$reply->author->name}}</span>
                </span>
                <span> 
                    @auth
                        @if (auth()->user()->id == $reply->author->id)
                            <a href="#" class="btn btn-success btn-sm"> edit</a> 
                            <a href="#" class="btn btn-danger btn-sm"> delete</a>
                        @endif
                        @if (auth()->user()->id==$discussion->id)
                            <form action="{{ route("discussion.best-reply",
                            ["discussion"=>$discussion->slug , 
                            "reply"=>$reply->id
                            ])
                            }}" method="post" style="display: inline">
                                @csrf 
                                <input type="submit" value="mark it as best reply" class="btn btn-info btn-sm">
                            </form>
                        @endif
                    @endauth
                </span>
            </div>
            {!! $reply->content !!} 
            
        </div>
        @endforeach
        <h4>read more replies</h4>
        {{$replies->links()}}
        <form action="{{ route("discussion.reply",$discussion->slug) }}" method="POST">
            @csrf 
            <div class="form-group">
                <label for="reply" class="font-italic font-weight-bold"> make reply </label> 
                <input id="reply" type="hidden" name="reply" required>
                <trix-editor input="reply"></trix-editor>
            </div> 
            <input type="submit" value="make reply" class="btn btn-success">
        </form>

    </div>
</div>
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.min.js"></script>    
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.min.css">
@endsection