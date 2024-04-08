<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Product;
use App\Models\Subscription;

class DashboardController extends Controller
{
    public function index()
    {
        $productCount = Product::count();
        $userCount = User::count();
        $subscriptionCount = Subscription::count();

        return Inertia::render('Admin/Dashboard', [
            'productCount' => $productCount,
            'userCount' => $userCount,
            'subscriptionCount' => $subscriptionCount,
        ]);
    }
}
