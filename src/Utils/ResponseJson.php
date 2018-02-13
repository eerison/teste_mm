<?php
/**
 * Created by PhpStorm.
 * User: lilian
 * Date: 11/02/18
 * Time: 11:25
 */

namespace Eerison\Agenda\Utils;


class ResponseJson
{
    public static function responseJson($msg, $code = 200)
    {
        header('Content-Type: application/json');
        http_response_code($code);
        echo json_encode($msg);
    }
}