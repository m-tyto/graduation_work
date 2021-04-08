@extends('layouts.app')
@section('content')

    <p><strong>フォルダにツイートを分類するは、フォルダとツイートにチェックを入れ、ページ下の分類ボタンを押してください</strong></p>
    <a href="{{route('get_new_tweet', $user->id)}}"><img src="{{asset('images/update.png')}}" alt="最新のツイートを取得する" width=50 height=30></a>

    <form action="{{ route('tweets_folder_store') }}" method="post">
        @csrf
        <div class="allFolder"  ondragover="dragover(event)"  ondrop="drop(event)">
            <h4>フォルダ一覧</h4>
            @if($folders->isEmpty())
                <p>フォルダはまだ作成されていません</p>
            @else
                @if($user->id == Auth::id())
                    <p>移動したいフォルダにチェックを入れてください</p>
                    @foreach($folders as $folder)  
                        <div class="folder">
                            <a href="{{route('folder_index', $folder->id)}}">
                            <li><img src="{{ asset('images/folder.png') }}" alt="フォルダ" width=80 height=70></li>
                            <li><input type="checkbox" class="folder_checkbox" name="folder" value="{{$folder->id}}">{{ $folder->name }}</li>
                            </a>
                        </div>
                    @endforeach
                @else
                    @foreach($folders as $folder)  
                        <div class="folder">
                            <a href="{{route('folder_index', $folder->id)}}">
                            <li><img src="{{ asset('images/folder.png') }}" alt="フォルダ" width=80 height=70></li>
                            <li>{{ $folder->name }}</li>
                            </a>
                        </div>
                    @endforeach
                @endif
            @endif
        </div>

        
        <h4>ツイート一覧</h4>
        
        @if($tweets->isEmpty())
            <p>まだツイートはありません</p>
        @else
            @if($user->id == Auth::id())
                <p>移動させたいツイートにチェックを入れてください(複数選択可)</p>
                @foreach($tweets as $tweet)
                    <div name="allTweet"  ondragstart="dragstart(event)">
                        <div class="tweet" draggable="true">
                            <li><input type="checkbox" class="tweet_checkbox" name="tweet[]" value="{{$tweet->id}}">{{ $tweet->text }}</li>   
                        </div>
                    </div>
                @endforeach
                <input type="submit" value="分類" id="divide_btn" onclick="return confirmDivide()">
            @else
                @foreach($tweets as $tweet)
                    <div name="allTweet">
                        <div class="tweet">
                            <li>{{ $tweet->text }}</li>   
                        </div>
                    </div>
                @endforeach
            @endif
        @endif
    </form>
    
@endsection