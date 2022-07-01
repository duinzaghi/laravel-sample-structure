<?php

namespace App\Http\Controllers;

use App\Helpers\ErrorFormat;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Response;
/**
 * @OA\Info(title="QuoteTool APIs", version="1.0")
 */

/**
 * @OA\SecurityScheme(
 *      securityScheme="bearerAuth",
 *      in="header",
 *      name="x-auth-token",
 *      type="http",
 *      scheme="bearer"
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @desc Response success
     *
     * @param array|object|string $data
     *
     * @return \Illuminate\Http\Response Response
     * */
    public static function responseSuccess($data){
        return Response::json(array(
            'error' => false,
            'data' => $data,
            'errors' => null
        ),200);
    }

    public static function getAuthInfo($token){
        $auth = app('firebase.auth');
        $verifiedIdToken = $auth->verifyIdToken($token);
        $uid = $verifiedIdToken->claims()->get('sub');
        return User::where("uuid", $uid)->first();
    }

    /**
     * @desc Response error
     *
     * @param int $statusCode
     * @param  \app\helpers\ErrorFormat[] $errors
     *
    //     * @return \Illuminate\Http\Response Response
     * */
    public static function responseError($errors,$statusCode = null){
        if(!isset($statusCode)){
            $statusCode = 400;
        }
        $parseErrors = array();
        foreach($errors as $error){
            $parseErrors[] = new ErrorFormat($error[0], $error[1]);
        }

        $response = array(
            'error' => true,
            'data' => null ,
            'errors' => $parseErrors
        );
        return Response::json($response,$statusCode);
    }

    public static function responseException($messages,$statusCode = null){
        if(!isset($statusCode)){
            $statusCode = 400;
        }
        $parseErrors = array();
        $parseErrors[] = new ErrorFormat($messages, 5000);

        $response = array(
            'error' => true,
            'data' => null ,
            'errors' => $parseErrors
        );
        return Response::json($response,$statusCode);
    }
}
