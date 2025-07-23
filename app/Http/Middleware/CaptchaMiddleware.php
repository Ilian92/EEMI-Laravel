<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CaptchaMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Vérifier si le CAPTCHA a été validé pour cette session
        if (!session('captcha_validated', false)) {
            // Rediriger vers le CAPTCHA si pas validé
            return redirect()->route('captcha.foot')
                ->with('error', 'Veuillez valider le CAPTCHA pour continuer.');
        }

        return $next($request);
    }
}