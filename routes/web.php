<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SubscriptionController;
use App\Mail\MyEmail;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Product;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Home', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/products-customer', function () {
    $products = Product::with(['images'])->get();
    return Inertia::render('Products', [
        'products' => $products->map(function ($product) {
            return [
                'id' => $product->id,
                'title' => $product->title,
                'description' => $product->description,
                'price' => $product->price,
                'categories' => $product->category,
                'images' => $product->images->map(function ($image) {
                    return ['url' => Storage::url($image->image)];
                })->toArray(),
                'created_at' => $product->created_at,
            ];
        }),
    ]);
})->name('products-customer');

Route::get('/about', function () {
    return Inertia::render('About');
})->name('about');

Route::get('/cart', function () {
    return Inertia::render('User/Cart');
})->name('cart');

Route::get('/printed', function () {
    return Inertia::render('Printed');
})->name('printed');

Route::get('/original', function () {
    return Inertia::render('Original');
})->name('original');

Route::get('/woodwork', function () {
    return Inertia::render('Woodwork');
})->name('woodwork');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

Route::middleware('auth')->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('users', UserController::class);
    Route::resource('images', ImageController::class);
    Route::resource('categories', CategoryController::class);
});

Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

Route::get("/testroute", function () {
    $name = "A name";

    Mail::to('daugatsa@gmail.com')->send(new MyEmail());
});

Route::post('/send-message', [ContactController::class, 'send']);

Route::post('/subscribe', [SubscriptionController::class, 'subscribe'])->name('subscribe');
Route::get('/unsubscribe/{email}', [SubscriptionController::class, 'unsubscribe'])->name('unsubscribe');


require __DIR__ . '/auth.php';
