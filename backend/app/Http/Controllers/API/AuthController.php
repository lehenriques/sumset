<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\ResponseService;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Transformers\User\UserResource;
use App\Transformers\User\UserResourceCollection;

class AuthController extends BaseController
{
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        try {
            $credentials = request(['email', 'password']);
            if (!$token = auth('api')->attempt($credentials)) {
                return $this->sendError('Unauthorised.', ['error' => 'Usuário ou senha inválido!']);
            }
        } catch (\Throwable | \Exception $e) {
            return ResponseService::exception('login', null, $e);
        }

        $success = $this->respondWithToken($token);

        return  $this->sendResponse($success, 'User login successfully.');
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile()
    {
        $success = auth()->user();

        return $this->sendResponse($success, 'Refresh token return successfully.');
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return $this->sendResponse([], 'Successfully logged out.');
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        $success = $this->respondWithToken(auth()->refresh());

        return $this->sendResponse($success, 'Refresh token return successfully.');
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'auth_user' => auth()->user()
        ];
    }
}
