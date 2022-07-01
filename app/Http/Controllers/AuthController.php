<?php

namespace App\Http\Controllers;

use App\Helpers\ValidateResponse;
use App\Mail\SignUpRequestMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Validator;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Auth",
 *     description="Authentication APIs",
 * )
 **/
class AuthController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/auth/me",
     *     tags={"Auth"},
     *     summary="Get user info from firebase token",
     *     description="Get user info from firebase token",
     *     security={{"bearerAuth":{}}},
     *     operationId="getUserInfoFromToken",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation"
     *     )
     * )
     */
    public function me(Request $request)
    {
        try {
            $auth = app('firebase.auth');
            $token = request()->header('x-auth-token');
            $token = str_replace('Bearer ' , '', $token);
            $verifiedIdToken = $auth->verifyIdToken($token);
            $uid = $verifiedIdToken->claims()->get('sub');
            $info = User::where("uuid", $uid)->first();
            if (!$info) {
                return $this->responseException('Not found user info', 401);
            }
            if(!$info->active){
                return $this->responseException('Inactive user', 403);
            }
            return $this->responseSuccess($info);
        } catch (Exception $e) {
            return $this->responseException($e->getMessage(), 400);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/v1/auth/signup",
     *     tags={"Auth"},
     *     summary="Create new user",
     *     description="Create new user",
     *     security={{"bearerAuth":{}}},
     *     operationId="createUser",
     *     @OA\RequestBody(
     *         description="User schemas",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation"
     *     )
     * )
     */
    public function signUp(Request $request)
    {
        try {
            $rules = User::$rules;
            $auth = app('firebase.auth');
            $token = request()->header('x-auth-token');
            $token = str_replace('Bearer ' , '', $token);
            $verifiedIdToken = $auth->verifyIdToken($token);
            $uid = $verifiedIdToken->claims()->get('sub');
            $input = $request->all();
            $input['active'] = false;
            $input['uuid'] = $uid;
            $input['role'] = 'user';
            $validator = Validator::make($input, $rules);
            if ($validator->fails()) {
                $errors = ValidateResponse::make($validator);
                return $this->responseError($errors, 400);
            }
            $newUser = User::create($input);
            //Send email Signup
            $data = array(
                'name' => $input['firstName']. ' '. $input['lastName'],
                'email' => $input['email'],
                'url' => config('app.url') . '/admin/users',
            );

            //Disable send until get correct mail config
//            $admins = User::where('role', 'admin')->get();
//            foreach($admins as $admin){
//                Mail::to($admin['email'])->send(new SignUpRequestMail($data));
//            }

            return $this->responseSuccess($newUser, 201);
        } catch (Exception $e) {
            return $this->responseException($e->getMessage(), 400);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/v1/auth/{id}",
     *     tags={"Auth"},
     *     summary="Update user",
     *     description="Update user",
     *     security={{"bearerAuth":{}}},
     *     operationId="updateUser",
     *     @OA\RequestBody(
     *         description="User schemas",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        try {
            $input = $request->all();
            $userInfo = User::where('id', $id)->first();
            if(empty($userInfo)){
                return $this->responseException('Not found user', 404);
            }
            $userInfo->update($input);
            return $this->responseSuccess($userInfo, 201);
        } catch (Exception $e) {
            return $this->responseException($e->getMessage(), 400);
        }
    }

}
