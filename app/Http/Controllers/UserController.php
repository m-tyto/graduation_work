<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Abraham\TwitterOAuth\TwitterOAuth;
use App\User;
use App\Models\Folder;
use App\Models\Tweet;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index($id){
        $user = User::find($id);
        $folders = Folder::where("user_id", $id)->get();
        $tweets = Tweet::where("user_id", $id)->orderBy('id', 'desc')->get();

        return view('users.index', [
            "user" => $user,
            "folders" => $folders,
            "tweets" => $tweets
        ]);
    }
}
