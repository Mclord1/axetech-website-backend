<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimonial extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'client_name',
        'company',
        'position',
        'content',
        'rating',
        'image',
        'order',
        'is_visible',
    ];

    protected $casts = [
        'rating' => 'integer',
        'order' => 'integer',
        'is_visible' => 'boolean',
    ];

    protected $hidden = [
        'deleted_at',
    ];

    /**
     * Scope a query to only include visible testimonials.
     */
    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }

    /**
     * Scope a query to order testimonials by their display order.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}