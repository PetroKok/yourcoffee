<?php

namespace App\Service\Implementation\App\User;

use App\DTO\User\UserDTO;
use App\Models\Customer;
use App\Service\Interfaces\UserServiceInterface;
use Illuminate\Support\Facades\Auth;

class UserService implements UserServiceInterface
{
    public $customer;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function getOrCreate(UserDTO $userDTO)
    {
        if (Auth::guard('customer')->check()) {
            return Auth::guard('customer')->user();
        }

        $user = $this->customer->firstOrCreate(
            ['phone' => $userDTO->getPhone()],
            ['phone' => $userDTO->getPhone(), 'name' => $userDTO->getName(), 'registered' => $this->customer::UNREGISTERED]
        );

        dd($user);

        dd('user dto here', $userDTO);
    }
}
