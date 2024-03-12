<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\Admin\TopicController;
Route::controller(TopicController::class)->prefix('admin')->name('admin.')->middleware('auth')->group(function() {
Route::get('topic/create', 'add')->name('topic.add');
Route::post('topic/create', 'create')->name('topic.create');
Route::get('topic', 'index')->name('topic.index');
Route::get('topic/edit', 'edit')->name('topic.edit');
Route::post('topic/edit', 'update')->name('topic.update');
Route::get('topic/delete', 'delete')->name('topic.delete');
Route::post('topic', 'changeflag')->name('topic.changeflag');

});

use App\Http\Controllers\TopicController as PublicTopicController;
Route::get('/', [PublicTopicController::class, 'top'])->name('topic.top');
Route::get('topic', [PublicTopicController::class, 'index'])->name('topic.index');
Route::get('profile', [PublicTopicController::class, 'profile'])->name('topic.profile');
Route::get('registration', [PublicTopicController::class, 'registration'])->name('topic.registration');
Route::get('mail', [PublicTopicController::class, 'mail'])->name('topic.mail');
Route::post('mail', [PublicTopicController::class, 'sendmail'])->name('topic.sendmail');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


