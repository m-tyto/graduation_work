<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    protected $fillable = ['user_id', 'text'];
    public function user(){
        return $this->belongsTo("App\User");
    }

    public function folders(){
        return $this->belongsToMany('App\Models\Folder', 'folders_tweets');
    }
}
