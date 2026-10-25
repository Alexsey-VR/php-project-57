<?php

namespace App\Models;

use Database\Factories\LabelFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\TaskGuard;

class Label extends Model
{
    /** @use HasFactory<LabelFactory> */
    use HasFactory;

    use TaskGuard;

    protected $fillable = [
        'name',
        'description'
    ];

    /**
     * @return BelongsToMany<Task, covariant static>
     */
    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class, 'task_labels');
    }

    public function cleanUp(): void
    {
        $this->delete();
    }
}
