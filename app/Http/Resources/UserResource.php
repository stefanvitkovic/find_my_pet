<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'phone_nummber' => $this->phone_nummber,
            'notification_type' => $this->notification_type,
            'address' => $this->address,
            'city' => $this->city,
            'admin' => $this->admin,
            'missing_notification' => $this->missing_notification,
            'share_name' => $this->share_name,
            'share_other_contact' => $this->share_other_contact,
            'share_contact' => $this->share_contact,
            'share_address' => $this->share_address,
            'share_vet_info' => $this->share_vet_info,
            'status' => $this->status,
            'pets' => PetResource::collection($this->whenLoaded('pets'))
        ];
    }
}
