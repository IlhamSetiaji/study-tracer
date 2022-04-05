<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsSiswaMiddleware
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
            if($user->hasRole('siswa'))
            {
                return $next($request);
            }
            elseif($user->hasRole('guru'))
            {
                return redirect('/guru')->with('status','Anda bukan user admin');
            }
            elseif($user->hasRole('admin'))
            {
                return redirect('/admin')->with('status','Anda bukan user admin');
            }
        }
        return redirect('/login')->with('status','Anda belum melakukan authentikasi');
    }
}
