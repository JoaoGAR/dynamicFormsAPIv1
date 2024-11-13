<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Form\FormController;

Route::get('/forms', [FormController::class, 'getForm']);

Route::prefix('formularios')->group(function () {
    Route::post('/{formId}/preenchimentos', [FormController::class, 'submitData']);
});