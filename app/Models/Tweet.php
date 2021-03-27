<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    public function user(){
        return $this->belongsTo("App\User");
    }

    public function folders(){
        return $this->belongsToMany('App\Http\Models\Folder',
                                    'folders_tweets',
                                    'tweet_id',
                                    'folder_id');
    }
}
