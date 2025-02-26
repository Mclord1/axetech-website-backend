<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'features',
        'status',
        'launch_date',
        'teaser_content',
        'is_visible',
        'order',
    ];

    protected $casts = [
        'features' => 'array',
        'launch_date' => 'datetime',
        'is_visible' => 'boolean',
        'order' => 'integer',
    ];

    protected $hidden = [
        'deleted_at',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = str($product->name)->slug();
            }
        });
    }
}
