<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
        'image',
        'features',
        'order',
        'is_visible',
    ];

    protected $casts = [
        'features' => 'array',
        'is_visible' => 'boolean',
        'order' => 'integer',
    ];

    protected $hidden = [
        'deleted_at',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($service) {
            if (empty($service->slug)) {
                $service->slug = str($service->name)->slug();
            }
        });
    }
}
