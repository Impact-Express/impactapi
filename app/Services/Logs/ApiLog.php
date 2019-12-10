<?php

namespace App\Services\Logs;


use App\Log;

class ApiLog
{
    public static function write(int $apiUserId, string $action = '') {
        Log::create([
            'api_user_id' => $apiUserId,
            'action' => $action
        ]);
    }
}
