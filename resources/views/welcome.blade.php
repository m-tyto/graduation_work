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
                <div class="title m-b-md">
                    TWEETSFOLDER
                </div>
                <p>twitterでログインしてツイートを分類しよう！</p>

                <div class="links">
                    <a href="/auth/twitter">ログイン</a>
                    <a href="/auth/twitter/logout">ログアウト</a>
                </div>
            </div>
        </div>
    </body>
</html>
