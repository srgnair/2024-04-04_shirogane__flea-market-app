<?php

use Illuminate\Support\Facades\Route;
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

require __DIR__ . '/auth.php';

Route::middleware('web')->group(
    function () {
        Route::get('/register', [RegisterController::class, 'registerView'])->name('registerView');
        Route::post('/register', [RegisterController::class, 'register'])->name('register');

        Route::get('/login', [LoginController::class, 'loginView'])->name('loginView');
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

        Route::get('/', [MainPageController::class, 'mainView'])->name('mainView');
        Route::get('/refine', [MainPageController::class, 'mainSearchRefineView'])->name('mainSearchRefineView');

        Route::prefix('detail/{id}')->group(function () {
            Route::get('/', [DetailPageController::class, 'detailView'])->name('detailView');
            Route::post('/shipping', [DetailPageController::class, 'updateShippingStatusCurrently'])->name('StatusCurrently');
            Route::post('/shipping_complete', [DetailPageController::class, 'updateShippingStatusComplete'])->name('StatusComplete');
        });

        Route::prefix('login')->group(
            function () {
                Route::get('/google', [GoogleLoginController::class, 'redirectToGoogle'])->name('login.google');
                Route::get('/google/callback', [GoogleLoginController::class, 'handleGoogleCallback'])->name('login.google.callback');

                Route::get('/line', [LineLoginController::class, 'redirectToLine'])->name('login.line');
                Route::get('/line/callback', [LineLoginController::class, 'handleLineCallback'])->name('login.line.callback');
            }
        );
    }
);

Route::middleware(['web', 'auth', 'verified'])->group(
    function () {
        Route::get('/admin_top', [AdminController::class, 'adminView'])->name('adminView');
        Route::get('/admin_add', [AdminController::class, 'addNewAdminView'])->name('addNewAdminView');
        Route::post('/admin_add', [AdminController::class, 'addNewAdmin'])->name('addNewAdmin');
        Route::get('/admin_item_list', [AdminController::class, 'itemListView'])->name('itemListView');
        Route::get('/admin_email', [AdminController::class, 'sendEmailView'])->name('sendEmailView');
        Route::post('/admin_email', [AdminController::class, 'sendEmail'])->name('sendEmail');
        Route::get('/admin_confirm_amount', [AdminController::class, 'confirmAmountView'])->name('confirmAmountView');

        Route::prefix('/detail/comment')->group(
            function () {
                Route::get('/{item_id}', [CommentController::class, 'commentView'])->name('commentView');
                Route::post('/submit/{item_id}', [CommentController::class, 'comment'])->name('comment');
                Route::delete('/delete/{comment_id}/{item_id}', [CommentController::class, 'commentDelete'])->name('commentDelete');
            }
        );

        Route::get('/confirm_purchase/{item_id}', [PurchaseController::class, 'confirmPurchaseView'])->name('confirmPurchaseView');
        Route::get('/payment_method/{item_id}', [PurchaseController::class, 'paymentMethodView'])->name('paymentMethodView');
        Route::post('/purchase/{item_id}', [PurchaseController::class, 'Purchase'])->name('purchase');

        Route::post('/purchase/update_payment_method/{item_id}', [PurchaseController::class, 'updatePaymentMethod'])->name('updatePaymentMethod');

        Route::get('/shipping_change/{item_id}', [ShippingChangeController::class, 'shippingChangeView'])->name('shippingChangeView');
        Route::post('/shipping_change/{item_id}', [ShippingChangeController::class, 'shippingChange'])->name('shippingChange');

        Route::get('/mypage', [MyPageController::class, 'mypageView'])->name('mypageView');
        Route::get('/mypage/purchased_item', [MyPageController::class, 'mypagePurchasedItemsView'])->name('mypagePurchasedItemsView');

        Route::get('/my_items', [MainPageController::class, 'mainMyLikeItemsView'])->name('mainMyLikeItemsView');

        Route::get('/display_item', [DisplayController::class, 'displayItemView'])->name('displayItemView');
        Route::post('/display_item', [DisplayController::class, 'displayItem'])->name('displayItem');

        Route::get('/review/{id}', [ReviewController::class, 'reviewView'])->name('reviewView');
        Route::post('/review_buyer/{id}', [ReviewController::class, 'postReviewBuyer'])->name('postReviewBuyer');
        Route::post('/review_selleryer/{id}', [ReviewController::class, 'postReviewSeller'])->name('postReviewSeller');
        Route::get('/reviews/{seller_id}', [ReviewController::class, 'showReviews'])->name('showReviews');


        Route::post('/{item_id}', [LikeController::class, 'like'])->name('like');
        Route::delete('/{item_id}', [LikeController::class, 'deleteLike'])->name('deleteLike');

        Route::get('/mypage/profile_change', [ProfileChangeController::class, 'profileChangeView'])->name('profileChangeView');
        Route::post('/mypage/profile_change', [ProfileChangeController::class, 'profileChange'])->name('profileChange');

        Route::prefix('payment')->name('payment.')->group(function () {
            Route::get('/create', [PaymentController::class, 'create'])->name('create');
            Route::post('/store', [PaymentController::class, 'store'])->name('store');
        });
    }
);
