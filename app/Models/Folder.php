<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    public function tweets(){
        return $this->belongsToMany('App\Http\Models\Folder',
                                    'folders_tweets',
                                    'folder_id',
                                    'tweet_id');
    }
}
