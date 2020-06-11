<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    //
    protected $fillable = [
        'user_id','second_user_id'
    ];


    public function messages(){
        return $this->hasMany(Message::class);
    }
}
