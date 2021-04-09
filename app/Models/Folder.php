<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    protected $fillable = ['name', 'user_id'];

    public function tweets(){
        return $this->belongsToMany('App\Models\Tweet','folders_tweets');
    }

    public function user(){
        return $this->belongsTo("App\User");
    }

}
