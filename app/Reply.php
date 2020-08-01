<?php

namespace App;


class Reply extends Model
{
    public function author(){
        return $this->belongsTo(User::class,"user_id") ; 
    }
    public function discussion(){
        return $this->belongsTo(Discussion::class) ; 
    }
}
