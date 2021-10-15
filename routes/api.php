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
    Route::get('/', [CategoryController::class, 'index'])->name('categories.all');
    Route::get('/{category}', [CategoryController::class, 'getCategory'])->name('categories.show');
    Route::get('/{category}/subcategories', [CategoryController::class, 'getSubCategories'])->name('categories.subcategories');
    Route::get('/{category}/subcategories/{subcategories}', [CategoryController::class, 'getSubCategoriesIndex'])->name('categories.sub.index');
});