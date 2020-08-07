<?php

namespace App\Service\Interfaces;

use App\DTO\CartDto;

interface CartServiceInterface
{
    public function rawCart(CartDto $cartDto);

    public function index(CartDto $cartDto);

    public function count(CartDto $cartDto);

    public function store(CartDto $cartDto);

    public function delete(CartDto $cartDto);

    public function clearCart(CartDto $cartDto);
}
