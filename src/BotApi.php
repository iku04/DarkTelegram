<?php

namespace Darkners\DarkTelegram;

use Darkners\DarkTelegram\Models\Callback;
use Darkners\DarkTelegram\Models\User;
use Darkners\DarkTelegram\Models\Chat;
use Darkners\DarkTelegram\Models\Message;

class DarkTelegram {

    public $data;
    public $chat_id;
    private $command = NULL;

    private $callback = NULL;
    
    public function __construct($token)
    {
        file_put_contents('query.json', file_get_contents('php://input'));
        $this->data = json_decode(file_get_contents('php://input'));

        Api::init($token);
    }


    public function init(&$user = NULL, &$chat = NULL, &$message = NULL)
    {
        if (isset($this->data->message)) {
            $this->chat_id = $this->data->message->chat->id;
            $user = new User($this->data->message->from);
            $chat = new Chat($this->data->message->chat);

            $this->command = $this->data->message->text[0] == '/' ? explode(' ', $this->data->message->text) : NULL;

        } elseif (isset($this->data->callback_query)) {
            $this->chat_id = $this->data->callback_query->message->chat->id;
            $this->callback = new Callback($this->data->callback_query);
            $user = new User($this->data->callback_query->message->from);
            $chat = new Chat($this->data->callback_query->message->chat);
        }
        $message = isset($this->data->message) ? new Message($this->data->message) : NULL;
    }


    public function command($command, $function)
    {
        if ($this->command != NULL && $this->command[0] == '/'.$command) $function($this, $this->command);
    }

    public function message($function)
    {
        if (isset($this->data->message) && $this->command == NULL) $function($this, $this->data->message->text);
    }

    public function callback($data, $function)
    {
        if ($this->callback != NULL && $this->callback->data != NULL && $this->callback->data == $data) $function($this, $this->callback);
    }


    public function sendMessage($chat_id, $text, $parse_mode = NULL, $reply_to_message_id = NULL, $reply_markup = NULL)
    {
        $message = Api::query('sendMessage', $data = [
            'chat_id' => $chat_id,
            'text' => $text,
            'parse_mode' => $parse_mode,
            'reply_to_message_id' => $reply_to_message_id,
            'reply_markup' => $reply_markup,
        ]);
        return new Message((Object)[
            'message_id' => $message->message_id,
            'from' => $message->from,
            'chat' => $message->chat,
            'date' => $message->date,
            'text' => $message->text,
        ]);
    }

    public function reply($text, $reply_markup = NULL)
    {
        return $this->sendMessage($this->chat_id, $text, $reply_markup);
    }

    public function answerCallbackQuery()
    {

    }

}