<?php

namespace App\Helpers;

use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class LogHelper
{
    public static function save(
        string $description,
        array $changes = [],
        ?int $userId = null
    ): void {
        Log::create([
            'user_id' => $userId ?? Auth::user()->id,
            'description' => $description,
            'changes' => $changes,
        ]);
    }
}
