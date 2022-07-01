<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Exception;
use Response;
class AdminRoleMiddleware
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
            $verifiedIdToken = $auth->verifyIdToken($token);
            $uid = $verifiedIdToken->claims()->get('sub');
            $info = User::where("uuid", $uid)->first();
            if (!$info) {
                return $this->responseException('Not found user info', 401);
            } else {
                if($info->role != 'admin'){
                    return $this->responseException("Don't have access permission!", 403);
                }
            }
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
