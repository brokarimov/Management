<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'task_id',
        'territory_id',
        'title',
        'file',
        'comment',
        'status',
    ];

    public function tasks()
    {
        return $this->belongsTo(TerritoryTask::class, 'task_id');
    }
    public function territories()
    {
        return $this->belongsTo(Territory::class, 'territory_id');
    }
}
