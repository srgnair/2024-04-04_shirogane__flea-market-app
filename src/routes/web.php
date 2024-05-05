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

        Route::get('/', [MainPageController::class, 'mainView'])->name('mainView');

        Route::get('/detail/{id}', [DetailPageController::class, 'detailView'])->name('detailView');

        // 以下要認証

        Route::get('/detail/comment/{item_id}', [CommentController::class, 'commentView'])->name('commentView');
        Route::post('/detail/comment/submit/{item_id}', [CommentController::class, 'comment'])->name('comment');
        Route::delete('/detail/comment/delete/{comment_id}/{item_id}', [CommentController::class, 'commentDelete'])->name('commentDelete');

        Route::get('/confirm_purchase/{item_id}', [PurchaseController::class, 'confirmPurchaseView'])->name('confirmPurchaseView');
        Route::post('/purchase/{item_id}', [PurchaseController::class, 'Purchase'])->name('purchase');

        Route::get('/shipping_change/{item_id}', [TestController::class, 'shippingChangeView'])->name('shippingChangeView');
        Route::post('/shipping_change/{item_id}', [TestController::class, 'shippingChange'])->name('shippingChange');

        Route::get('/mypage', [MyPageController::class, 'mypageView'])->name('mypageView');
        Route::get('/mypage/purchased_item', [MyPageController::class, 'mypagePurchasedItemsView'])->name('mypagePurchasedItemsView');

        Route::get('/my_items', [MainPageController::class, 'mainMyDisplayItemsView'])->name('mainMyDisplayItemsView');

        Route::get('/display_item', [DisplayController::class, 'displayItemView'])->name('displayItemView');
        Route::post('/display_item', [DisplayController::class, 'displayItem'])->name('displayItem');

        Route::post('/{item_id}', [LikeController::class, 'like'])->name('like');
        Route::delete('/{item_id}', [LikeController::class, 'deleteLike'])->name('deleteLike');

        Route::get('/mypage/profile_change', [ProfileChangeController::class, 'profileChangeView'])->name('profileChangeView');
        Route::post('/mypage/profile_change', [ProfileChangeController::class, 'profileChange'])->name('profileChange');

        Route::prefix('payment')->name('payment.')->group(function () {
            Route::get('/create', [PaymentController::class, 'create'])->name('create');
            Route::post('/store', [PaymentController::class, 'store'])->name('store');
        });

        Route::get('/admin_top', [TestController::class, 'adminView'])->name('adminView');
        Route::get('/admin_add', [TestController::class, 'addNewAdminView'])->name('addNewAdminView');
        Route::post('/admin_add', [TestController::class, 'addNewAdmin'])->name('addNewAdmin');
        Route::get('/admin_item_list', [TestController::class, 'itemListView'])->name('itemListView');
        Route::get('/admin_email', [TestController::class, 'sendEmailView'])->name('sendEmailView');
    }
);
