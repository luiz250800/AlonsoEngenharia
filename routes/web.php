<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PropostaController;

Route::get('/', function (){
    return view('index.index');
});

Route::get('/login/register', [UsuarioController::class, 'create']);
Route::post('/login/register', [UsuarioController::class, 'store']);
Route::post('/login', [UsuarioController::class, 'find']);
Route::get('/logout', [UsuarioController::class, 'logout']);

Route::get('/client', [ClienteController::class, 'index']);
Route::get('/client/register', [ClienteController::class, 'create']);
Route::post('/client/register', [ClienteController::class, 'store']);
Route::get('/client/update/{cdClient}', [ClienteController::class, 'edit']);
Route::post('/client/update/{cdClient}', [ClienteController::class, 'update']);
Route::get('/client/delete/{cdClient}', [ClienteController::class, 'destroy']);

Route::get('/proposal', [PropostaController::class, 'index']);
Route::get('/proposal/register', [PropostaController::class, 'create']);
Route::post('/proposal/register', [PropostaController::class, 'store']);
Route::get('/proposal/update/{cdProposal}', [PropostaController::class, 'edit']);
Route::post('/proposal/update/{cdProposal}', [PropostaController::class, 'update']);
Route::get('/proposal/delete/{cdProposal}', [PropostaController::class, 'destroy']);
Route::post('/proposal/findProposal', [PropostaController::class, 'findProposal']);
Route::get('/proposal/updateStatus/{cdProposal}/{tpStatus}', [PropostaController::class, 'updateStatus']);
Route::get('/proposal/excelExport', [PropostaController::class, 'excelExport']);
