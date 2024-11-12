<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CommentController;
use App\Http\Controllers\Frontend\MessageController;
use App\Http\Controllers\Frontend\UserAddressController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Auth\RegisterUserController;
use App\Http\Controllers\Frontend\CheckOutController;
use App\Http\Controllers\Frontend\UserOrderController;
use App\Http\Controllers\Frontend\UserProfileController;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\Auth\AuthenticateSessionController;
use App\Http\Controllers\Frontend\FrontendProductController;
use App\Http\Controllers\Frontend\UserCouponsController;
use App\Http\Controllers\Frontend\OpenAIController;

// Auth
Route::get('admin', [AuthenticateSessionController::class, 'index'])
    ->name('auth.admin');
Route::post('login', [AuthenticateSessionController::class, 'store'])->name('auth.login');
Route::get('login', [AuthenticateSessionController::class, 'index'])->name('auth.login.web');
Route::get('register', [RegisterUserController::class, 'create'])->name('auth.register');
Route::post('register', [RegisterUserController::class, 'store'])->name('auth.register.store');
Route::post('logout', [AuthenticateSessionController::class, 'destroy'])
    ->name('auth.logout');

require __DIR__ . '/auth.php';

Route::get('products', [ProductController::class, 'productsIndex'])->name('products.index');;
Route::get('frontend/category', function () {
    return view('frontend.user.categories.index');
});
Route::get('/', [ProductController::class, 'productsIndex'])->name('home');
Route::get('index', [ProductController::class, 'productsIndex'])->name('products.index');
Route::get('category', [ProductController::class, 'productCategories'])->name('products.category');
//details
Route::get('product/{slug}', [ProductController::class, 'showProduct'])->name('product.details');
Route::get('getPrice', [ProductController::class, 'getPrice'])->name('getPrice');

Route::post('rating', [ProductController::class, 'rating'])->name('product.rating');

Route::get('subcategory', [ProductController::class, 'productSubCategories'])->name('products.subcategory');
Route::get('get-districts/{province_id}', [CartController::class, 'getDistricts'])->name('get-districts');
Route::get('get-wards/{district_id}', [CartController::class, 'getWards'])->name('get-wards');
Route::get('cart', [CartController::class, 'index'])->name('cart.index');
Route::post('cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('cart/update', [CartController::class, 'update'])->name('cart.updateQuantity');
Route::get('apply-coupon', [CartController::class, 'applyCoupon'])->name('apply-coupon');
Route::get('remove-coupon', [CartController::class, 'removeCoupon'])->name('remove-coupon');
Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

Route::resource('comments', CommentController::class);

Route::post('comments/change-status', [CommentController::class, 'changeStatus'])->name('comments.change-status');
Route::post('comments/delete', [CommentController::class, 'destroy'])->name('comments.destroy');
Route::post('comments/update', [CommentController::class, 'update'])->name('comments.update');
Route::post('comments/likeComment', [CommentController::class, 'likeComment'])->name('comments.likeComment');

// load lại tt giỏ hàng khi xóa discount
Route::get('reloadCart', [CartController::class, 'reloadCartDiscount'])->name('reloadCart');
Route::get('reloadCodeCoupon', [CartController::class, 'reloadCodeCoupon'])->name('reloadCodeCoupon');
// thanh toán
Route::get('checkout/return', [PaymentController::class, 'vnpay_return'])->name('vnpay.return');
Route::post('checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::get('bookingSuccess', [PaymentController::class, 'booking_success'])->name('booking.success');
// thanh toán momo
Route::post('momo-payment-atm', [PaymentController::class, 'payWithMOMO_ATM'])->name('payment.momoatm');
Route::post('momo-payment-qr-', [PaymentController::class, 'payWithMOMO_QR'])->name('payment.momoqr');
Route::get('momo-payment-return', [PaymentController::class, 'momo_return'])->name('momo.return');

Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'user', 'as' => 'user.'], function () {

    Route::post('message/sentmessage', [MessageController::class, 'store'])->name('message.store');
    Route::get('message/getNewMessages', [MessageController::class, 'getNewMessages'])->name('message.getNewMessages');
    Route::get('paypal/payment', [CheckOutController::class, 'checkOutPayPal'])->name('paypal.payment');
    Route::get('paypal/success', [PaymentController::class, 'paypalSuccess'])->name('paypal.success');
    Route::get('paypal/cancel', [PaymentController::class, 'paypalCancel'])->name('paypal.cancel');
    Route::get('message', [MessageController::class, 'index'])->name('message.index');
    Route::post('payment/cod', [CheckOutController::class, 'checkOut'])->name('cod.store');
    Route::get('dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('profile', [UserProfileController::class, 'index'])->name('dashboard.profile');
    Route::put('profile', [UserProfileController::class, 'updateProfile'])->name('profile.update');
    Route::get('order',[UserOrderController::class,'index'])->name('order.index');
    Route::get('order/show/{id}',[UserOrderController::class,'show'])->name('order.show');
    Route::resource('address', UserAddressController::class);
    Route::post('profile', [UserProfileController::class, 'updatePassword'])->name('profile.update.password');
    Route::resource('user-coupons',UserCouponsController::class);
    Route::get('showcoupons',[UserCouponsController::class,'showcoupons'])->name('user-coupons.showcoupons');

});
Route::get('get-price-by-variant',[FrontendProductController::class,'getPriceByVariant'])->name('getByVariant');
Route::get('getByColor',[FrontendProductController::class,'getPriceByVariantAndColor'])->name('getByColor');
Route::post('user/coupons/redeem', [UserCouponsController::class, 'redeem'])->name('coupons.redeem');
Route::post('zalo-pay', [PaymentController::class, 'payWithZALOPAY'])->name('payment.zalopay');
Route::get('callbackzalopay', [PaymentController::class, 'callbackZALOPAY'])->name('zalopay.callback');
Route::get('send-email', [PaymentController::class, 'sendMail'])->name('send-email');
Route::post('/chatbot-response', [OpenAIController::class, 'getChatbotResponse'])->name('chatbot-response');
Route::get('get-chat', [OpenAIController::class, 'getChat'])->name('get-chat');
