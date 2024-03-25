<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $productCount = Product::count();
        $userCount = User::count();

        return Inertia::render('Admin/Dashboard', [
            'productCount' => $productCount,
            'userCount' => $userCount,
        ]);
    }
}
