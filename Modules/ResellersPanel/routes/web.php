<?php

use Illuminate\Support\Facades\Route;
use Modules\ResellersPanel\Http\Controllers\ResellersPanelController;

Route::middleware(['auth', 'verified'])->prefix('resell')->group(function () {
    Route::resource('resellerspanels', ResellersPanelController::class)->names('resellerspanel');
});
