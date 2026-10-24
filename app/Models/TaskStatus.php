<?php

namespace App\Models;

use Database\Factories\TaskStatusFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use App\Traits\TaskGuard;

class TaskStatus extends Model
{
    /** @use HasFactory<TaskStatusFactory> */
    use HasFactory;

    use TaskGuard;

    protected $fillable = ['name'];

    /**
     * @return Collection<int, string>
     */
    public static function getAllowedTaskStatusOptions(): Collection
    {
        return static::pluck('name', 'id');
    }

    /**
     * @return HasMany<Task, covariant static>
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'status_id');
    }
}
