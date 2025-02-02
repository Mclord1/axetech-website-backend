<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'overview',
        'key_features',
        'challenge',
        'solution',
        'results',
        'main_image_links',
        'is_visible'
    ];
}
