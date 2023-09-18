<?php

use Illuminate\Support\Facades\Route;
use App\Models\Field;
use App\Http\Controllers\FieldController;

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

Route::get('/', function () {
	$fields = Field::all();
    return view('form', compact('fields'));
});

Route::get('/form', [FieldController::class, 'index'])->name('field.index');
Route::post('/form', [FieldController::class, 'store'])->name('field.store');
Route::delete('/form/{field}', [FieldController::class, 'destroy'])->name('field.destroy');

