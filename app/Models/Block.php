<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;

    protected $primaryKey = 'block_id';

    protected $fillable = [
        'region_id',
        'content',
        'is_active',
        'title',
        'img'
    ];
}
