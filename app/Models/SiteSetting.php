<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = ['key', 'value'];

    protected $casts = [
        'value' => 'array',
    ];

    public static function getValue(string $key, array $default = []): array
    {
        return static::where('key', $key)->first()?->value ?? $default;
    }

    public static function setValue(string $key, array $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
    }
}
