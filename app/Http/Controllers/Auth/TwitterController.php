<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Socialite;
use App\User;
use Illuminate\Support\Facades\Auth;
use Abraham\TwitterOAuth\TwitterOAuth;
use App\Models\Tweet;

class TwitterController extends Controller
{

    public function TwitterRedirect()
    {
        return Socialite::driver('twitter')->redirect();
    }

    public function TwitterCallback()
    {
        //TwitterOAuthのインスタンスを生成し、Twitterからリクエストトークンを取得する
        $connection = new TwitterOAuth(env('TWITTER_CLIENT_ID'), env('TWITTER_CLIENT_SECRET'));
        $request_token = $connection->oauth("oauth/request_token", array("oauth_callback" => env('TWITTER_CALLBACK_URL')));
        
        //リクエストトークンはcallback.phpでも利用するのでセッションに保存する
        $_SESSION['oauth_token'] = $request_token['oauth_token'];
        $_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

        //oauth_tokenとoauth_verifierを取得
        $connection = new TwitterOAuth(env('TWITTER_CLIENT_ID'), env('TWITTER_CLIENT_SECRET'), $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
        $access_token = $connection->oauth('oauth/access_token', array('oauth_verifier' => $_GET['oauth_verifier'], 'oauth_token'=> $_GET['oauth_token']));
        
        try {
            // OAuthユーザー情報を取得
            $social_user = Socialite::driver('twitter')->userFromTokenAndSecret($access_token['oauth_token'], $access_token['oauth_token_secret']);
        } 
        catch (\Exception $e) {
            return redirect('/')->with('oauth_error', 'ログインに失敗しました');
            // エラーならログイン画面へ転送
        }
        
        $user = $this->first_or_create_social_user('twitter', $social_user->id, $social_user->name, $social_user->avatar, $social_user->nickname );

        // Laravel 標準の Auth でログイン
        Auth::login($user);

        $this->tweets_store(Auth::id(), $access_token);
        
        return redirect(route('user_home', Auth::id()));
    }

    /**
     * ログインしたソーシャルアカウントがDBにあるかどうか調べます
     *
     * @param   string      $service_name       ( twitter , facebook ... )
     * @param   int         $social_id          ( 123456789 )
     * @param   string      $social_avatar      ( https://....... )
     *
     * @return  \App\User   $user
     *
     */
    protected function first_or_create_social_user( string $service_name,
                                                int $social_id, string $social_name, string $social_avatar, string $nickname)
    {
        $user = null;
        $user = \App\User::where( "name", '=', $nickname )->first();
        if ( $user === null ){
            $user = new \App\User();
            $user->fill( [
                "{$service_name}_id" => $social_id ,
                'name'               => $nickname ,
                'nickname'           => $social_name,
                'icon_img'           => $social_avatar ,
                'password'           => 'DUMMY_PASSWORD' ,
            ] );
            $user->save();
            return $user;
        }
        else{
            return $user;
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }

    public function tweets_store($user_id, $access_token){

        $oauth = new TwitterOAuth(env('TWITTER_CLIENT_ID'), env('TWITTER_CLIENT_SECRET'), $access_token['oauth_token'], $access_token['oauth_token_secret']);
        $user = User::find($user_id);
        //ツイート一覧を取得
        $tweets = $oauth->get('statuses/user_timeline', array(
            "screen_name" => $user->name,
            'exclude_replies'   => 'true',
            'include_rts'       => 'false',
            'count'             => '200',
        ));
        $tweets = array_reverse($tweets);

        foreach($tweets as $tweet){
            $old_tweet = Tweet::where('text', '=', $tweet->text)->get();
            if(!$old_tweet->isEmpty()){
                continue;
            } 
            Tweet::create([
                'user_id' => $user_id,
                'text' => $tweet->text
            ]);
        }

        
    }
}