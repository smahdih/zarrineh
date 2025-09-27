<?php

use Illuminate\Support\Facades\Route;
use Modules\ResellersPanel\Http\Controllers\ResellersPanelController;

Route::middleware(['auth:sanctum'])
    ->prefix('v1')
    ->group(function () {
        Route::apiResource(
            'resellerspanels',
            ResellersPanelController::class,
        )->names('resellerspanel');
    });
