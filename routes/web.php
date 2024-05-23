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
    OrdersController,
    StripeWebhookController,
};
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

Route::get('/about', function () {
    return Inertia::render('About');
})->name('about');

Route::get('/original', function () {
    return Inertia::render('Original');
})->name('original');

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

Route::get('/woodwork', function () {
    return Inertia::render('Woodwork');
})->name('woodwork');


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

Route::get('/products-customer/{product}', [ProductController::class, 'show'])->name('products.show');

// Email Routes ---------

Route::post('/send-message', [ContactController::class, 'send']);
Route::post('/subscribe', [SubscriptionController::class, 'subscribe'])->name('subscribe');
Route::get('/unsubscribe/{email}', [SubscriptionController::class, 'unsubscribe'])->name('unsubscribe');

// E-commerce Routes ---------

Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart');
    Route::post('/', [CartController::class, 'store']);
    Route::delete('/{id}', [CartController::class, 'destroy']);
    Route::post('/clear', [CartController::class, 'clear']);
    Route::post('/item/{id}', [CartController::class, 'update']);
});

Route::prefix('checkout')->group(function () {
    Route::post('/', [ProductController::class, 'checkout'])->name('checkout');
    Route::get('/success', [ProductController::class, 'success'])->name('checkout.success');
    Route::get('/cancel', [ProductController::class, 'cancel'])->name('checkout.cancel');
});

Route::post('/enviorenment', [StripeWebhookController::class, 'handleWebhook'])->name('stripe.webhook');

Route::get('/test', function () {
    return Inertia::render('User/CheckoutForm');
})->name('test');

// Test Page Route ---------

Route::get('/test-area', function () {
    return Inertia::render('TestArea');
})->name('test-area');

// Authenticated Routes ---------

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('products', ProductController::class);

    Route::resources([
        'orders' => OrdersController::class,
        'users' => UserController::class,
        'images' => ImageController::class,
        'categories' => CategoryController::class,
    ]);

    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});

require __DIR__ . '/auth.php';
