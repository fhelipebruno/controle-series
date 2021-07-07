<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EpisodiosController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\seriesController;
use App\Http\Controllers\TemporadasController;

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

// Route::get('/series', [seriesController::class, 'index'])->middleware('auth');
Route::get('/series', [seriesController::class, 'index'])->name('listar_series');
Route::get('/series/criar', [seriesController::class, 'create'])->name('form_criar_serie');
Route::post('/series/criar', [seriesController::class, 'store']);
Route::post('/series/{id}/editaNome', [seriesController::class, 'editaNome']);
Route::delete('/series/remover/{id}', [seriesController::class, 'destroy']);
Route::get('/series/{id}/temporadas', [TemporadasController::class, 'index']);
Route::get('/temporadas/{temporada}/episodios', [EpisodiosController::class, 'index']);
Route::post('/temporadas/{temporada}/episodios/assistir', [EpisodiosController::class, 'assistir']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/entrar', [AuthController::class, 'index']);
Route::post('/entrar', [AuthController::class, 'entrar']);

Route::get('/registrar', [AuthController::class, 'create']);
Route::post('/registrar', [AuthController::class, 'store']);

Route::get('/sair', function () {
    \Illuminate\Support\Facades\Auth::logout();
    return redirect('/entrar');
});
