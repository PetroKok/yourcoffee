<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;

class CartInfoMiddleware extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        [$carts_count, $full_amount] = getCart();

        \View::share('carts_count', $carts_count);
        \View::share('full_amount', $full_amount);
        \View::share('customer', \Auth::guard('customer')->user());

        return $next($request);
    }
}
