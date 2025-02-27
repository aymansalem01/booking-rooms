<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Role
{

    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (Auth::check()) {
            $role = auth()->user()->role;
            if (in_array($role, $roles)) {
                return $next($request);
            } else {
                return redirect()->back()->with(['message' => ' your role not match']);
            }
        } else {
            return redirect()->route('login');
        }
    }
}
