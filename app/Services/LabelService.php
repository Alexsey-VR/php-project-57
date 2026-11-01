<?php

namespace App\Services;

use App\Models\Label;
use Illuminate\Pagination\LengthAwarePaginator;
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
     * @return LengthAwarePaginator<int, Label>
     */
    public function getLabels(): LengthAwarePaginator
    {
        return Label::orderBy('id')
            ->paginate(config('pagination.per_page'))
            ->withQueryString();
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
