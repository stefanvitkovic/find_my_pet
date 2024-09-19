<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'pets';

    // protected $appends = array('animalType','food');
    protected $with = ['image'];

    const Missing = 0;

    const Active = 1;

    const Inactive = 0;

    public function getAnimalTypeAttribute()
    {
        return $this->belongsTo(Animal::class, 'type', 'id')->first()->name;
    }

    protected $casts = [
        "puppy" => "integer",
        "sterilised" => "integer",
        "vaccinated" => "integer",
        "socialized" => "integer",
        "reward" => "integer",
    ];

    public function getFoodAttribute()
    {
        $food_type = $this->food_type;

        switch ($food_type) {
            case '1':
                return 'Ljudska Hrana';
                break;
            case '2':
                return 'Granule';
                break;
            case '3':
                return 'Miks';
                break;
            default:
                return 'N/A';
                break;
        };
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function image()
    {
        return $this->hasOne(Image::class, 'user_id', 'id');
    }

    public function history()
    {
        return $this->hasMany(TagHistory::class, 'tag_id', 'id');
    }

    public function toggleStatus()
    {
        $this->status = ($this->status == 0) ? 1 : 0;
        $this->save();
    }
}
