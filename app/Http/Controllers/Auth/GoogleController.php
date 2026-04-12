<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()->route('login')
                ->withErrors(['google' => 'Google authentication failed. Please try again.']);
        }

        // Split display name into first / last
        $nameParts = explode(' ', $googleUser->getName(), 2);
        $firstName  = $nameParts[0];
        $lastName   = $nameParts[1] ?? '';

        // Store the full Google profile so we can extract avatar etc.
        $profile = [
            'id'      => $googleUser->getId(),
            'name'    => $googleUser->getName(),
            'email'   => $googleUser->getEmail(),
            'avatar'  => $googleUser->getAvatar(),
            'token'   => $googleUser->token,
        ];

        /** @var Account $account */
        $account = Account::updateOrCreate(
            // Match on the Google user-id stored in social_id
            ['social_id' => $googleUser->getId()],
            [
                'first_name'            => $firstName,
                'last_name'             => $lastName,
                'email'                 => $googleUser->getEmail(),
                'external_user_id'      => $googleUser->getId(),
                'external_user_profile' => $profile,
                'status'                => true,
                // 6 = Admin account type — change as needed
                'account_type_id'       => 6,
            ]
        );

        Auth::login($account);

        return redirect()->intended(route('dashboard'));
    }
}
