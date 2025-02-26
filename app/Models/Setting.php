<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'key',
        'value',
        'group',
        'type',
        'label',
        'description',
        'options',
        'is_public',
    ];

    protected $casts = [
        'options' => 'array',
        'is_public' => 'boolean',
    ];

    protected $hidden = [
        'deleted_at',
    ];

    /**
     * Get a setting value by key
     */
    public static function getValue(string $key, mixed $default = null): mixed
    {
        $setting = static::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    /**
     * Get multiple settings by group
     */
    public static function getGroup(string $group): array
    {
        return static::where('group', $group)
            ->get()
            ->pluck('value', 'key')
            ->toArray();
    }

    /**
     * Get all public settings
     */
    public static function getPublic(): array
    {
        return static::where('is_public', true)
            ->get()
            ->pluck('value', 'key')
            ->toArray();
    }
}
