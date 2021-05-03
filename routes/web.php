<?php

Route::namespace('Aankhijhyaal\Discuss\Http\Controllers')
    ->middleware('web')
    ->group(function(){

  Route::get('/discussion','DiscussionController@index')->name('discussion');

  Route::post('/thread','ThreadController@store')->name('thread.store');

  Route::get('/thread-update/{uuid}','ThreadController@edit')->name('thread.edit');

  Route::post('/thread-update/{uuid}','ThreadController@update')->name('thread.update');

  Route::get('/thread-delete/{uuid}','ThreadController@destroy')->name('thread.destroy');

  Route::get('/thread-close/{uuid}','ThreadController@close')->name('thread.close');

  Route::get('/thread/{slug}','ThreadController@show')->name('thread.show');

  Route::post('/reply/{uuid}','ReplyController@store')->name('reply.store');



});


