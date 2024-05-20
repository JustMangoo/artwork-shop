<?php

use App\Http\Controllers\{
    ProfileController,
    ProductController,
    CategoryController,
    ImageController,
    DashboardController,
    UserController,
    ContactController,
    SubscriptionController,
    CartController,
    OrdersController
};
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

Route::get('/printed', function () {
    $products = Product::with(['images'])->get();
    return Inertia::render('Printed', [
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
})->name('printed');

Route::get('/about', function () {
    return Inertia::render('About');
})->name('about');

Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart', [CartController::class, 'store']);
Route::delete('/cart/{id}', [CartController::class, 'destroy']);
Route::post('/cart/clear', [CartController::class, 'clear']);


Route::post('/cart/item/{id}', [CartController::class, 'update']);

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
    Route::resource('orders', OrdersController::class);
    Route::resource('users', UserController::class);
    Route::resource('images', ImageController::class);
    Route::resource('categories', CategoryController::class);
});

Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

Route::middleware(['cors'])->group(function () {
    Route::post('/checkout', [ProductController::class, 'checkout'])->name('checkout');
    Route::get('/checkout/success', [ProductController::class, 'success'])->name('checkout.success');
    Route::get('/checkout/cancel', [ProductController::class, 'cancel'])->name('checkout.cancel');
});

Route::get("/testroute", function () {
    $name = "A name";

    Mail::to('daugatsa@gmail.com')->send(new MyEmail());
});

Route::post('/send-message', [ContactController::class, 'send']);

Route::post('/subscribe', [SubscriptionController::class, 'subscribe'])->name('subscribe');
Route::get('/unsubscribe/{email}', [SubscriptionController::class, 'unsubscribe'])->name('unsubscribe');

Route::get('/test-area', function () {
    return Inertia::render('TestArea');
})->name('test-area');


require __DIR__ . '/auth.php';
