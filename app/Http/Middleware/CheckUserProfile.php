<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetail;

class CheckUserProfile
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
        // $userInfo = UserDetail::where('id', auth()->user()->id)->first();
        // if(!$userInfo) {
        //     return redirect()->intended('/join-form');
        // } elseif($request->getPathInfo() == '/join-form') {
        //     return redirect()->intended('/dashboard');
        // }
        return $next($request);
    }
}
