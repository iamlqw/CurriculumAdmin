<?php

namespace App\Http\Middleware;

use Closure;

class TeacherLogin
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
        if (!session('user')||session('user')['user_identity']!='teacher'){
            return redirect('admin/login');
        }
        return $next($request);
    }
}
