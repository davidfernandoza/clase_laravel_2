<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::group(['prefix' => 'Users', 'controller' => UserController::class], function () {
	Route::get('/GetAllUsers', 'getAllUsers'); //GET -> traer data
	Route::get('/GetAnUser/{user}', 'getAnUser'); //GET -> traer data
	Route::post('/CreateUser', 'createUser'); //POST -> crea data
	Route::put('/UpdateUser/{user}', 'updateUser'); //PUT -> edita data
	Route::delete('/DeleteUser/{user}', 'deleteUser'); //DELETE -> elimina data
});
