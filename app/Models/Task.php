<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Модель задач
 */
class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'name',
        'description',
        'start_date',
        'end_date',
        'status',
        'priority',
    ];


    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function task_dependencie()
    {
        return $this->hasMany(TaskDependencies::class);
    }
}
