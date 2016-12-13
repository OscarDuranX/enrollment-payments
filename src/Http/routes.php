<?php

Route::group(['middleware' => 'auth'], function () {
    Route::Resoruce('studis', 'StudisController');
});