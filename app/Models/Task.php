<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Task extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory, InteractsWithMedia;

    protected $appends = ['media_file'];

    protected $fillable = [
        'name',
        'is_completed',
        'due_date'
    ];

    protected function casts(): array
    {
        return [
            'is_completed' => 'boolean',
            'due_date' => 'date',
        ];
    }

    public function getMediaFileAttribute()
    {
        if ($this->relationLoaded('media')) {
            return $this->getFirstMedia('tasks');
        }
        return [];
    }

    public function taskCategories(): BelongsToMany
    {
        return $this->belongsToMany(TaskCategory::class, 'task_task_category');
    }
}
