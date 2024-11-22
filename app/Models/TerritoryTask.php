<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TerritoryTask extends Model
{
    protected $fillable = [
        'territory_id',
        'task_id',
        'status',
        'category_id',
        'period'
    ];

    public function tasks()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }

    public function territories()
    {
        return $this->belongsTo(Territory::class, 'territory_id');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class, 'task_id');
    }
    
}
