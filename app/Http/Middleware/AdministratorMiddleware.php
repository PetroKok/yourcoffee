<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;

class AdministratorMiddleware extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $user = $request->user();

        $controllerAccess = [
            "Auth\LoginController",
            "Auth\ForgotPasswordController",
            "Auth\ResetPasswordController",
            "Auth\VerificationController",
            "Auth\RegisterController",
        ];

        $hasAccessToController = false;

        $actionName = $request->route()->getActionName();

        foreach($controllerAccess as $controller){
            if(strpos($actionName, $controller) !== false){
                $hasAccessToController = true;
            }
        }

        if($user && $user->isAdmin() || $hasAccessToController){
            return $next($request);
        }

        return redirect()->route('admin::login');
    }
}
