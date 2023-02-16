<?php

namespace Darkners\DarkTelegram\Models;

use Darkners\DarkTelegram\Api;

class Message
{

    public $id;
    public $message_thread_id;
    public $from;
    public $date;
    public $chat;
    public $text;
    public $photo;

    public function __construct($message)
    {
        $this->id = $message->message_id;
        $this->message_thread_id = isset($message->message_thread_id) ? $message->message_thread_id : NULL;
        $this->from = isset($message->from) ? new User($message->from) : NULL;
        $this->date = $message->date;
        $this->chat = new Chat($message->chat);
        $this->text = $message->text;
        $this->photo = isset($message->photo) ? new Photo($$message->photo[array_key_last($$message->photo)]) : NULL;
    }

    public function edit($text, $parse_mode = NULL, $reply_markup = NULL)
    {
        $message = Api::query('editMessageText', [
            'chat_id' => $this->chat->id,
            'message_id' => $this->id,
            'text' => $text,
            'parse_mode' => $parse_mode,
            'reply_markup' => $reply_markup
        ]);

        $this->text = $message->text;
    }

    public function delete()
    {
        Api::query('deleteMessage', [
            'chat_id' => $this->chat->id,
            'message_id' => $this->id
        ]);
    }
}