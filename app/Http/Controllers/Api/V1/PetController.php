<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Pet;
use App\Models\User;
use App\Models\TagHistory;
use Illuminate\Http\Request;
use App\Http\Services\PetService;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\PetResource;
use App\Http\Controllers\Controller;
use App\Http\Responses\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PetStoreRequest;
use App\Http\Requests\PetStatusRequest;
use App\Http\Requests\PetUpdateRequest;
use App\Http\Requests\PetFoundedRequest;
use App\Http\Requests\SendNumberRequest;
use App\Http\Requests\StoreImageRequest;

class PetController extends Controller
{
    /**
     * @group Pets
     * 
     * Get list of pets for authenticated user
     * 
     * This endpoint retrieves a list of pets belonging to the authenticated user.
     * 
     * @response 200 {
     *   "data": [
     *     {
     *       "id": 1,
     *       "name": "Buddy",
     *       "owner": {
     *         "id": 1,
     *         "name": "John Doe"
     *       },
     *       "history": [
     *         {
     *           "id": 1,
     *           "status": "Healthy"
     *         }
     *       ]
     *     }
     *   ]
     * }
     */
    public function index()
    {
        $user = Auth::user();
        
        $pets =  Pet::where('user_id', $user->id)->with('owner', 'history')->get();

        $response = PetResource::collection($pets);

        return response()->json(new JsonResponse($response));
    }

    /**
     * @group Pets
     * 
     * Store a new pet
     * 
     * This endpoint allows you to create a new pet with all the necessary details.
     * 
     * @bodyParam user_id int required The ID of the pet owner.
     * @bodyParam name string required The name of the pet.
     * @bodyParam address string nullable The address of the pet.
     * @bodyParam type integer required The type of the pet (e.g., 1 => dog, 2 => cat).
     * @bodyParam breed string nullable The breed of the pet.
     * @bodyParam dob date nullable The date of birth of the pet.
     * @response 201 {
     *   "data": {
     *     "id": 1,
     *     "name": "Buddy",
     *     "type": "dog",
     *     "owner": {
     *       "id": 1,
     *       "name": "John Doe"
     *     }
     *   }
     * }
     */

    public function store(PetStoreRequest $request)
    {
        $validation = PetService::validate($request);
        
        $pet = new Pet($validation);
        $pet->save();

        return response()->json(new JsonResponse(new PetResource($pet->load('owner'))));
    }

    /**
     * @group Pets
     * 
     * Store a pet photo
     * 
     * Upload a photo for a pet.
     * 
     * @urlParam id int required The ID of the pet.
     * @bodyParam image file required The image file to upload. Must be jpeg, png, jpg, gif, or svg and not exceed 10 MB.
     * @response 200 {
     *   "data": {
     *     "id": 1,
     *     "name": "Buddy",
     *     "image_url": "http://example.com/images/buddy.jpg"
     *   }
     * }
     */

    public function store_photo(StoreImageRequest $request, $id)
    {
        $pet = Pet::find($id);

        if (!$pet) {
            return response()->json(
                new JsonResponse(
                    [],
                    false,
                    404,
                    'No pet founded!'
                ),
                404
            );
        }

        PetService::storePetImage($request, $pet);

        return response()->json(new JsonResponse(new PetResource($pet->load('owner'))));
    }

    /**
     * @group Pets
     * 
     * Get a single pet by ID
     * 
     * Fetch details of a specific pet owned by the authenticated user.
     * 
     * @urlParam id int required The ID of the pet.
     * @response 200 {
     *   "data": {
     *     "id": 1,
     *     "name": "Buddy",
     *     "owner": {
     *       "id": 1,
     *       "name": "John Doe"
     *     },
     *     "history": [
     *       {
     *         "id": 1,
     *         "status": "Healthy"
     *       }
     *     ]
     *   }
     * }
     * @response 404 {
     *   "message": "No pet founded!"
     * }
     */

    public function show($id)
    {
        $pet = Pet::with(['owner', 'history'])->where('id',$id)->where('user_id',Auth()->id())->first();

        if (!$pet) {
            return response()->json(
                new JsonResponse(
                    [],
                    false,
                    404,
                    'No pet founded!'
                ),
                404
            );
        }

        return response()->json(new JsonResponse(new PetResource($pet)));
    }

    /**
     * @group Pets
     * 
     * Update a pet
     * 
     * Update details of an existing pet.
     * 
     * @urlParam id int required The ID of the pet.
     * @bodyParam name string nullable The name of the pet.
     * @bodyParam address string nullable The address of the pet.
     * @bodyParam type integer nullable The type of the pet (e.g., 1 => dog, 2 => cat).
     * @response 200 {
     *   "data": {
     *     "id": 1,
     *     "name": "Buddy",
     *     "type": "dog",
     *     "owner": {
     *       "id": 1,
     *       "name": "John Doe"
     *     }
     *   }
     * }
     * @response 404 {
     *   "message": "No pet founded!"
     * }
     */

