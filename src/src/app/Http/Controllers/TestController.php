<?php

namespace App\Http\Controllers;

use Abraham\TwitterOAuth\TwitterOAuth;

class TestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $api_key = $this->api_key = env('API_KEY');
        $api_key_secret = $this->api_key_secret = env('API_KEY_SECRET');
        $access_token =  env('ACCSESS_TOKEN');
        $access_token_secret = env('ACCSESS_TOKEN_SECRET');

        $this->connection = new TwitterOAuth($api_key, $api_key_secret, $access_token, $access_token_secret);
    }

    /**
     * #麺conterのtweetを探す
     */
    public function search_tweet()
    {
        // #麺counterのtweetを探す
        $twitter = $this->connection;
        $result = $twitter->get('search/tweets', ['q' => '#麺counter']);

        // 対象のユーザid(@から始まる)を取得
        // TODO: statusesで全部のツイートを取得して→それぞれのIDの最新ツイートを取得する
        // 返信したかどうかのフラグが必要 
        $user = $result->statuses[0]->user->screen_name;
        $tweet_id = $result->statuses[0]->id;

        $this->reply_notice($tweet_id);
        
        // 常に最新のツイートを取得
        return dd($result->statuses);
        
    }

    // 

    /**
     * botから何杯目かをリプライする
     */
    public function reply_notice($tweet_id) {
        // note: bot用のアクセストークンが必要
        $this->connection = new TwitterOAuth($this->api_key, $this->api_key_secret, env('BOT_ACCSESS_TOKEN'), env('BOT_ACCSESS_TOKEN_SECRET'));

        $content = "トータルラーメンは●●杯です〜〜〜いっぱい食べたね。";
        $bot = $this->connection;
        $result = $bot->post('statuses/update', [
            'status' => $content,
            'in_reply_to_status_id' => $tweet_id, // URLの最後の数字
            'auto_populate_reply_metadata' => true, // metadata(ユーザー情報)自動付与
            ]);

        return dd($result);

        // 雛形
        // $userさんのトータルラーメン: fuga杯
        // if placeがある場合　placenameはhoge回目です！！
        

    }
}
