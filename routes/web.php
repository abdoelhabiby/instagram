<?php

use Illuminate\Support\Facades\Route;




Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

	Route::get('/{user:username}', 'ProfileController@index')->name('profile');

	Route::get('/post','PostsController@show')->name('post.show');


Route::group(['middleware'=>'auth'],function(){

	Route::get('/account/edit', 'ProfileController@edit')->name('profile.edit');
	Route::put('/profile', 'ProfileController@update')->name('profile.update');

	    Route::resource('/post','PostsController')->except(['index','index']);

	    Route::post('/user/follow',"FollowsController@follow")->name('follow');
	    Route::post('/user/unfollow',"FollowsController@unfollow")->name('unfollow');

	    Route::post('/user/like',"FollowsController@like")->name('like');
	    Route::post('/user/unlike',"FollowsController@unlike")->name('unlike');


	    Route::post('/user/comment',"CommentsController@store")->name('comment');



});