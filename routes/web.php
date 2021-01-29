<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return redirect()->route('apps');
});

// All users
Route::get('apps', [App\Http\Controllers\AppsController::class, 'showApps'])->name('apps');
Route::get('apps/{app}', [App\Http\Controllers\AppsController::class, 'showAppDetails'])->where('app', '[0-9]+')->name('details');
Route::get('apps/{category}', [App\Http\Controllers\AppsController::class, 'showCategoryApps'])->name('category');

// Developers only
Route::prefix('me/apps')->group(function () {
    Route::get('create', [App\Http\Controllers\DeveloperAppsController::class, 'create'])->middleware('developer')->name('dev.create');
    Route::post('/', [App\Http\Controllers\DeveloperAppsController::class, 'post'])->middleware('developer')->name('dev.post');
    Route::get('{app}/edit', [App\Http\Controllers\DeveloperAppsController::class, 'edit'])->middleware('developer')->name('dev.edit');
    Route::put('{app}', [App\Http\Controllers\DeveloperAppsController::class, 'update'])->middleware('developer')->name('dev.update');
    Route::delete('{app}', [App\Http\Controllers\DeveloperAppsController::class, 'delete'])->middleware('developer')->name('dev.delete');

});

// Authenticated users
Route::get('me/apps', [App\Http\Controllers\AuthAppsController::class, 'showAuthApps'])->middleware('auth')->name('auth.apps');
//Route::get('me/apps/{category}', [App\Http\Controllers\AuthAppsController::class, 'showAuthCategoryApps'])->middleware('auth')->name('auth.category');

// Clients only
Route::prefix('me/wishlist')->group(function () {
    Route::get('/', [App\Http\Controllers\ClientAppsController::class, 'showWishlist'])->middleware('client')->name('client.wishlist');
});
Route::post('api/buy', [App\Http\Controllers\ClientAppsController::class, 'buyAppsOrAddToWishlist'])->middleware('client')->name('client.buy');
Route::delete('api/buy', [App\Http\Controllers\ClientAppsController::class, 'deleteApp'])->middleware('client')->name('client.delete');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
