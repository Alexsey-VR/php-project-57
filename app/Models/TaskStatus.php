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

    public const ALLOWED_OPTIONS = [
        'new',
        'in_progress',
        'testing',
        'completed'
    ];

    /**
     * @return Collection<string, string>
     */
    public static function getAllowedTaskStatusOptions(string $locale = 'en'): Collection
    {
        return collect(self::ALLOWED_OPTIONS)
            ->mapWithKeys(fn($key) => [$key => trans("tasks.status.options.{$key}", [], $locale)]);
    }

    /**
     * @return Collection<int, string>
     */
    public static function getAllowedTaskStatusIndexOptions(string $locale = 'en'): Collection
    {
        return collect(self::ALLOWED_OPTIONS)
            ->map(fn($key) => trans("tasks.status.options.{$key}", [], $locale));
    }

    /**
     * @return hasMany<Task, covariant static>
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'status_id');
    }
}
