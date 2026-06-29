<?php

namespace App\View\Composers;

use App\Models\Resource\Resource;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SidebarComposer
{
    public function compose(View $view): void
    {
        $view->with('sidebarMenu', $this->menu());
    }

    public function menu(): array
    {
        $user = Auth::user();

        if (! $user) {
            return [];
        }

        $roleIds = $user->accountRoles()
            ->where('is_active', true)
            ->pluck('role_id');

        if ($roleIds->isEmpty()) {
            return [];
        }

        return Resource::whereHas('resourcesPolicies', function ($query) use ($roleIds) {
            $query->where('is_active', true)
                ->whereHas('accessPolicy', fn ($q) => $q->whereIn('role_id', $roleIds));
        })
            ->select('name', 'description', 'res_url')
            ->distinct()
            ->get()
            ->groupBy('name')
            ->map(fn ($items, $groupName) => [
                'label' => $groupName,
                'type' => 'group',
                'items' => $items->map(fn ($item) => [
                    'label' => $item->description,
                    'icon' => 'fas fa-circle',
                    'href' => '/'.str()->of($item->res_url)->trim()->toString(),
                ])->values()->all(),
            ])
            ->values()
            ->all();
    }
}
