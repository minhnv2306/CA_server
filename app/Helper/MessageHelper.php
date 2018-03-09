<?php
/**
 * Created by PhpStorm.
 * User: khoinx
 * Date: 2/9/18
 * Time: 2:31 AM
 */

namespace App\Helper;


class MessageHelper
{
    public function __construct()
    {
    }
    /**
     * Success response
     * @param $data
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public static function successResponse($data = [], $message = '')
    {
        return self::apiResponse(1, $data, $message);
    }
    
    /**
     * Error response
     * @param $data
     * @param $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public static function errorResponse($data = [], $message, $code = 0)
    {
        return self::apiResponse($code, $data, $message);
    }
    
    /**
     * Get message errors
     * @param $errors
     * @return string
     */
    public static function getMessageErros($errors){
        $result = array();
        if(!empty($errors)){
            foreach ($errors->getMessages() as $key=>$value){
                $result[] = $value[0];
            }
        }
        return implode(';',$result);
    }
    
    /**
     * Api response
     * @param $code
     * @param $data
     * @param $message
     * @param array $error
     * @return \Illuminate\Http\JsonResponse
     */
    protected static function apiResponse($code, $data, $message)
    {
        return \response()->json([
            'result' => $code,
            'current_time' => time(),
            'message' => $message,
            'data' => $data,
            //'error' => !empty($error) ? $error : new \stdClass()
        ]);
    }
    
}