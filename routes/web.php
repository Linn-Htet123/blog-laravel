<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CommentController;
use App\Models\Article;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//    Route::get('cu-posts/{article:title}',function (Article $article){
//   return $article;
//})->missing(function (Request $request){
//        return redirect()->route('page.index');
//});
//    Route::get('cu-users/{user}',function (User $user){
//     dd($user);
//})->missing(function (Request $request){
//        return redirect()->route('page.index');
//});
Route::get('/c-posts/{post}', function (Article $article) {
    return $article;
});

Route::controller(PageController::class)->name('page.')->group(function(){
    Route::get('/', 'index')->name('index');
    Route::get('article-details/{slug}', 'show')->name('show');
    Route::get('category/{slug}', 'categorized')->name('categorized');
});
Route::resource('comment',CommentController::class)->only(['store','update','destroy'])->middleware('auth');
Auth::routes();
//
Route::middleware(['auth'])->group(function(){
   Route::resource('article',ArticleController::class);
   Route::get('create/category',[CategoryController::class,'create'])->name('cc');
   Route::resource('category',CategoryController::class)->middleware('can:viewAny,'.Category::class);
   Route::get('/home', [HomeController::class, 'index'])->name('home');
   Route::get('/user-list', [HomeController::class, 'users'])->name('user.list')->can('admin-only');
});


