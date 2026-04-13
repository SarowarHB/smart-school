<?php

namespace App\View\Composers;

use Illuminate\View\View;

class SidebarComposer
{
    /**
     * Build and return the sidebar navigation tree.
     * Each item may have children to form a nested/grouped menu.
     */
    public function compose(View $view): void
    {
        $view->with('sidebarMenu', $this->menu());
    }

    public function menu(): array
    {
        return [
            [
                'label' => 'Main',
                'type' => 'group',
                'items' => [
                    [
                        'label' => 'Dashboard',
                        'icon' => 'layout-dashboard',
                        'route' => 'dashboard',
                        'href' => '/dashboard',
                    ],
                    [
                        'label' => 'Analytics',
                        'icon' => 'bar-chart-2',
                        'route' => 'analytics',
                        'href' => '/analytics',
                    ],
                ],
            ],
            [
                'label' => 'Management',
                'type' => 'group',
                'items' => [
                    [
                        'label' => 'Users',
                        'icon' => 'users',
                        'route' => 'users.index',
                        'href' => '/users',
                        'children' => [
                            ['label' => 'All Users',   'href' => '/users',               'route' => 'users.index'],
                            ['label' => 'Roles',       'href' => '/roles',               'route' => 'roles.index'],
                            ['label' => 'Permissions', 'href' => '/users/permissions',   'route' => 'users.permissions'],
                        ],
                    ],
                    [
                        'label' => 'Products',
                        'icon' => 'package',
                        'route' => 'products.index',
                        'href' => '/products',
                        'children' => [
                            ['label' => 'All Products', 'href' => '/products',          'route' => 'products.index'],
                            ['label' => 'Categories',   'href' => '/products/categories', 'route' => 'products.categories'],
                        ],
                    ],
                    [
                        'label' => 'Orders',
                        'icon' => 'shopping-cart',
                        'route' => 'orders.index',
                        'href' => '/orders',
                    ],
                    [
                        'label' => 'Invoices',
                        'icon' => 'file-text',
                        'route' => 'invoices.index',
                        'href' => '/invoices',
                    ],
                ],
            ],
            [
                'label' => 'Content',
                'type' => 'group',
                'items' => [
                    [
                        'label' => 'Pages',
                        'icon' => 'file',
                        'route' => 'pages.index',
                        'href' => '/pages',
                    ],
                    [
                        'label' => 'Media',
                        'icon' => 'image',
                        'route' => 'media.index',
                        'href' => '/media',
                    ],
                ],
            ],
            [
                'label' => 'System',
                'type' => 'group',
                'items' => [
                    [
                        'label' => 'Settings',
                        'icon' => 'settings',
                        'route' => 'settings',
                        'href' => '/settings',
                    ],
                    [
                        'label' => 'Reports',
                        'icon' => 'pie-chart',
                        'route' => 'reports',
                        'href' => '/reports',
                    ],
                    [
                        'label' => 'Activity Log',
                        'icon' => 'activity',
                        'route' => 'activity',
                        'href' => '/activity',
                    ],
                ],
            ],
        ];
    }
}
