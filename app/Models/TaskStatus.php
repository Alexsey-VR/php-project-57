<?php

namespace App\Models;

use Database\Factories\TaskStatusFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Collection;

class TaskStatus extends Model
{
    /** @use HasFactory<TaskStatusFactory> */
    use HasFactory;

    protected $fillable = ['name'];

    public const ALLOWED_OPTIONS = [
        'Новый',
        'В работе',
        'На тестировании',
        'Завершён'
    ];

    /**
     * @return Collection<int, string>
     */
    public static function getAllowedOptions(): Collection
    {
        return collect(self::ALLOWED_OPTIONS)->combine(self::ALLOWED_OPTIONS);
    }
}
