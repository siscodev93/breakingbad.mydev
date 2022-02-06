<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CharacterOccupation;

class Character extends Model
{
    use HasFactory;

    protected $primaryKey = "char_id";
    protected $guarded = [];

    protected $casts = [
        'occupations' => 'array',
        'appearance' => 'array',
        'better_call_saul_appearance' => 'array',
    ];

}
