<?php

namespace Darkners\DarkTelegram\Models;

use Darkners\DarkTelegram\Api;

class Callback
{

    public $id;
    public $from;
    public $message;
    public $inline_message_id;
    public $chat_instance;
    public $data;
    public $game_short_name;

    public function __construct($callback_query)
    {
        $this->id = $callback_query->id;
        $this->from = new User($callback_query->from);
        $this->message = isset($callback_query->message) ? new Message($callback_query->message) : NULL;
        $this->inline_message_id = isset($callback_query->inline_message_id) ? $callback_query->inline_message_id : NULL;
        $this->data = isset($callback_query->data) ? $callback_query->data : NULL;
    }

    public function __destruct()
    {
        $this->answer();
    }

    public function answer($text = NULL, $show_alert = false, $url = NULL, $cache_time = 0)
    {
        Api::query('answerCallbackQuery', [
            'callback_query_id' => $this->id,
            'text' => $text,
            'show_alert' => $show_alert,
            'url' => $url,
            'cache_time' => $cache_time
        ]);
    }

}