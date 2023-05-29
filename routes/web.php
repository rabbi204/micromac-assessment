<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ModelMenuController;
use Illuminate\Support\Facades\Route;


//for home page
Route::get('/',[BrandController::class, 'index'])->name('brand.index');

Route::prefix('/brand')->group(function () {
    Route::get('/index',[BrandController::class, 'index'])->name('brand.index');
    Route::post('/add',[BrandController::class, 'addBrand'])->name('brand.add');
    Route::get('/edit/{id}',[BrandController::class, 'editBrand'])->name('brand.edit');
    Route::post('/update/{id}',[BrandController::class, 'updateBrand'])->name('brand.update');
    Route::get('/delete/{id}',[BrandController::class, 'deleteBrand'])->name('brand.delete');
});

Route::prefix('/model')->group(function () {
    Route::get('/index',[ModelMenuController::class, 'index'])->name('model.index');
    Route::post('/add',[ModelMenuController::class, 'addModel'])->name('model.add');
    Route::get('/edit/{id}',[ModelMenuController::class, 'editModel'])->name('model.edit');
    Route::post('/update/{id}',[ModelMenuController::class, 'updateModel'])->name('model.update');
    Route::get('/delete/{id}',[ModelMenuController::class, 'deleteModel'])->name('model.delete');
});

Route::prefix('/item')->group(function () {
    Route::get('/index',[ItemController::class, 'index'])->name('item.index');
    Route::post('/add',[ItemController::class, 'addItem'])->name('item.add');
    Route::get('/model/{id}',[ItemController::class, 'getModel']);
    Route::get('/edit/{id}',[ItemController::class, 'editItem'])->name('item.edit');
    Route::post('/update/{id}',[ItemController::class, 'updateItem'])->name('item.update');
    Route::get('/delete/{id}',[ItemController::class, 'deleteItem'])->name('item.delete');
});