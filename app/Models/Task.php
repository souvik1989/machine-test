<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'task_category_id',
        'description',
        'due_date',
        'priority',
        'status'
    ];

    public function task_category()
    {
        return $this->belongsTo(TaskCategory::class);
    }
}
