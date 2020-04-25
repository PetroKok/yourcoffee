<?php

namespace App\Service\Implementation\App\Cart;

use App\DTO\CartDto;
use App\Repository\Interfaces\ICacheCart;
use App\Repository\Interfaces\IDBCart;
use App\Service\Interfaces\CartServiceInterface;

class CartService implements CartServiceInterface
{
    public $db;
    public $cache;

    public function __construct(IDBCart $db, ICacheCart $cache)
    {
        $this->db = $db;
        $this->cache = $cache;
    }

    public function index(CartDto $cartDto)
    {
        if ($cartDto->getUserId()) {
            return $this->db->index($cartDto);
        }
        return [];
    }

    public function count(CartDto $cartDto)
    {
        if ($cartDto->getUserId()) {
            return $this->db->count($cartDto);
        }
        return 0;
    }

    public function store(CartDto $cartDto)
    {
        if ($cartDto->getUserId()) {
            return $this->db->store($cartDto);
        }
        return [];
    }

    public function delete(CartDto $cartDto)
    {
        if ($cartDto->getUserId()) {
            return $this->db->delete($cartDto);
        }
        return [];
    }
}
