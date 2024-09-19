<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;

    protected $guarded = [];

    const DOG = 1;
    const CAT = 2;
    const PIG = 3;
    const RABBIT = 4;
    const CHICKEN = 5;
    const BIRD = 6;
    const HORSE = 7;
    const OTHER = 8;

    public static function getTypeLabel($type)
    {
        $types = [
            self::DOG => 'Dog',
            self::CAT => 'Cat',
            self::PIG => 'Pig',
            self::RABBIT => 'Rabbit',
            self::CHICKEN => 'Chicken',
            self::BIRD => 'Bird',
            self::HORSE => 'Horse',
            self::OTHER => 'Other',
        ];

        return $types[$type] ?? 'Unknown';
    }
}
