<?php

namespace Darkners\DarkTelegram\Models;

use Darkners\DarkTelegram\Api;

class Chat
{

    public $id;
    public $type;
    public $title;
    public $first_name;
    public $last_name;
    public $username;
    public $is_forum;
    public $photo;
    public $active_usernames;
    public $emoji_status_custom_emoji_id;
    public $bio;
    public $has_private_forwards;
    public $has_restricted_voice_and_video_messages;
    public $join_to_send_messages;
    public $join_by_request;
    public $description;
    public $invite_link;
    public $pinned_message;
    public $permissions;
    public $slow_mode_delay;
    public $message_auto_delete_time;
    public $has_aggressive_anti_spam_enabled;
    public $has_hidden_members;
    public $has_protected_content;
    public $sticker_set_name;
    public $can_set_sticker_set;
    public $linked_chat_id;
    public $location;
    
    public function __construct($chat)
    {
        $this->id = $chat->id;
        $this->type = $chat->type;
        $this->first_name = isset($chat->first_name) ? $chat->first_name : NULL;
        $this->last_name = isset($chat->last_name) ? $chat->last_name : NULL;
        $this->is_forum = isset($chat->is_forum) ? True : False;
        $this->photo = isset($chat->is_forum) ? $chat->is_forum : NULL;
        $this->active_usernames = isset($chat->active_usernames) ? $chat->active_usernames : NULL;
        $this->emoji_status_custom_emoji_id = isset($chat->emoji_status_custom_emoji_id) ? $chat->emoji_status_custom_emoji_id : NULL;
        $this->bio = isset($chat->bio) ? $chat->bio : NULL;
        $this->has_private_forwards = isset($chat->has_private_forwards) ? True : False;
        $this->has_restricted_voice_and_video_messages = isset($chat->has_restricted_voice_and_video_messages) ? True : False;
        $this->join_to_send_messages = isset($chat->join_to_send_messages) ? True : False;
        $this->join_by_request = isset($chat->join_by_request) ? True : False;
        $this->description = isset($chat->description) ? $chat->description : NULL;
        $this->invite_link = isset($chat->invite_link) ? $chat->invite_link : NULL;
        $this->pinned_message = isset($chat->pinned_message) ? $chat->pinned_message : NULL;
        $this->permissions = isset($chat->permissions) ? $chat->permissions : NULL;
        $this->slow_mode_delay = isset($chat->slow_mode_delay) ? $chat->slow_mode_delay : NULL;
        $this->message_auto_delete_time = isset($chat->message_auto_delete_time) ? $chat->message_auto_delete_time : NULL;
        $this->has_aggressive_anti_spam_enabled = isset($chat->has_aggressive_anti_spam_enabled) ? $chat->has_aggressive_anti_spam_enabled : NULL;
        $this->has_hidden_members = isset($chat->has_hidden_members) ? True : False;
        $this->has_protected_content = isset($chat->has_protected_content) ? True : False;
        $this->sticker_set_name = isset($chat->sticker_set_name) ? $chat->sticker_set_name : NULL;
        $this->can_set_sticker_set = isset($chat->can_set_sticker_set) ? True : False;
        $this->linked_chat_id = isset($chat->linked_chat_id) ? $chat->linked_chat_id : NULL;
        $this->location = isset($chat->location) ? $chat->location : NULL;
    }


    public function setTitle($title)
    {
        if ($this->type == 'private') return;
        
        Api::query('setChatTitle', [
            'chat_id' => $this->id,
            'title' => $title
        ]);
    }

}
