<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpkCriteria extends Model
{
    use HasFactory;

    protected $table = 'spk_criteria';

    protected $fillable = ['name', 'attribute', 'type', 'weight'];

    protected $casts = [
        'weight' => 'float',
    ];
}
