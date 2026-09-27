<?php

namespace App\Models;

use Database\Factories\LabelFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Label extends Model
{
    /** @use HasFactory<LabelFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    /**
     * @return HasMany<Task, covariant static>
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'label_id');
    }
}
