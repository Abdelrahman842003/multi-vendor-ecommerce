<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\StoreController;
use Illuminate\Support\Facades\Route;

Route::
middleware('auth')->prefix('dashboard')->group(function () {


    Route::get('/dashboardAdmin', function () {
        return view('dashboard.dashboard');
    });

    // start store routes

    // trash
    Route::get('store/trash', [StoreController::class, 'trash'])->name('dashboard.store.trash');
    Route::put('store/{store}/restore', [StoreController::class, 'restore'])->name('dashboard.store.restore');
    Route::delete('store/{store}/forceDelete', [
        StoreController::class,
        'forceDelete'])->name('dashboard.store.forceDelete');


    Route::resource('store', StoreController::class)->names('dashboard.store');
    // end store routes


    // start category routes

    // trash
    Route::get('category/trash', [CategoryController::class, 'trash'])->name('dashboard.category.trash');
    Route::put('category/{category}/restore', [
        CategoryController::class,
        'restore'])->name('dashboard.category.restore');
    Route::delete('category/{category}/forceDelete', [
        CategoryController::class,
        'forceDelete'])->name('dashboard.category.forceDelete');


    Route::resource('category', CategoryController::class)->names('dashboard.category');


    Route::get('product/trash', [
        ProductController::class,
        'trash'])->name('dashboard.product.trash');

    Route::put('product/{product}/trash', [
        ProductController::class,
        'restore'])->name('dashboard.product.restore');

    Route::delete('product/{product}/forceDelete', [
        ProductController::class,
        'forceDelete'])->name('dashboard.product.forceDelete');
    // end category routes


    // start product routes
    Route::resource('product', ProductController::class)->names('dashboard.product');
    // end product routes


    // start user routes

    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');


    // end user routes


});
