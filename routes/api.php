<?php

use App\Http\Controllers\Api\admin\tickets\TicketAdminController;
use App\Http\Controllers\Api\CategoryCourseController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\LecturerController;
use App\Http\Controllers\Api\user\UserController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\LoginRegisterController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\SendMenuController;
use App\Http\Controllers\SessionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*Route::group(['middleware' => 'auth:sanctum'], function () {
//    return $request->user();

});*/


Route::post('/order/save', [OrderController::class, 'saveOrder'])->middleware('auth:sanctum');
Route::get('/order/show', [OrderController::class, 'orderShow'])->middleware('auth:sanctum');

Route::post('/menu', [CategoryCourseController::class, 'store']);


Route::post('/user/loginRegister', [LoginRegisterController::class, 'loginRegister'])->name('loginRegister');
Route::post('/user/VerificationCode', [LoginRegisterController::class, 'SaveVerificationCode'])->name('user.login');
Route::post('/logout/{id}', [LoginRegisterController::class, 'logoutUser'])->name('logout');


Route::get('/categorycourse/index', [CategoryCourseController::class, 'index']);
Route::post('/categorycourse', [CategoryCourseController::class, 'store']);
Route::get('categorycourse/{id}', [CategoryCourseController::class, 'show']);
Route::post('categorycourse/update/{id}', [CategoryCourseController::class, 'update']);
Route::delete('categorycourse/destroy/{id}', [CategoryCourseController::class, 'destroy']);


Route::post('/lecturer/store', [LecturerController::class, 'store']);
Route::get('lecturer/{id}', [LecturerController::class, 'show']);
Route::post('lecturer/update/{id}', [LecturerController::class, 'update']);
Route::delete('lecturer/delete/{id}', [LecturerController::class, 'destroy']);

Route::get('/Course/index', [CourseController::class, 'index']);
Route::post('/Course/store', [CourseController::class, 'store']);
Route::get('Course/{id}', [CourseController::class, 'show']);
Route::post('Course/update/{id}', [CourseController::class, 'update']);
Route::delete('Course/delete/{id}', [CourseController::class, 'destroy']);

Route::post('/Course/Favorite', [FavoriteController::class, 'addFavoriteCourse'])->middleware('auth:sanctum');
Route::get('/Course/Favorite/index', [FavoriteController::class, 'showFavoriteCourse'])->middleware('auth:sanctum');;




Route::get('/Part/index', [PartController::class, 'index']);
Route::post('/Part/store', [PartController::class, 'store']);
Route::get('Part/{id}', [PartController::class, 'show']);
Route::post('Part/update/{id}', [PartController::class, 'update']);
Route::delete('Part/delete/{id}', [PartController::class, 'destroy']);

Route::get('/session/index', [SessionController::class, 'index']);
Route::post('/session/store', [SessionController::class, 'store']);
Route::get('session/{id}', [SessionController::class, 'show']);
Route::post('session/update/{id}', [SessionController::class, 'update']);
Route::delete('session/delete/{id}', [SessionController::class, 'destroy']);


Route::get('users', [UserController::class, 'index']);
Route::post('users/store', [UserController::class, 'store']);
Route::get('users/{user}', [UserController::class, 'show']);
Route::put('users/{user}', [UserController::class, 'update']);
Route::delete('users/{user}', [UserController::class, 'destroy']);


//    Route::get('/discount/create', [DiscountController::class, 'discountCreate'])->name('admin.market.discount.copan.create');
//    Route::get('/common-discount', [DiscountController::class, 'commonDiscount'])->name('admin.market.discount.commonDiscount');
//    Route::get('/common-discount/create', [DiscountController::class, 'commonDiscountCreate'])->name('admin.market.discount.commonDiscount.create');
//    Route::get('/amazing-sale', [DiscountController::class, 'amazingSale'])->name('admin.market.discount.amazingSale');
//    Route::get('/amazing-sale/create', [DiscountController::class, 'amazingSaleCreate'])->name('admin.market.discount.amazingSale.create');


Route::post('/Banner/create', [BannerController::class, 'store'])->name('Banner.create');
Route::post('/Banner/update/{id}', [BannerController::class, 'update'])->name('Banner.update');
Route::get('/Banner/show', [BannerController::class, 'show'])->name('Banner.show');

Route::get('article/index', [ArticleController::class, 'index']);
Route::post('/article/create', [ArticleController::class, 'store'])->name('article.create');
Route::post('/article/update/{id}', [ArticleController::class, 'update'])->name('article.update');


//admin
Route::prefix('admin')->group(function(){
    Route::get('/', [TicketAdminController::class, 'index'])->name('admin.ticket.admin.index');
    Route::get('/set/{admin}', [TicketAdminController::class, 'set'])->name('admin.ticket.admin.set');
});

/////site_menu
Route::get('/CategoryCourse/Menu', [SendMenuController::class, 'CategoryCourseMenu']);
Route::get('course/sale', [CourseController::class, 'sale']);
Route::get('course/free', [CourseController::class, 'free']);
Route::get('/lecturer/index', [LecturerController::class, 'index']);
//مقالات پربازدید
Route::get('/article/show/{article}', [ArticleController::class, 'show'])->name('article.show')->middleware('VisitSiteMiddleware');


//مثالات جدید

Route::get('article/new', [ArticleController::class, 'newArticle']);

//lecture
Route::get('article/index', [ArticleController::class, 'index']);


