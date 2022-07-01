<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Response;
class FirebaseJwtMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $auth = app('firebase.auth');
            $token = request()->header('x-auth-token');
            if(!$token){
                if(isset($request['api_key'])){
                    $token = $request['api_key'];
                }
                if(!$token){
                    throw new Exception('Not found token.');
                }
            }
            $token = str_replace('Bearer ' , '', $token);
            $auth->verifyIdToken($token);
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $response = array(
                'error' => true,
                'data' => null ,
                'errors' => $errorMessage
            );
            return Response::json($response,401);
        }
        return $next($request);
    }
}
