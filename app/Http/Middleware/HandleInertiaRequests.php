<?php

namespace App\Http\Middleware;

use App\Models\Account\Account;
use App\View\Composers\SidebarComposer;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    protected $rootView = 'app';

    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    public function share(Request $request): array
    {
        $composer = new SidebarComposer;

        /** @var Account|null $account */
        $account = $request->user();

        return [
            ...parent::share($request),

            'auth' => [
                'user' => $account ? [
                    'id' => $account->id,
                    'name' => $account->name,           // computed: first + last
                    'first_name' => $account->first_name,
                    'last_name' => $account->last_name,
                    'email' => $account->email,
                    'avatar' => $account->avatar,         // from external_user_profile JSON
                    'status' => $account->status,
                    'account_type' => $account->account_type_id,
                ] : null,
            ],

            // Sidebar menu populated by ViewComposer
            'sidebarMenu' => $composer->menu(),

            'flash' => [
                'success' => session('success'),
                'error' => session('error'),
            ],
        ];
    }
}
