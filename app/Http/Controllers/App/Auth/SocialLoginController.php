<?php

namespace App\Http\Controllers\App\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Cassandra\Custom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function redirectTo(Request $request, string $provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleCallback(Request $request)
    {
        try {
            $user = Socialite::driver('google')->user();

            $customer = Customer::where('google_id', $user->id)->first();

            if ($customer) {
                Auth::guard('customer')->login($customer);
                return redirect()->route('home');
            } else {
                $newCustomer = Customer::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id
                ]);

                Auth::login($newCustomer);

                return redirect()->route('home');
            }

        } catch (Exception $e) {
            return redirect('auth/google');
        }
    }
}
