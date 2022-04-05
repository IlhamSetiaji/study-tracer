<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsGuruMiddleware
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
        if(auth()->check())
        {
            $user=request()->user();
            if($user->hasRole('guru'))
            {
                return $next($request);
            }
            elseif($user->hasRole('admin'))
            {
                return redirect('/admin')->with('status','Anda bukan user admin');
            }
            elseif($user->hasRole('siswa'))
            {
                return redirect('/siswa')->with('status','Anda bukan user admin');
            }
        }
        return redirect('/login')->with('status','Anda belum melakukan authentikasi');
    }
}
