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
                ],
            ],
            [
                'label' => 'Management',
                'type' => 'group',
                'items' => [
                    [
                        'label' => 'Roles',
                        'icon' => 'shield',
                        'route' => 'roles.index',
                        'href' => '/roles',
                    ],
                    [
                        'label' => 'Actions',
                        'icon' => 'zap',
                        'route' => 'actions.index',
                        'href' => '/actions',
                    ],
                    [
                        'label' => 'Policies',
                        'icon' => 'file-check',
                        'route' => 'policies.index',
                        'href' => '/policies',
                    ],
                    [
                        'label' => 'Resource Policies',
                        'icon' => 'link',
                        'route' => 'resource-policies.index',
                        'href' => '/resource-policies',
                    ],
                    [
                        'label' => 'Assessment Resources',
                        'icon' => 'book-open',
                        'route' => 'assessment-resources.index',
                        'href' => '/assessment-resources',
                    ],
                    [
                        'label' => 'Resources',
                        'icon' => 'folder',
                        'route' => 'resources.index',
                        'href' => '/resources',
                    ],
                ],
            ],
            [
                'label' => 'Question Settings',
                'type' => 'group',
                'items' => [
                    [
                        'label' => 'Cycles',
                        'icon' => 'refresh-cw',
                        'route' => 'question-cycles.index',
                        'href' => '/question-cycles',
                    ],
                    [
                        'label' => 'Grades',
                        'icon' => 'bar-chart',
                        'route' => 'question-grades.index',
                        'href' => '/question-grades',
                    ],
                    [
                        'label' => 'Subjects',
                        'icon' => 'book',
                        'route' => 'question-subjects.index',
                        'href' => '/question-subjects',
                    ],
                    [
                        'label' => 'Types',
                        'icon' => 'tag',
                        'route' => 'question-types.index',
                        'href' => '/question-types',
                    ],
                ],
            ],
        ];
    }
}
