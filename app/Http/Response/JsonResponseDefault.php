<?php

namespace App\Http\Response;

class JsonResponseDefault
{

    /**
     * @param $success
     * @param $data
     * @param $message
     * @param $code
     * @return mixed
     */
    public static function create($success, $data, $options,$message, int $code)
    {

        if ($code == 204) {
            $code = 200;
        }

        $response['success'] = $success;
        $response['data'] = $data;

        if ($options ) {
            $response['options'] = $options;
        }

        $response['message'] = $message;
        $response['code'] = $code;


        $header = [$response['code'] => $response['message']];

        return response()->json($response,$code,$header);
    }
}
