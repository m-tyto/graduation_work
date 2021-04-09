<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Folder_Tweet extends Model
{
    protected $table = 'folders_tweets';
    protected $fillable = ['folder_id','tweet_id'];
}
