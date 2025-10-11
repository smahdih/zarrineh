<?php

namespace Modules\ResellersPanel\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class SetShopIdInSession
{
    /**
     * Create the event listener.
     */
    public function __construct() {}

    /**
     * Handle the event.
     */
    public function handle($event): void
    {
        if (Auth::guard('shop')->check()) {
            session()->put('shop_id', $event->user->shop_id);
        }
    }
}
