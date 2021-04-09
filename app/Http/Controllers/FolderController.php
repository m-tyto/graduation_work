<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Folder;
use App\Models\Tweet;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Validation\Rule;
use App\Models\Folder_Tweet;

class FolderController extends Controller
{
    public function create(){
        $user = User::find(Auth::id());
        return view('folders.create',[
            "user" => $user
        ]);
    }

    public function store(REQUEST $request){
        $this->validate($request,[
            'name' => 'required',
        ],[
            'name.required' => "フォルダ名を入力してください"
        ]);

        Folder::create($request->all());
        session()->flash('flash_message', 'フォルダを作成しました');
        return redirect()->route('user_home', Auth::id());

    }

    public function index($id){
        $folder = Folder::find($id);
        $tweets = $folder->tweets;
        $user = User::find(Auth::id());
        return view('folders.index',[
            'user' => $user,
            'folder' => $folder,
            'tweets' => $tweets
        ]);
    }
}
