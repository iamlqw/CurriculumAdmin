<?php

namespace App\Http\Middleware;

use Closure;

class StudentLogin
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
        if (!session('user')||session('user')['user_identity']!='student'){
            return redirect('admin/login');
        }
        return $next($request);
    }
}
