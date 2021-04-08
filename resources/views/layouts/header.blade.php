<h1>TWEETSFOLDER</h1>
<p>ツイートを自分なりに分類してみよう！</p>
<h5>{{ $user->nickname }}</h5>
@if($user->icon_img)
    <li><a href="{{route('user_home', $user->id)}}"><img src="{{ $user->icon_img }}" alt="twitter_icon"></a></li>
@endif

@guest
    <a href="/auth/twitter">ログイン</a>
    
@else
    @if($user->id == Auth::id())
        <li><a href="{{route('folder_create')}}">フォルダを作成する</a></li>
        <li><a href="/auth/twitter/logout">ログアウト</a></li>
    @endif
@endauth