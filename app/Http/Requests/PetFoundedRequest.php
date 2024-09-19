<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PetFoundedRequest extends FormRequest
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
            'long' => 'required',
            'lat' => 'required',
            'token' => 'required',
            'email' => 'sometimes|email',
        ];
    }
}
