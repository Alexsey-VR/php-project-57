<?php

namespace App\Services;

use App\Models\Label;
use Illuminate\Database\Eloquent\Collection;
use App\Services\OrphanCleanupService;

class LabelService
{
    public function __construct(
        protected OrphanCleanupService $cleanupService
    ) {
        //
    }

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

    public function destroyLabel(Label $label): void
    {
        $this->cleanupService->cleanupFor($label);
    }
}
