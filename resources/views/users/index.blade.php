@extends('layouts.app')
@section('content')
    <p id="explanation"><strong>フォルダにツイートを分類するは、フォルダとツイートにチェックを入れ、ページ下の分類ボタンを押してください<br>
    または、ツイートとフォルダにチェックを入れ、ツイートをファイルの上でドロップしてください<br>
    最新のツイートを取得するには、再ログインしてください</strong></p>


    <form action="{{ route('tweets_folder_store') }}" method="post">
        @csrf
        <div class="allFolder">
            <h4>フォルダ一覧</h4>
            @if($folders->isEmpty())
                <p>フォルダはまだ作成されていません</p>
            @else
                @if($user->id == Auth::id())
                    <p>移動したいフォルダにチェックを入れてください</p>
                    @foreach($folders as $folder)  
                        <div class="folder" ondragover="dragover(event)"  ondrop="drop(event)">     
                            <li><img src="{{ asset('images/folder.png') }}" alt="フォルダ" width=80 height=70></li>
                            <input type="checkbox" class="folder_checkbox" name="folder" value="{{$folder->id}}"><a href="{{route('folder_index', $folder->id)}}">{{ $folder->name }}</a>
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

        <div class="allTweet">
            <h4>ツイート一覧</h4>
            
            @if($tweets->isEmpty())
                <p>まだツイートはありません</p>
            @else
                @if($user->id == Auth::id())
                    <p>移動させたいツイートにチェックを入れてください(複数選択可)</p>
                    <div class="scrollArea">
                        @foreach($tweets as $tweet)
                            <div ondragstart="dragstart(event)">
                                <div class="tweet" draggable="true">
                                    <li><input type="checkbox" class="tweet_checkbox" name="tweet[]" value="{{$tweet->id}}">{{ $tweet->text }}</li>   
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <input type="submit" value="divide" id="divide_btn" onclick="return confirmDivide()">
                @else
                    <div class="scrollArea">
                        @foreach($tweets as $tweet)
                            <div class="tweet">
                                <li style="list-style-type: square">{{ $tweet->text }}</li>   
                            </div>
                        @endforeach
                    </div>
                @endif
            @endif
        </div>
    </form>
    
@endsection