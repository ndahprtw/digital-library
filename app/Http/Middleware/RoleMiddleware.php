<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // cek apakah user sudah login
        // note code ini tidak diperlukan jika di web.php menggunakan Route::middleware(['auth',...
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        // cek role user
        if (! in_array(Auth::user()->role, $roles)) {
            abort(403);
            // dd(Auth::check(), Auth::user());
        }

        return $next($request);
    }
}
