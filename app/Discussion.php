<?php

namespace App;

use App\Notifications\MarkAsBestReply;

class Discussion extends Model
{ 
    public function getRouteKeyName()
    {
        return "slug" ; 
    }
    public function owner(){
        return $this->belongsTo(User::class,"user_id") ; 
    } 
    public function reply(){
        return $this->hasMany(Reply::class) ; 
    }
    public function MarkAsBestReply(Reply $reply) {
        $this->update([
            "reply_id"=>$reply->id
        ]) ;  
        $reply->author->notify(new MarkAsBestReply($reply->discussion)) ;    

    }
    public function bestRely(){
        return $this->belongsTo(Reply::class,"reply_id") ; 
    }
    public function scopeFilterByChannel($builder){
        if(request()->query("channel")){
            $channel = Channel::where("slug",request()->query("channel")) ; 
        if($channel) {
            return $builder->where("channel_slug",request()->query("channel")) ; 
        }
        return $builder ; 
        }
        return $builder ; 
        
    }
}
