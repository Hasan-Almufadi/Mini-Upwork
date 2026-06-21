<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        // إذا وجدنا لغة مخزنة، طبقها.. وإذا لم نجد، اجعل التركية هي اللغة الأساسية
        if (session()->has('locale')) {
            app()->setLocale(session('locale'));
        } else {
            app()->setLocale('tr'); 
        }

        return $next($request);
    }
}