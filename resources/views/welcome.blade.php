<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title></title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">   
    </head>
    <body>
        <div class="flex-center position-ref full-height">

            <div class="content">
                <h1>TWEETSFOLDER</h1>
                <p>twitterでログインしてツイートを分類しよう！</p>

                <div class="links">
                    <a href="{{route('login')}}" class="link"s>ログイン</a>
                    <a href="{{route('logout')}}" class="link">ログアウト</a>
                </div>
            </div>
        </div>
    </body>
</html>
