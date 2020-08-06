@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        @isset($discussion)
            <h3> Edit Discussion</h3>
        @else
            <h3>create Discussion</h3>
        @endisset
        
    </div>
        <form action="
        @isset($discussion)
            {{ route("discussion.update",$discussion->slug)}}
        @else
            {{ route("discussion.store") }}
        @endisset
        " class="m-4" method="POST">
            @csrf
            @isset($discussion)
            @method("PUT")
            @endisset
            <div class="form-group">
                <label for="title" class="font-italic font-weight-bold"> title</label> 
                <input type="text" name="title" required class="form-control" 
                value="@isset($discussion){{ $discussion->title}}@endisset">
            </div> 
            <div class="form-group">
                <label for="content" class="font-italic font-weight-bold"> content</label> 
                <input id="content" type="hidden" name="content" value="@isset($discussion){{ $discussion->content}}@endisset" required>
                <trix-editor input="content"></trix-editor>
            </div>
            <div class="form-group">
                <label for="channel" class="font-italic font-weight-bold"> choose channel </label>
                <select name="channel" id="channel" class="form-control">
                    @foreach ($channels as $channel)
                        <option value="{{$channel->slug }}"
                            @isset($discussion)
                                @if ($discussion->channel_slug ==$channel->slug)
                                    selected 
                                @endif
                            @endisset
                            > {{$channel->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <input type="submit" value="create" class="btn btn-success btn-lg" >
            </div>
        </form>
    <div class="card-body">
        
    </div>
</div>
@endsection 
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.min.js"></script>    
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.min.css">
@endsection