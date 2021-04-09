<div class="header">
@if($user->icon_img)
    <li class="header_elements"><a href="{{route('user_home', $user->id)}}"><img id="icon" src="{{ $user->icon_img }}" alt="twitter_icon"></a></li>
@endif

@guest
    <a href="/auth/twitter" class="header_element">ログイン</a>
    
@else
    @if($user->id == Auth::id())
        <li class="header_elements"><a href="{{route('folder_create')}}">フォルダを作成する</a></li>
        <li class="header_elements"><a href="/auth/twitter/logout">ログアウト</a></li>
    @else
    <li class="header_elements"><a href="{{route('user_home', Auth::id())}}">マイページ</a></li>
    @endif
@endauth
</div>
<h1>TWEETSFOLDER</h1>
<p>ツイートを自分なりに分類してみよう！</p>
<p>ツイッター名</p>
<h4>{{ $user->nickname }}</h4>
