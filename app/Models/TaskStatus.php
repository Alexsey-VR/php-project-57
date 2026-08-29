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
        'New',
        'In progress',
        'Testing',
        'Completed'
    ];

    /**
     * @return Collection<string, string>
     */
    public static function getAllowedOptions(string $locale = 'en'): Collection
    {
        $locales = [
            'tasks.status.options.new',
            'tasks.status.options.in_progress',
            'tasks.status.options.testing',
            'tasks.status.options.completed'
        ];
        $translations = array_combine(self::ALLOWED_OPTIONS, $locales);

        return collect(self::ALLOWED_OPTIONS)
            ->mapWithKeys(fn($key) => [$key => trans($translations[$key], [], $locale)]);
    }
}
