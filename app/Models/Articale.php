<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Articale extends Model
{
    protected $fillable=[
        'title',
        'content',
        'image',
        'user_id',
        'is_published'
    ];

    public function user()
    {
        return $this->belongsTo(Usersss::class);
    }
}
