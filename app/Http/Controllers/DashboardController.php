<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard/Index', [
            'stats' => [
                ['label' => 'Total Users',   'value' => '12,489', 'change' => '+12.5%', 'trend' => 'up',   'icon' => 'users'],
                ['label' => 'Revenue',       'value' => '$48,295','change' => '+8.2%',  'trend' => 'up',   'icon' => 'dollar-sign'],
                ['label' => 'Active Orders', 'value' => '1,234',  'change' => '-3.1%',  'trend' => 'down', 'icon' => 'shopping-cart'],
                ['label' => 'Growth',        'value' => '24.7%',  'change' => '+4.6%',  'trend' => 'up',   'icon' => 'trending-up'],
            ],
        ]);
    }
}
