<?php

namespace App\Models;

use Database\Factories\TaskStatusFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class TaskStatus extends Model
{
    /** @use HasFactory<TaskStatusFactory> */
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * @return Collection<string, string>
     */
    public static function getAllowedTaskStatusOptions(string $locale = 'en'): Collection
    {
        return collect(self::all())
            ->pluck('name', 'name');
    }

    /**
     * @return HasMany<Task, covariant static>
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'status_id');
    }
}
