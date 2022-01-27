<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class UserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $expiresAt = now()->addMinutes(2); /* already given time here we already set 2 min. */
            Cache::put('user-is-online-' . Auth::user()->id, true, $expiresAt);
  
            /* user last seen */
            User::where('id', Auth::user()->id)->update(['last_seen' => now()]);
        }
        
        return $next($request);
    }
}
