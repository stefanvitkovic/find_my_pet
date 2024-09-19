<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Http\Resources\UserResource;
use App\Http\Responses\JsonResponse;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * @group Authentication
     * 
     * Register a new user and return an access token.
     *
     * @bodyParam email string required The email address of the user. Example: test@paws.com
     * @bodyParam password string required The password for the user, must be at least 6 characters long. Example: password
     * @bodyParam user_id int required The ID of the user to update. Example: 1
     *
     * @response 200 {
     *   "data": {
     *     "user": {
     *       "id": 1,
     *       "email": "test@paws.com",
     *       "status": 1,
     *       "created_at": "2024-09-19T12:34:56.000000Z",
     *       "updated_at": "2024-09-19T12:34:56.000000Z"
     *     },
     *     "token": "your_access_token_here"
     *   }
     * }
     */

    public function signup(SignupRequest $request)
    {
        $user = User::find($request->user_id);
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->status = User::ACTIVE;
        $user->save();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(new JsonResponse(["user" => new UserResource($user), "token" => $token]));

    }

    /**
     * @group Authentication
     * 
     * Authenticate a user and return an access token.
     *
     * @bodyParam email string required The email address of the user. Example: test@paws.com
     * @bodyParam password string required The password for the user. Example: password
     *
     * @response 200 {
     *   "data": {
     *     "accessToken": "your_access_token_here"
     *   }
     * }
     * @response 422 {
     *   "errors": {
     *     "email": [
     *       "The provided credentials are incorrect."
     *     ]
     *   }
     * }
     */

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(new JsonResponse(['accessToken' => $token]));
    }
}
