<?php

namespace App\Service\Implementation\App\Cart;

use App\DTO\CartDto;
use App\Http\Resources\App\Cart\CartCacheResource;
use App\Http\Resources\App\Cart\CartDBResource;
use App\Http\Resources\App\Cart\ProductResource;
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

    public function rawCart(CartDto $cartDto)
    {
        if ($cartDto->getUserId()) {
            return $this->db->rawCart($cartDto);
        }
        return collect($this->cache->rawCart($cartDto));
    }

    public function index(CartDto $cartDto)
    {
        if ($cartDto->getUserId()) {
            return CartDBResource::collection($this->db->index($cartDto));
        }
        return CartCacheResource::collection(collect($this->cache->index($cartDto)));
    }

    public function count(CartDto $cartDto)
    {
        if ($cartDto->getUserId()) {
            return $this->db->count($cartDto);
        }

        return $this->cache->count($cartDto);
    }

    public function store(CartDto $cartDto)
    {
        if ($cartDto->getUserId()) {
            return new CartDBResource($this->db->store($cartDto));
        }
        return new CartCacheResource($this->cache->store($cartDto));
    }

    public function delete(CartDto $cartDto)
    {
        if ($cartDto->getUserId()) {
            return $this->db->delete($cartDto);
        }
        return $this->cache->delete($cartDto);
    }

    public function clearCart(CartDto $cartDto)
    {
        if ($cartDto->getUserId()) {
            return $this->db->clearCart($cartDto);
        }
        return $this->cache->clearCart($cartDto);
    }
}
