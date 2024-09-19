<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function pet()
    {
        return $this->belongsTo(App\Models\Pet::class,'user_id','id');
    }
}
