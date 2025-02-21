<?php

namespace NSO;

use Illuminate\Support\Facades\Http;

class Telegram
{
    public static function send($chat_id, $content)
    {
        $token = env('TELEGRAM_BOT_TOKEN');
        $url = "https://api.telegram.org/bot{$token}/sendMessage";

        $res = Http::post($url, [
            'chat_id' => $chat_id,
            'text' => $content,
            'parse_mode' => 'Markdown'
        ]);
        return $res->json();
    }
}
