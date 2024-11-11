<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;


class Permission extends Model
{
    use HasFactory;


    protected $fillable = ['name'];

    /**
     * Get the role that owns the permission.
     */
    public static function boot()
    {
        parent::boot();

        static::saved(function ($model) {
            Cache::forget('spatie.permission.cache');
        });

        static::deleted(function ($model) {
            Cache::forget('spatie.permission.cache');
        });
    }
}
