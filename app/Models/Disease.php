<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'symptoms', 'factors', 'treatment', 'affected_plants'
    ];
    protected $casts = [
        'symptoms' => 'array',
        'factors' => 'array',
        'affected_plants' => 'array',
    ];
    
}