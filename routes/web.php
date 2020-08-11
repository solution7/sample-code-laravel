<?php

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

//Laravel and Vue Routes
if (Request::segment(1) != 'v1') {
    Route::middleware(['country_settings', 'language'])->group(function () {
        Route::get('/{vue?}', 'DefaultController@index')->where('vue', '[\/\w\.\s-]*')->name('app');
    });
}
