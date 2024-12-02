<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Plant extends Model
{
    protected $fillable = [
        'scientific_name', 
        'common_name', 
        'plant_family', 
        'care_instructions',
        
    ];
    public $timestamps = false;
}
