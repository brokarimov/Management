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
    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'territory_tasks', 'territory_id', 'task_id')
            ->withPivot('status'); 
    }
    public function answers()
    {
        return $this->hasMany(Answer::class, 'territory_id');
    }
}
