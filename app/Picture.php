<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    //
    protected $fillable = [
        'path','extension','name','user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
