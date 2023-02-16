<?php

require_once(__DIR__."/src/autoload.php");

use Darkners\DarkTelegram\DarkTelegram;
use Darkners\DarkTelegram\Models\InlineKeyboardMarkup;

$token = "YOUR-BOT-API-KEY";

$bot = new DarkTelegram($token);
$bot->init($user, $chat, $message);


$bot->command('start', function ($bot, $params) {
    global $user;

    $keyboard = new InlineKeyboardMarkup();
    $keyboard->add('Message', 'answer_message');
    $keyboard->add('Notify', 'answer_notify');
    $keyboard->add('Window', 'answer_window');
    $bot->sendMessage($bot->chat_id, "Welcome, {$user->first_name}! \n\nChoose how you want to get an answer:", reply_markup: $keyboard->build());
});


$bot->callback('answer_message', function ($bot, $call) {
    $bot->reply('Message Answer');
});

$bot->callback('answer_notify', function ($bot, $call) {
    $call->answer(text: 'Notify Answer');
});

$bot->callback('answer_window', function ($bot, $call) {
    $call->answer(text: 'Window Answer', show_alert: true);
});