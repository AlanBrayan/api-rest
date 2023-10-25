<?php

use App\Http\Controllers\EmpleadoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::get('/empleados/{id}', [EmpleadoController::class, 'byEmpleado']);
Route::post('/empleados/{id}', [EmpleadoController::class, 'byEmpleado'])->middleware('api_key');


Route::middleware(['api_key'])->group(function () {
    // Ruta para crear un empleado (requiere autenticación)
    Route::post('/empleados', [EmpleadoController::class, 'store']);

    // Ruta para actualizar un empleado por ID (requiere autenticación)
    Route::put('/empleados/{id}', [EmpleadoController::class, 'update']);

    // Ruta para eliminar un empleado por ID (requiere autenticación)
    Route::delete('/empleados/{id}', [EmpleadoController::class, 'destroy']);
});


// Ruta para obtener todos los empleados


Route::get('/empleados/all', [EmpleadoController::class, 'byAll'])->middleware('api_key');
