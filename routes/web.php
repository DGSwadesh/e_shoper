<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ManufactureController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SliderController;

// frontend-------------------------
Route::get('/', [HomeController::class,'index']);

// backend-------------------------
Route::get('/admin', [AdminController::class,'index']);
Route::get('/dashboard', [SuperAdminController::class,'index']);
Route::get('/admin-dashboard', [AdminController::class,'dashboard']);
Route::get('/logout', [SuperAdminController::class,'logout']);

//category---------------------------
Route::get('/addCategory', [CategoryController::class,'addCategory']);
Route::get('/allCategory', [CategoryController::class,'allCategory']);
Route::post('/saveCategory', [CategoryController::class,'saveCategory']);
Route::get('/active_unactive_category/{category_id}/{category_status}', [CategoryController::class,'active_unactive_category']);
Route::get('/edit_category/{category_id}', [CategoryController::class,'edit_category']);
Route::post('/update_category/{category_id}', [CategoryController::class,'update_category']);
Route::get('/delete_category/{category_id}', [CategoryController::class,'delete_category']);

//manufacture---------------------------
Route::get('/addManufacture', [ManufactureController::class,'addManufacture']);
Route::get('/allManufacture', [ManufactureController::class,'allManufacture']);
Route::post('/saveManufacture', [ManufactureController::class,'saveManufacture']);
Route::get('/active_unactive_manufacture/{manaufacture_id}/{manaufacture_status}', [ManufactureController::class,'active_unactive_manufacture']);
Route::get('/edit_manufacture/{manufacture_id}', [ManufactureController::class,'edit_manufacture']);
Route::post('/update_manufacture/{manufacture_id}', [ManufactureController::class,'update_manufacture']);
Route::get('/delete_manufacture/{manufacture_id}', [ManufactureController::class,'delete_manufacture']);

//product--Product--ProductController-----------------------
Route::get('/addProduct', [ProductController::class,'addProduct']);
Route::get('/allProduct', [ProductController::class,'allProduct']);
Route::post('/saveProduct', [ProductController::class,'saveProduct']);
Route::get('/active_unactive_product/{product_id}/{product_status}', [ProductController::class,'active_unactive_product']);
Route::get('/edit_product/{product_id}', [ProductController::class,'edit_product']);
Route::post('/update_product/{manufacture_id}', [ProductController::class,'update_product']);
Route::get('/delete_product/{product_id}', [ProductController::class,'delete_product']);

//slider--Slider--SliderController-----------------------
Route::get('/addSlider', [SliderController::class,'addSlider']);
Route::get('/allSlider', [SliderController::class,'allSlider']);
Route::post('/saveSlider', [SliderController::class,'saveSlider']);
Route::get('/active_unactive_slider/{slider_id}/{slider_status}', [SliderController::class,'active_unactive_slider']);
Route::get('/delete_slider/{slider_id}', [SliderController::class,'delete_slider']);

