<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckLevel
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

        // $user = User::where('email', $request->email)->first();
        // if ($user->level == 'admin') {
        //     return redirect('/home');
        // } elseif ($user->level == 'gudang') {
        //     return redirect('/');
        // }

        // if (Auth::user()->level === 'admin') {
        //     return $next($request);
        // }

        return $next($request);
    }
}
