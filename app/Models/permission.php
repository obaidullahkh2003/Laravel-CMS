<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Permission extends Model
{
    use HasFactory;


    protected $fillable = ['name'];

    /**
     * Get the role that owns the permission.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_has_permissions');

    }
}
