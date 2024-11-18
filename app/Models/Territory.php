<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Territory extends Model
{
    protected $fillable = [
        'name',
        'user_id',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
