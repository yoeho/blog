<?php

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



Auth::routes();

Route::get('/home', 'BlogPostController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {

});
Route:: resource('blog-posts', 'BlogPostController');
Route:: resource('comments', 'CommentController')->only('store');
Route::resource('subscribers','SubscriberController')->only('store');
Route::get('/sendbasicemail','MailController@basic_email');
Route::get('/sendhtmlemail','MailController@html_email');
Route::get('confirmation', "SubscriberController@confirmation");
Route::post('confirmation','SubscriberController@mail_confirmation')->name('mails.confirmation-form');
Route::get('authors','AuthorController@viewAll')->name('authors');
Route::get('authors/delete/{id}', 'AuthorController@delete')->name('author-delete');
