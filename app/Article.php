<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
}
