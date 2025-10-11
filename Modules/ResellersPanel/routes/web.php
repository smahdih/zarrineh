<?php

use Illuminate\Support\Facades\Route;
use Modules\ResellersPanel\Http\Controllers\ResellersPanelController;

Route::middleware(['auth:shop', 'verified'])
    ->prefix('resell')
    ->group(function () {
        Route::view('/', 'resellerspanel::index')->name('resell.product.index');
    });
