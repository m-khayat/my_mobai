<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SlidersController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MobileController;
use App\Http\Controllers\CommentMobileController;
use App\Http\Controllers\MobileViewController;
use App\Http\Controllers\CartController;





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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// UsersController.Api

        Route::post("register", [UserController::class, "register"]);
        Route::post("login", [UserController::class, "login"]);

        Route::group(["middleware"=> ["auth:api"]],function(){

        Route::get("profile", [UserController::class, "profile"]);
        Route::post("logout", [UserController::class, "logout"]);

});
// SlidersController.Api

        Route::group(["middleware"=> ["auth:api"]],function(){

                Route::post("create_slider", [SlidersController::class, "store"]);
                //this id for the slider
                Route::post("update_slider/{id}", [SlidersController::class, "update"]);
                Route::delete("delete_slider/{id}", [SlidersController::class, "destroy"]);
        
            });
        Route::get("list_sliders", [SlidersController::class, "index"]);
        Route::get("single_slider/{id}", [SlidersController::class, "show"]);


// CategoriesController.Api

        Route::group(["middleware"=> ["auth:api"]],function(){

                Route::post("create_category", [CategoriesController::class, "store"]);
                //this id for the category
                Route::post("update_category/{id}", [CategoriesController::class, "update"]);
                Route::delete("delete_category/{id}", [CategoriesController::class, "destroy"]);
        
            });
        Route::get("list_categories", [CategoriesController::class, "index"]);
        //this id for the category
        Route::get("single_category/{id}", [CategoriesController::class, "show"]);


// FavoriteController.Api
                                                //this id for the mobile
        Route::middleware('auth:api')->post("store_favorite_mobiles/{id}", [FavoriteController::class, "store"]);
        Route::middleware('auth:api')->get("list_favorite_mobiles", [FavoriteController::class, "index"]);


// MobileController.Api

        Route::group(["middleware"=> ["auth:api"]],function(){

                Route::post("create_mobile", [MobileController::class, "store"]);
                        //this id for the mobile
                Route::post("update_mobile/{id}", [MobileController::class, "update"]);
                Route::delete("delete_mobile/{id}", [MobileController::class, "destroy"]);
        
            });
        Route::get("list_mobiles", [MobileController::class, "index"]);
                //this id for the mobile
        Route::get("single_mobile/{id}", [MobileController::class, "show"]);
        Route::get("search_mobiles", [MobileController::class, "MobileSearch"]);


 // CommentMobileController.Api

        Route::group(["middleware"=> ["auth:api"]],function(){

            Route::post("create_mobile_comment", [CommentMobileController::class, "store"]);
                        //this id for the comment
            Route::post("update_mobile_comment/{id}", [CommentMobileController::class, "update"]);
            Route::delete("delete_mobile_comment/{id}", [CommentMobileController::class, "destroy"]);

    });
                //this id for the mobile
         Route::get("list_mobile_comments/{id}", [CommentMobileController::class, "index"]);

// MobileViewController.Api
                                    //this id for the mobile
        Route::middleware('auth:api')->post("mobile_views/{id}", [MobileViewController::class, "index"]);


// CartController.Api
                                    //this id for the mobile
        Route::middleware('auth:api')->post("add_to_cart/{id}", [CartController::class, "store"]);
        Route::middleware('auth:api')->get("cart_contents", [CartController::class, "index"]);
                                    //this id for the mobile
        Route::middleware('auth:api')->delete("delete_mobile_from_cart/{id}", [CartController::class, "destroy"]);
        Route::middleware('auth:api')->get("cart_totla", [CartController::class, "getTotalMobilePrice"]);


