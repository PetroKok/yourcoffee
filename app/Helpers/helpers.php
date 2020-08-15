<?php

use App\DTO\CartDto;
use App\Service\Interfaces\CartServiceInterface;
use Illuminate\Support\Facades\Auth;

function price_format($price, int $decimals = 2, string $dec_point = '.', $thousands_sep = '')
{
    return number_format($price, $decimals, $dec_point, $thousands_sep);
}


function getCart()
{
    try {
        $cart = app(CartServiceInterface::class);
        $cartDTO = new CartDto();
        $cartDTO->setUserId(Auth::guard('customer')->user() ? Auth::guard('customer')->id() : null);
        return $cart->count($cartDTO);
    } catch (\Throwable $e) {
        return [0, 0];
    }
}
