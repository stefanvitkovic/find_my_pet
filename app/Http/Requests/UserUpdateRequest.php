<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
        $id = $this->user;

        return [
            'name' => 'nullable',
            'email' => 'nullable|unique:users,email,'.$id,
            'address' => 'nullable',
            'city' => 'nullable',
            'phone_nummber' => 'nullable',
            'admin' => 'nullable',
            'missing_notification' => 'nullable',
            'share_name' => 'nullable',
            'share_other_contact' => 'nullable',
            'share_contact' => 'nullable',
            'share_address' => 'nullable',
            'share_vet_info' => 'nullable',
            'superadmin' => 'nullable',
            'status' => 'nullable',
            'username' => 'nullable'
        ];
    }
}
