<?php

use Illuminate\Support\Facades\Route;





Auth::routes();

	Route::get('/{user:username}', 'ProfileController@index')->name('profile');



Route::group(['middleware'=>'auth'],function(){

	Route::get('/account/edit', 'ProfileController@edit')->name('profile.edit');
	Route::put('/profile', 'ProfileController@update')->name('profile.update');

        Route::get('/', "PostsController@index")->name('home');

	    Route::resource('/post','PostsController')->except(['index']);

	    Route::post('/user/follow',"FollowsController@follow")->name('follow');
	    Route::post('/user/unfollow',"FollowsController@unfollow")->name('unfollow');

	    Route::post('/user/like',"FollowsController@like")->name('like');
	    Route::post('/user/unlike',"FollowsController@unlike")->name('unlike');


	    Route::post('/user/comment',"CommentsController@store")->name('comment');
	    Route::post('/add/comment',"CommentsController@commentIndex")->name('commentIndex');
	    Route::post('/user/comment/delete',"CommentsController@destroy")->name('delete');



});






