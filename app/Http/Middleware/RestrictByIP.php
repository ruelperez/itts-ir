<?php

namespace App\Http\Middleware;

use Closure;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RestrictByIP
{
    /**
     * List of allowed IPs.
     *
     * @var array
     */
    protected $allowedIps = '122.54.211.23'; // Replace with your allowed IP
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Fetch the public IP address using an external service like ipify
        $publicIp = $this->getClientIp($request);
        // Check if the public IP is allowed
        if ($publicIp != $this->allowedIps) {
//            return response()->json([
//                'message' => 'Unable to access. Your public IP is not allowed.',
//            ], 403);
            abort(404);
        }

        // Proceed with the request if the IP is allowed
        return $next($request);
    }

    /**
     * Get the client's public IP address.
     *
     * @return string|null
     */
    protected function getClientIp(Request $request)
    {
        // Check for the IP address from common proxy headers
        if ($request->hasHeader('X-Forwarded-For')) {
            // X-Forwarded-For can contain a list of IPs, we need the first one
            return trim(explode(',', $request->header('X-Forwarded-For'))[0]);
        }

        if ($request->hasHeader('X-Real-IP')) {
            return $request->header('X-Real-IP');
        }

        // Fallback to Laravel's default IP detection method
        return $request->ip();
    }
}
