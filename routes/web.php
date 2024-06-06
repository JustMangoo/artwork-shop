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

Route::get('/products-customer/{category?}', [ProductController::class, 'showCategory'])
    ->name('products.showCategory');

Route::get('/original', function () {
    return redirect()->route('products.showCategory', ['category' => 'Originals']);
})->name('original');

Route::get('/printed', function () {
    return redirect()->route('products.showCategory', ['category' => 'Printets']);
})->name('printed');

Route::get('/woodwork', function () {
    return redirect()->route('products.showCategory', ['category' => 'Kokdarbi']);
})->name('woodwork');

Route::get('/products-customer', function () {
    return redirect()->route('products.showCategory');
})->name('products-customer');

Route::get('/products-customer/details/{product}', [ProductController::class, 'show'])->name('products.show');

// Email Routes ---------

Route::post('/send-message', [ContactController::class, 'send']);
Route::post('/subscribe', [SubscriptionController::class, 'subscribe'])->name('subscribe');
Route::get('/unsubscribe/{token}', [SubscriptionController::class, 'unsubscribe'])->name('unsubscribe');

// E-commerce Routes ---------

Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart');
    Route::post('/', [CartController::class, 'store']);
    Route::delete('/{id}', [CartController::class, 'destroy']);
    Route::post('/clear', [CartController::class, 'clear']);
    Route::patch('/item/{id}', [CartController::class, 'update']);
});

Route::prefix('checkout')->group(function () {
    Route::post('/', [ProductController::class, 'checkout'])->name('checkout');
    Route::get('/success', [ProductController::class, 'success'])->name('checkout.success');
    Route::get('/cancel', [ProductController::class, 'cancel'])->name('checkout.cancel');
});

Route::post('/stripe-webhook', [StripeWebhookController::class, 'handleWebhook'])->name('stripe.webhook');

Route::get('/test', function () {
    return Inertia::render('User/CheckoutForm');
})->name('test');

// Test Page Route ---------

Route::get('/test-area', function () {
    return Inertia::render('TestArea');
})->name('test-area');

// Authenticated Routes ---------

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/customer/orders', [OrdersController::class, 'customerOrders'])
        ->name('customer.orders')
        ->middleware('customer');

    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('products', ProductController::class)
            ->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);

        Route::resources([
            'orders' => OrdersController::class,
            'users' => UserController::class,
            'images' => ImageController::class,
            'categories' => CategoryController::class,
        ]);


    });
});


require __DIR__ . '/auth.php';
