<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{

    protected $fillable = [
        'urlExtra','article_id'
    ];

    public function article(){
        return $this->belongsTo(Article::class,'article_id');
    }
}
