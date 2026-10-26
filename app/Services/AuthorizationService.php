<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class AuthorizationService
{
    /**
     * @param array<string, mixed> $validatedData
     * @return array<string, mixed>
     */
    public function authorize(array $validatedData): array
    {
        $validatedData['created_by_id'] = Auth::id();

        return $validatedData;
    }
}
