<?php

namespace App\Http\Middleware;

use App\Models\Employee;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckEmployeeCompletion
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            $user = Auth::user();
            // Check if the user has a corresponding employee all-record in the employees table
            $employee = Employee::where('user_id', $user->id)->first();

            // If no employee all-record is found
            if (!$employee) {
                // Redirect to the employee form page with an alert
                return redirect('/employee/incomplete')
                    ->with('alert', 'The employee form must be completed to continue.');
            }
        }
        else{
            return redirect('/user/login');
        }
        return $next($request);
    }
}
