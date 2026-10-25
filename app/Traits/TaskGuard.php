<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Relations\Relation;

trait TaskGuard
{
    abstract public function tasks(): Relation;

    public function hasTasks(): bool
    {
        return $this->tasks()->exists();
    }
}