    public function update(PetUpdateRequest $request, $id)
    {
        $pet = Pet::find($id);

        if (!$pet) {
            return response()->json(
                new JsonResponse(
                    [],
                    false,
                    404,
                    'No pet founded!'
                ),
                404
            );
        }

        $validation = PetService::validate($request);

        $pet->update($validation);
            $pet->user_id = $request->has('user_id') ? $request->user_id : $pet->user_id;
        $pet->save();

        return response()->json(new JsonResponse(new PetResource($pet->load(['owner', 'history']))));
    }

    /**
     * @group Pets
     * 
     * Delete a pet
     * 
     * Remove a pet from the database.
     * 
     * @urlParam id int required The ID of the pet.
     * @response 200 {
     *   "message": "Pet deleted successfully."
     * }
     * @response 404 {
     *   "message": "No pet founded!"
     * }
     */

    public function destroy($id)
    {
        DB::beginTransaction();

        $pet = Pet::find($id);

        if ($pet === null) {
            DB::rollBack();
            return response()->json(
                new JsonResponse(
                    [],
                    false,
                    404,
                    'No pet found!'
                ),
                404
            );
        }

        try {
            $pet->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(
                new JsonResponse(
                    [],
                    false,
                    500,
                    'Failed to delete pet.'
                ),
                500
            );
        }

        return response()->json(new JsonResponse([]));
    }

    /**
     * @group Pets
     * 
     * Report a pet as missing
     * 
     * Set a pet's status as missing and notify relevant users.
     * 
     * @bodyParam pet_id int required The ID of the pet to set as missing.
     * @response 200 {
     *   "message": "Pet status updated to missing."
     * }
     * @response 404 {
     *   "message": "No pet founded!"
     * }
     */

    public function missing()
    {
        $pets = Pet::where('missing', 1)->get();

        return response()->json(new JsonResponse(PetResource::collection($pets)));
    }

    /**
     * @group Pets
     * 
     * Send notifications for a found pet.
     *
     * @bodyParam long string required The longitude of the found pet.
     * @bodyParam lat string required The latitude of the found pet.
     * @bodyParam token string required The token for authentication.
     * @bodyParam email string optional The email of the user.
     *
     * @response 200 {
     *   "success": true
     * }
     * @response 405 {
     *   "error": "Error sending founded notifications!"
     * }
     */

    public function pet_founded(PetFoundedRequest $request)
    {
        $founded = PetService::founded($request);

        if ($founded['code'] == 405) {
            return response()->json(
                new JsonResponse(
                    [],
                    false,
                    405,
                    'Error sending founded notifications!'
                ),
                405
            );
        }

        return response()->json(new JsonResponse([]));
    }

    /**
     * @group Pets
     * 
     * Send a notification with a phone number.
     *
     * @bodyParam founder_phone int required The phone number of the founder.
     * @bodyParam email string optional The email of the user.
     *
     * @response 200 {
     *   "success": true
     * }
     * @response 405 {
     *   "error": "Error sending number notifications!"
     * }
     */

    public function send_number(SendNumberRequest $request)
    {
        $notification = PetService::send_number($request);

        if ($notification['code'] == 405) {
            return response()->json(
                new JsonResponse(
                    [],
                    false,
                    405,
                    'Error sending number notifications!'
                ),
                405
            );
        }

        return response()->json(new JsonResponse([]));
    }

    /**
     * @group Pets
     * 
     * Set the status of a pet.
     *
     * @bodyParam pet_id int required The ID of the pet.
     *
     * @response 200 {
     *   "data": {
     *     "id": 1,
     *     "status": 1
     *   }
     * }
     * @response 404 {
     *   "error": "No pet founded!"
     * }
     */

    public function set_status(PetStatusRequest $request)
    {
        $pet = Pet::find($request->pet_id);

        if (!$pet) {
            return response()->json(
                new JsonResponse(
                    [],
                    false,
                    404,
                    'No pet founded!'
                ),
                404
            );
        }

        $pet->status = ($pet->status == Pet::Active) ? 0 : 1;

        $pet->save();

        return response()->json(new JsonResponse(new PetResource($pet)));

    }

    /**
     * @group Pets
     * 
     * Set the missing status of a pet and notify users.
     *
     * @bodyParam pet_id int required The ID of the pet.
     *
     * @response 200 {
     *   "data": {
     *     "id": 1,
     *     "status": 1
     *   }
     * }
     * @response 404 {
     *   "error": "No pet founded!"
     * }
     */

    public function set_missing_status(PetStatusRequest $request)
    {
        $pet = Pet::find($request->pet_id);

        if (!$pet) {
            return response()->json(
                new JsonResponse(
                    [],
                    false,
                    404,
                    'No pet founded!'
                ),
                404
            );
        }

        $email_list = User::where('missing_notification', '1')->pluck('email');

        PetService::setMissingStatus($pet);

        return response()->json(new JsonResponse(new PetResource($pet)));
    }
}
