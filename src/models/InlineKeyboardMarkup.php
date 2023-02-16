<?php

namespace Darkners\DarkTelegram\Models;

class InlineKeyboardMarkup
{

    private $buttons = [];

    public function __construct()
    {
        
    }

    public function add($text, $callback_data = NULL)
    {
        $this->buttons[] = [
            'text' => $text,
            'callback_data' => $callback_data,
        ];
    }

    public function build()
    {
        return json_encode(['inline_keyboard' => [$this->buttons]]);
    }

}