<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TerritoryTask extends Model
{
    protected $fillable = [
        'territory_id',
        'task_id',
        'status',
    ];

    public function tasks()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }

    public function territories()
    {
        return $this->belongsTo(Territory::class, 'territory_id');
    }
}
