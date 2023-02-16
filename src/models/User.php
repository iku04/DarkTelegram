<?php

namespace Darkners\DarkTelegram\Models;

class User
{

    public $id;
    public $is_bot;
    public $first_name;
    public $last_name;
    public $username;
    public $language_code;
    public $is_premium;
    public $added_to_attachment_menu;
    
    public function __construct($user)
    {
        $this->id = $user->id;
        $this->is_bot = $user->is_bot;
        $this->first_name = $user->first_name;
        $this->last_name = isset($user->last_name) ? $user->last_name : NULL;
        $this->username = isset($user->username) ? $user->username : NULL;
        $this->language_code = isset($user->language_code) ? $user->language_code : NULL;
        $this->is_premium = isset($user->is_premium) ? True : False;
        $this->added_to_attachment_menu = isset($user->added_to_attachment_menu) ? True : False;
    }

}
