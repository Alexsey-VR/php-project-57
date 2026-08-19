<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{
    protected $fillable = ['name'];

    const ALLOWED_OPTIONS = [
        'Новый',
        'В работе',
        'На тестировании',
        'Завершён'
    ];

    public static function getAllowedOptions()
    {
        return collect(self::ALLOWED_OPTIONS)->combine(self::ALLOWED_OPTIONS);
    }
}
