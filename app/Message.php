<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $fillable = [
        'body','read','user_id','conversation_id'
    ];

    public function conversation(){
        return $this->belongsTo(Conversation::class);
    }
}
