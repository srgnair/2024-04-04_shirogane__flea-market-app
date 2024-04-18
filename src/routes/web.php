<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;

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

        Route::get('/register', [TestController::class, 'registerView'])->name('registerView');
        Route::post('/register', [TestController::class, 'register'])->name('register');

        Route::get('/login', [TestController::class, 'loginView'])->name('loginView');
        Route::post('/logout', [TestController::class, 'logout'])->name('logout');

        Route::get('/detail/comment/{item_id}', [TestController::class, 'commentView'])->name('commentView');

        // Route::post('/detail/comment/{item_id}', [TestController::class, 'commentView'])->name('commentView');

        Route::post('/detail/comment/submit/{item_id}', [TestController::class, 'comment'])->name('comment');

        // Route::delete('/detail/comment/delete/{comment_id}', [TestController::class, 'commentDelete'])->name('commentDelete');

        Route::delete('/detail/comment/delete/{comment_id}/{item_id}', [TestController::class, 'commentDelete'])->name('commentDelete');

        Route::get('/confirm_purchase/{item_id}', [TestController::class, 'confirmPurchaseView'])->name('confirmPurchaseView');

        Route::get('/mypage', [TestController::class, 'mypageView'])->name('mypageView');
        Route::get('/mypage/purchased_item', [TestController::class, 'mypagePurchasedItemsView'])->name('mypagePurchasedItemsView');

        Route::get('/', [TestController::class, 'mainView'])->name('mainView');

        Route::get('/my_items', [TestController::class, 'mainMyDisplayItemsView'])->name('mainMyDisplayItemsView');

        Route::get('/display_item', [TestController::class, 'displayItemView'])->name('displayItemView');
        Route::post('/display_item', [TestController::class, 'displayItem'])->name('displayItem');

        Route::get('/detail/{id}', [TestController::class, 'detailView'])->name('detailView');

        Route::post('/{item_id}', [TestController::class, 'like'])->name('like');
        Route::delete('/{item_id}', [TestController::class, 'deleteLike'])->name('deleteLike');

        Route::get('/mypage/profile_change', [TestController::class, 'profileChangeView'])->name('profileChangeView');
    }
);
