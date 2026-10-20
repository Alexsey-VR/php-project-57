<?php

namespace App\Services;

use App\Models\Label;
use Illuminate\Database\Eloquent\Collection;

class LabelService
{
    public function getLabelInstance(): Label
    {
        return new Label();
    }

    /**
     * @return Collection<int, Label>
     */
    public function getLabels(): Collection
    {
        return Label::all();
    }

    /**
     * @param array<string, mixed> $validatedData
     */
    public function createLabel(array $validatedData): void
    {
        Label::create($validatedData);
    }

    /**
     * @param array<string, mixed> $validatedData
     */
    public function updateLabel(array $validatedData, Label $label): void
    {
        $label->update($validatedData);
    }

    public function destroyLabel(Label $label): bool
    {
        if ($label->tasks->count() === 0) {
            $label->delete();

            return true;
        }

        return false;
    }
}
