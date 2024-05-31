<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\MainPageController;
use App\Http\Controllers\DisplayController;
use App\Http\Controllers\DetailPageController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfileChangeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ShippingChangeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\LineLoginController;

// Route::get('/', function () {
// return view('welcome');
// });

// Route::get('/dashboard', function () {
// return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
// Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
// Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
// Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';

Route::middleware('web')->group(
    function () {

        Route::get('/test', function () {
            return 'abc';
        });

        Route::get('/register', [RegisterController::class, 'registerView'])->name('registerView');
        Route::post('/register', [RegisterController::class, 'register'])->name('register');

        Route::get('/login', [LoginController::class, 'loginView'])->name('loginView');
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

        Route::get('/linelogin', 'LineLoginController@lineLogin')->name('linelogin');
        Route::get('/callback', 'LineLoginController@callback')->name('callback');

        Route::get('/', [MainPageController::class, 'mainView'])->name('mainView');
        Route::get('/refine', [MainPageController::class, 'mainSearchRefineView'])->name('mainSearchRefineView');

        Route::get('/detail/{id}', [DetailPageController::class, 'detailView'])->name('detailView');
        Route::post('/detail/{id}/shipping', [DetailPageController::class, 'updateShippingStatusCurrently'])->name('StatusCurrently');
        Route::post('/detail/{id}/shipping_complete', [DetailPageController::class, 'updateShippingStatusComplete'])->name('StatusComplete');

        // 以下要認証

        Route::get('/admin_top', [AdminController::class, 'adminView'])->name('adminView');
        Route::get('/admin_add', [AdminController::class, 'addNewAdminView'])->name('addNewAdminView');
        Route::post('/admin_add', [AdminController::class, 'addNewAdmin'])->name('addNewAdmin');
        Route::get('/admin_item_list', [AdminController::class, 'itemListView'])->name('itemListView');
        Route::get('/admin_email', [AdminController::class, 'sendEmailView'])->name('sendEmailView');
        Route::post('/admin_email', [AdminController::class, 'sendEmail'])->name('sendEmail');
        Route::get('/admin_confirm_amount', [AdminController::class, 'confirmAmountView'])->name('confirmAmountView');

        Route::get('/detail/comment/{item_id}', [CommentController::class, 'commentView'])->name('commentView');
        Route::post('/detail/comment/submit/{item_id}', [CommentController::class, 'comment'])->name('comment');
        Route::delete('/detail/comment/delete/{comment_id}/{item_id}', [CommentController::class, 'commentDelete'])->name('commentDelete');

        Route::get('/confirm_purchase/{item_id}', [PurchaseController::class, 'confirmPurchaseView'])->name('confirmPurchaseView');
        Route::get('/payment_method/{item_id}', [PurchaseController::class, 'paymentMethodView'])->name('paymentMethodView');
        Route::post('/purchase/{item_id}', [PurchaseController::class, 'Purchase'])->name('purchase');

        Route::post('/purchase/update_payment_method/{item_id}', [PurchaseController::class, 'updatePaymentMethod'])->name('updatePaymentMethod');

        Route::get('/shipping_change/{item_id}', [ShippingChangeController::class, 'shippingChangeView'])->name('shippingChangeView');
        Route::post('/shipping_change/{item_id}', [ShippingChangeController::class, 'shippingChange'])->name('shippingChange');

        Route::get('/mypage', [MyPageController::class, 'mypageView'])->name('mypageView');
        Route::get('/mypage/purchased_item', [MyPageController::class, 'mypagePurchasedItemsView'])->name('mypagePurchasedItemsView');

        Route::get('/my_items', [MainPageController::class, 'mainMyDisplayItemsView'])->name('mainMyDisplayItemsView');

        Route::get('/display_item', [DisplayController::class, 'displayItemView'])->name('displayItemView');
        Route::post('/display_item', [DisplayController::class, 'displayItem'])->name('displayItem');

        Route::get('/review/{id}', [ReviewController::class, 'reviewView'])->name('reviewView');
        Route::post('/review_buyer/{id}', [ReviewController::class, 'postReviewBuyer'])->name('postReviewBuyer');
        Route::post('/review_selleryer/{id}', [ReviewController::class, 'postReviewSeller'])->name('postReviewSeller');

        Route::post('/{item_id}', [LikeController::class, 'like'])->name('like');
        Route::delete('/{item_id}', [LikeController::class, 'deleteLike'])->name('deleteLike');

        Route::get('/mypage/profile_change', [ProfileChangeController::class, 'profileChangeView'])->name('profileChangeView');
        Route::post('/mypage/profile_change', [ProfileChangeController::class, 'profileChange'])->name('profileChange');

        Route::prefix('payment')->name('payment.')->group(function () {
            Route::get('/create', [PaymentController::class, 'create'])->name('create');
            Route::post('/store', [PaymentController::class, 'store'])->name('store');
        });

        // Route::get('/auth/google', [GoogleLoginController::class, 'redirectToGoogle'])->name('login.google');
        // Route::get('/auth/google/callback', [GoogleLoginController::class, 'handleGoogleCallback'])->name('login.google.callback');

        // Route::get('/auth/line/redirect', [LineLoginController::class, 'redirectToLine'])->name('login.line.redirect');
        // Route::get('/auth/line/callback', [LineLoginController::class, 'handleLineCallback'])->name('login.line.callback');   

        Route::get('login/google', [GoogleLoginController::class, 'redirectToGoogle'])->name('login.google');
        Route::get('login/google/callback', [GoogleLoginController::class, 'handleGoogleCallback'])->name('login.google.callback');

        Route::get('login/line', [LineLoginController::class, 'redirectToLine'])->name('login.line');
        Route::get('login/line/callback', [LineLoginController::class, 'handleLineCallback'])->name('login.line.callback');
    }
);
