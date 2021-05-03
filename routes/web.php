<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LobbyController;
use App\Http\Controllers\EditController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\PlayGameController;

Route::get('/', [LoginController::class,'index']);
Route::post('/login', [LoginController::class,'login']);
Route::get('/lobby/{name}', [LobbyController::class, 'index'])->name('lobby.home');

Route::get('/admin/AccountManagement', [LobbyController::class, 'AdminAccountManagement'])->name('admin.AccountManagement');
Route::get('/admin/AccountManagement/{user_id}', [LobbyController::class, 'AdminDeleteAccount'])->name('admin.DeleteAccount');

Route::get('/admin/getAllUserData', [LobbyController::class, 'show'])->name('admin.getAllUserData');
Route::post('/admin/getAllUserData', [LobbyController::class, 'getAllUserData'])->name('admin.postAllUserData');


Route::get('/admin/gameControl', [GameController::class, 'index'])->name('admin.gameControl');

Route::get('/admin/gameAdd', [GameController::class, 'addIndex'])->name('admin.gameAdd');
Route::post('/admin/gameAdd', [GameController::class, 'addInsert']);

Route::get('/admin/editStatus/{game_id}', [GameController::class, 'editSingleStatus'])->name('editSingleStatus');
Route::post('/admin/editStatus', [GameController::class, 'updateStatus']);

Route::get('/admin/close/{game_id}', [GameController::class, 'closeIndex'])->name('close');
Route::post('/admin/close', [GameController::class, 'closeResult']);

Route::get('/admin/cancel/{game_id}', [GameController::class, 'cancelIndex'])->name('cancel');
Route::post('/admin/cancel', [GameController::class, 'updateStatus']);

Route::get('/admin/orders/{game_id}', [GameController::class, 'ordersIndex'])->name('orders');

Route::get('/user/game/{game_type}', [PlayGameController::class, 'gameIndex'])->name('game');
Route::post('/user/game/TWBG', [PlayGameController::class, 'playBingo']);
Route::post('/user/game/TWPL', [PlayGameController::class, 'playPL']);

Route::get('/edit', [EditController::class, 'index'])->name('edit');
Route::post('/edit', [EditController::class, 'edit']);

Route::get('/account', [AccountController::class, 'index'])->name('account.get');
Route::post('/account', [AccountController::class, 'gold'])->name('account.post');

Route::get('/logout', [LoginController::class,'logout'])->name('logout.get');
