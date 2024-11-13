<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Form\FormController;

Route::get('/forms', [FormController::class, 'getForm']);

Route::prefix('formularios')->group(function () {
    Route::get('/{formId}/preenchimentos', [FormController::class, 'getFormSubmissions']);
    Route::post('/{formId}/preenchimentos', [FormController::class, 'submitData']);
});