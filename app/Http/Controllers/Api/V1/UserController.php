<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Http\Responses\JsonResponse;
use App\Http\Services\UserService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    /**
     * @group Users
     * 
     * Get list of users
     * 
     * @response 200 {
     *  "data": [
     *      {
     *          "id": 1,
     *          "name": "John Doe",
     *          "email": "john@example.com",
     *          "pets": [
     *              {
     *                  "id": 1,
     *                  "name": "Fluffy"
     *              }
     *          ]
     *      }
     *  ]
     * }
     */

    public function index()
    {
        $users = Auth::user()->getUsers();

        $response = (Auth::user()->admin || Auth::user()->superadmin) ? UserResource::collection($users->load('pets')) : new UserResource(Auth::user()->load('pets'));

        return response()->json(new JsonResponse($response));
    }

    /**
     * @group Users
     * 
     * Create a default user
     * 
     * @bodyParam default boolean required. Example: true
     * 
     * @response 201 {
     *  "data": {
     *      "id": 1,
     *      "name": "Default User"
     *  }
     * }
     * 
     * @response 404 {
     *  "message": "Default user not selected!"
     * }
     */

    public function store_default(Request $request)
    {
        $request->validate([
            'default' => 'required|boolean',
        ]);

        $user = ($request->default) ? UserService::createDefaultUser() : false;

        if (!$user) {
            return response()->json(
                new JsonResponse(
                    [],
                    false,
                    404,
                    'Default user not selected!'
                ),
                404
            );
        }

        return response()->json(new JsonResponse(new UserResource($user)));
    }

    /**
     * @group Users
     * 
     * Show user by ID
     * 
     * @urlParam id integer required user ID. Example: 1
     * 
     * @response 200 {
     *  "data": {
     *      "id": 1,
     *      "name": "John Doe",
     *      "email": "john@example.com",
     *      "address": "Main Street 123"
     *  }
     * }
     * 
     * @response 404 {
     *  "message": "No user founded!"
     * }
     */

    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(
                new JsonResponse(
                    [],
                    false,
                    404,
                    'No user founded!'
                ),
                404
            );
        }

        return response()->json(new JsonResponse(new UserResource($user)));
    }

    /**
     * @group Users
     * 
     * Update user by ID
     * 
     * @urlParam id integer required user ID. Example: 1
     * @bodyParam username string optional username. Example: johndoe
     * @bodyParam name string optional user name. Example: John Doe
     * @bodyParam email string optional Email. Example: john@example.com
     * @bodyParam address string optional Address. Example: Main Street 123
     * @bodyParam city string optional city. Example: Belgrade
     * @bodyParam phone_nummber string optional phone number. Example: 123-456-789
     * @bodyParam admin integer optional is user admin. Example: true
     * @bodyParam superadmin integer optional is user superadmin. Example: false
     * @bodyParam status integer optional user status. Example: 1
     * 
     * @response 200 {
     *  "data": {
     *      "id": 1,
     *      "name": "John Doe",
     *      "email": "john@example.com",
     *      "address": "Main Street 123"
     *  }
     * }
     * 
     * @response 404 {
     *  "message": "No user founded!"
     * }
     */

    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(
                new JsonResponse(
                    [],
                    false,
                    404,
                    'No user founded!'
                ),
                404
            );
        }

        $validation = UserService::validate($request);

        $user->update($validation);
        $user->save();

        return response()->json(new JsonResponse(new UserResource($user)));

    }

    /**
     * @group Users
     * 
     * Delete user by ID
     * 
     * @urlParam id integer required user ID. Example: 1
     * 
     * @response 200 {
     *  "message": "User deleted successfully"
     * }
     * 
     * @response 404 {
     *  "message": "No user founded!"
     * }
     * 
     * @response 403 {
     *  "message": "User is superadmin"
     * }
     */

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(
                new JsonResponse(
                    [],
                    false,
                    404,
                    'No user founded!'
                ),
                404
            );
        }

        if ($user->superadmin) {
            return response()->json(
                new JsonResponse(
                    [],
                    false,
                    403,
                    'User is superadmin'
                ),
                403
            );
        }

        $user->delete();

        return response()->json(
            new JsonResponse([]),
            200
        );
    }
}
