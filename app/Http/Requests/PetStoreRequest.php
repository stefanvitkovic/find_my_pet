<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PetStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user_id' => 'required',
            'name' => 'required', 
            'address' => 'nullabe', 
            'nickname' => 'nullable',
            'note' => 'nullable',
            'type' => 'required', 
            'breed' => 'nullable', 
            'gender' => 'nullable', 
            'dob' => 'nullable', 
            'height' => 'nullable', 
            'weight' => 'nullable', 
            'puppy' => 'nullable', 
            'color' => 'nullable', 
            'sterilised' => 'nullable', 
            'allergies' => 'nullable', 
            'vaccinated' => 'nullable', 
            'health_issues' => 'nullable', 
            'therapy' => 'nullable', 
            'food_type' => 'nullable', 
            'socialized' => 'nullable', 
            'vet_name' => 'nullable', 
            'vet_contact' => 'nullable', 
            'other_emergency_contacts' => 'nullable', 
            'reward' => 'nullable', 
            'reward_fee' => 'nullable', 
            'status' => 'nullable',
        ];
    }
}
