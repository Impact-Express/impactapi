<?php

namespace App\Http\Middleware;

use Closure;
use App\ApiUser;

class CheckIfCustomer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $customerName = $request['ManifestUpload']['CustomerDetails']['CustomerName'];
        $accountNumber = $request['ManifestUpload']['CustomerDetails']['AccountNumber'];
        $apiToken = hash('sha256', str_replace('Bearer ', '', str_replace('Basic ', '', $request->header('Authorization'))));

        if (ApiUser::where([
            'account_number' => $accountNumber,
            'api_name' => $customerName,
            'api_token' => $apiToken
        ])->exists()) {
            $user = ApiUser::where([
                'account_number' => $accountNumber,
                'api_name' => $customerName,
                'api_token' => $apiToken
            ])->first();
        } else {
            return redirect(404); // response here with errors
        }

        return $next($request);
    }
}
