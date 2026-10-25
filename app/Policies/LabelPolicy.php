<?php

namespace App\Policies;

use App\Models\Label;
use App\Models\User;

class LabelPolicy
{
    /**
     * Determine whether the user can delete the label.
     */
    public function delete(User $user, Label $label): bool
    {
        return !$label->hasTasks();
    }
}
