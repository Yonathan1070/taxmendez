<?php


namespace App\Http\Controllers\api;


use App\Http\Controllers\Controller as Controller;


class BaseController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message)
    {
    	$response = [
            'success' => true,
            'code'    => 200,
            'data'    => $result,
            'message' => $message,
        ];


        return response()->json($response, 200);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $code = 404)
    {
    	$response = [
            'success' => false,
            'code' => $code,
            'message' => $error,
        ];


        /*if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }*/


        return response()->json($response, $code);
    }
}
