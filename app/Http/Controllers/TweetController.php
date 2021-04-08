<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Abraham\TwitterOAuth\TwitterOAuth;
use App\Models\Tweet;
use App\User;
use App\Models\Folder;
use Illuminate\Support\Facades\Auth;
use App\Models\Folder_Tweet;
use Validator;

class TweetController extends Controller
{
    public function tweets_folder(Request $request){
        $this->validate($request,[
            'folder' => 'required',
            'tweet' => 'required'
        ],[
            'folder.required' => '対象フォルダを選択してください',
            'tweet.required' => '移動対象のツイートを選択してください'
        ]);
        $folder = $request->folder;
        foreach($request->tweet as $tweet){
            $t_f = Folder_Tweet::where('folder_id', $folder)->where('tweet_id', $tweet)->get();
            //重複なしにする
            if(!$t_f->isEmpty()){
                continue;
            }
            Folder_Tweet::create([
                'folder_id' => $folder,
                'tweet_id' => $tweet
            ]);
        }
        $user = Folder::select('user_id')->where("id", $folder)->first();
        session()->flash('flash_message', 'ツイートを分類しました');
        return redirect()->route('user_home', $user->user_id);
    }

    public function get_new_tweet($id){
        $new_tweet = app()->make('App\Http\Controllers\Auth\TwitterController');
        $new_tweet->tweets_store($id);
        return redirect()->route('user_home', $id);
    }
}
