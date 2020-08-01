<?php

namespace App\Service\Interfaces;

use App\DTO\CartDto;
use App\DTO\User\UserDTO;

interface UserServiceInterface
{
    public function getOrCreate(UserDTO $user);
}
