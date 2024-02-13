<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*App\Models\User::create([
    'name' => 'Administrador',
    'email' => 'admin@gmail.com',
    'password' => bcrypt('Sergio123'),
    'role_id' => '1'
]);*/

Route::get('roles', function(){
    return \App\Models\Role::with('user')->get();
});

Route::get('/', [PagesController::class, 'home'])->name('home');


Route::get('saludos/{nombre?}', [PagesController::class, 'saludo'])->name('saludos')->where('nombre', "[A-Za-z]+");


Route::resource('mensajes', MessagesController::class);
Route::resource('usuarios', UsersController::class);

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('logout', [LoginController::class, 'logout']);


























//Route::get('mensajes', [MessagesController::class, 'index'])->name('messages.index');



//Route::get('mensajes/create', [MessagesController::class, 'create'])->name('messages.create');
//Route::post('mensajes', [MessagesController::class, 'store'])->name('messages.store');
//Route::get('mensajes/{id}', [MessagesController::class, 'show'])->name('messages.show');
//Route::get('mensajes/{id}/edit', [MessagesController::class, 'edit'])->name('messages.edit');
//Route::put('mensajes/{id}', [MessagesController::class, 'update'])->name('messages.update');
//Route::delete('mensajes/{id}', [MessagesController::class, 'destroy'])->name('messages.destroy');