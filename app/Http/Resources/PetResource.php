<?php

namespace App\Http\Resources;

use App\Models\Animal;
use Illuminate\Http\Resources\Json\JsonResource;

class PetResource extends JsonResource
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
            "id" => $this->id,
            "name" => $this->name,
            "address" => $this->address,
            "nickname" => $this->nickname,
            "note" => $this->note,
            "type" => $this->type,
            "animal" => Animal::getTypeLabel($this->type),
            "breed" => $this->breed,
            "gender" => $this->gender,
            "dob" => $this->dob,
            "height" => $this->height,
            "weight" => $this->weight,
            "puppy" => $this->puppy,
            "color" => $this->color,
            "sterilised" => $this->sterilised,
            "allergies" => $this->allergies,
            "vaccinated" => $this->vaccinated,
            "health_issues" => $this->health_issues,
            "therapy" => $this->therapy,
            "food_type" => $this->food_type,
            "socialized" => $this->socialized,
            "vet_name" => $this->vet_name,
            "vet_contact" => $this->vet_contact,
            "other_emergency_contacts" => $this->other_emergency_contacts,
            "reward" => $this->reward,
            "reward_fee" => $this->reward_fee,
            "missing" => $this->missing,
            "status" => $this->status,
            "image" => $this->image,
            "owner" => new UserResource($this->whenLoaded('owner')),
            "history" => $this->whenLoaded('history'),
        ];
    }
}
