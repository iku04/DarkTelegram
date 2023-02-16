<?php

namespace Darkners\DarkTelegram;

class Api
{

    private static $api_uri;

    // public static function __construct($token = NULL)
    // {
    //     self::$api_uri = "https://api.telegram.org/bot{$token}/";
    // }

    public static function init($token)
    {
        self::$api_uri = "https://api.telegram.org/bot{$token}/";
    }


    public static function query($method, $data = [])
    {
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $result = file_get_contents(self::$api_uri.$method, false, $context);
        if ($result === FALSE) { /* Handle error */ }
        file_put_contents('answer.json', $result);
        return json_decode($result)->result;
    }

}