<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'category_id',
        'employee',
        'title',
        'description',
        'file',
        'period',
    ];

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function territories()
    {
        return $this->belongsToMany(Territory::class, 'territory_tasks', 'task_id', 'territory_id')
            ->withPivot('status'); // Optional: If you want to include other pivot columns like 'status'
    }
    
}
