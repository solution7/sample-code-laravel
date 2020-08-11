<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\AccessLogType;

class AccessLog extends Model
{
    protected $guarded = [];

    /**
     * @param string
     * @param array
     */
    public static function store($type, $content)
    {
        $type = AccessLogType::firstOrCreate(['name' => $type]);

        // extend with default content
        $content = self::extendWithDefaultContent($content);

        self::create([
            'access_log_type_id' => $type->id,
            'content' => json_encode($content),
        ]);
    }

    private static function extendWithDefaultContent($content)
    {
        $content['IP_ADDR'] = self::getIpAddress();

        return $content;
    }

    private static function getIpAddress()
    {
        $the_ip = '';
        //Just get the headers if we can or else use the SERVER global
        if (function_exists('apache_request_headers')) {
            $headers = apache_request_headers();
        } else {
            $headers = $_SERVER;
        }
        //Get the forwarded IP if it exists
        if (array_key_exists('X-Forwarded-For', $headers) &&
            filter_var($headers['X-Forwarded-For'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $the_ip = $headers['X-Forwarded-For'];
        } elseif (array_key_exists('HTTP_X_FORWARDED_FOR', $headers) &&
            filter_var($headers['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $the_ip = trim($headers['HTTP_X_FORWARDED_FOR']);
        } elseif (array_key_exists('HTTP_X_FORWARDED_FOR', $headers)) {
            $the_ip = trim($headers['HTTP_X_FORWARDED_FOR']);

            if (strpos($the_ip, ",")) {
                $iplist = explode(",", $the_ip);
                $the_ip = trim($iplist[0]);
            }
        } else {
            $the_ip = filter_var($_SERVER['REMOTE_ADDR'] ?? null, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
        }
        return $the_ip;
    }
}
