<?php


namespace App\DTO;


class CartDto
{
    public $product_id;
    public $qty;
    public $replace = false;
    public $user_id;

    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * @param mixed $product_id
     */
    public function setProductId($product_id): void
    {
        $this->product_id = $product_id;
    }

    /**
     * @return mixed
     */
    public function getQty()
    {
        return $this->qty;
    }

    /**
     * @param mixed $qty
     */
    public function setQty($qty): void
    {
        $this->qty = $qty;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return bool
     */
    public function isReplace(): bool
    {
        return $this->replace;
    }

    /**
     * @param bool $replace
     */
    public function setReplace(bool $replace): void
    {
        $this->replace = $replace;
    }
}
