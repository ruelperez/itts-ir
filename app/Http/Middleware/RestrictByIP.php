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
        $publicIp = $this->getPublicIP();
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
    protected function getPublicIP()
    {
        try {
            $client = new Client();
            $response = $client->request('GET', 'https://api.ipify.org?format=json');
            $data = json_decode($response->getBody()->getContents(), true);

            return $data['ip'] ?? null;
        } catch (\Exception $e) {
            return null;
        }
    }
}
