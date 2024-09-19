<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\User;
use App\Models\Animal;
use App\Models\TagHistory;
use Illuminate\Http\Request;
use App\Http\Services\PetService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PetStoreRequest;
use App\Http\Requests\PetStatusRequest;
use App\Http\Requests\PetUpdateRequest;

class PetController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['identify','pet_founded','send_number','missing']);
    }

    public function index()
    {
        $user = Auth::user();

        $pets = $user->getPets();        
        
        return view('pets.index',compact('pets','user'));
    }

    public function missing()
    {  
        $pets = Pet::where('missing',1)->get();
        
        return view('pets.missing',compact('pets'));
    }

    public function create()
    {
        $animals = Animal::all();

        $users = User::all();

        return view('pets.create',compact('animals','users'));
    }

    public function store(PetStoreRequest $request)
    {
        $validation = PetService::validate($request);

        $pet = new Pet($validation);
        $pet->save();

        PetService::storePetImage($request,$pet);

        // php artisan storage:link => Storage links to public directory.

        return redirect()->back()->with('status','New pet added !');
    }

    public function show(Pet $pet,Request $request)
    {
        $tag_history = TagHistory::where('tag_id',$pet->id)->orderBy('created_at','desc')->limit(5)->get();

        return view('pets.show',compact('pet','tag_history'));
    }

    public function identify(Request $request)
    {
        $token = PetService::getUrlToken($request);

        $pet = Pet::where('token',$token)->first();

        if(!$pet)
        {
            abort(404);
        }

        $owner = $pet->owner;

        if(!$owner->status)
        {
            return view('users.complete',compact('owner'));
        }

        if(!$pet->status)
        {
            abort(403);
        }

        return view('pets.contact',compact('pet'));
    }

    public function pet_founded(Request $request)
    {
        return PetService::founded($request);
    }

    public function send_number(Request $request)
    {
        return PetService::send_number($request);
    }

    public function edit(Pet $pet)
    {
        $animals = Animal::all();

        $owners = User::all();

        return view('pets.edit',compact('pet','animals','owners'));
    }

    public function update(PetUpdateRequest $request , Pet $pet)
    {
        $validation = PetService::validate($request);

        $pet->update($validation);

        PetService::updatePetImage($request,$pet);

        $pet->user_id = $request->has('user_id') ? $request->user_id : $pet->user_id;

        $pet->save();
       
        return redirect()->back()->with('status','Success !');
    }

    public function set_status(PetStatusRequest $request)
    {
        $pet = Pet::findOrFail($request->pet_id);

        $pet->status = ($pet->status == Pet::Active) ? 0 : 1;

        $pet->save();

        return redirect()->back()->with('status','Uspeh!');

    }

    public function set_missing_status(PetStatusRequest $request)
    {
        $pet = Pet::findOrFail($request->pet_id);

        PetService::setMissingStatus($pet);

        return redirect()->back()->with('status','Uspeh!');
    }

    public function destroy(Pet $pet)
    {
        $pet->delete();

        return redirect()->back()->with('status','Pet deleted!');
    }
}
