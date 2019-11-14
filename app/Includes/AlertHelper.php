<?php

namespace App\Includes;

class AlertHelper
{
    public static function done($msg = "", $dir = "")
    {
        ob_start();
        echo $msg;
        header('X-Resp-Status:OK');
        header('X-Resp-Redirect:' . $dir);
    }

    public static function error($msg = "",$just_msg = false)
    {
        ob_start();
        echo $msg;
        header('X-Resp-Status:ERROR');
        if ($just_msg == true){
            header('X-Resp-Msg:TRUE');
        }

    }
}
