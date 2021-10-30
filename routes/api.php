<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CategoryController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



/* ======== PRODUCTS ======== */

Route::apiResource('products', ProductController::class);

/* ======== REVIEWS ======== */

Route::prefix('products')->group(function () {
    Route::apiResource('{product}/reviews', ReviewController::class);
});

/* ======== CATEGORIES ======= */
Route::prefix('categories')->group(function () {
    // get endpoint
    Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/{category}', [CategoryController::class, 'getCategory'])->name('categories.show');
    Route::get('/{category}/subcategories', [CategoryController::class, 'getSubCategories'])->name('categories.subcategories');
    Route::get('/{category}/subcategories/{subcategories}', [CategoryController::class, 'getSubCategoriesIndex'])->name('categories.sub.index');
    // post endpoint
    Route::post('/', [CategoryController::class, 'store'])->name('categories.store');
    // put/patch endpoint
    Route::put('/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::patch('/{category}', [CategoryController::class, 'update'])->name('categories.update');
    // put/patch subcategories endpoint
    Route::put('/{category}/subcategories/{subcategories}', [CategoryController::class, 'updateSubCategories'])->name('categories.sub.update');
    Route::patch('/{category}/subcategories/{subcategories}', [CategoryController::class, 'updateSubCategories'])->name('categories.sub.update');
    // delete endpoint
    Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    // delete subcategories endpoint
    Route::delete('/{category}/subcategories/{subcategories}', [CategoryController::class, 'destroySubCategories'])->name('categories.sub.destroy');
    // get products in a category endpoint
    Route::get('/{category}/products', [CategoryController::class, 'getProducts'])->name('categories.products');
});