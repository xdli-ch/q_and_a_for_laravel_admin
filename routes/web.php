<?php

use App\Admin\Controllers\Q_And_A\Q_And_AController;
use App\Admin\Controllers\Q_And_A\TongJiController;

//Route::get('q_and_a', Q_And_AController::class.'@index');
Route::resource('q_and_a', Q_And_AController::class);
Route::get('user_qa', TongJiController::class.'@index');
Route::delete('user_qa/{id}', TongJiController::class.'@destroy');