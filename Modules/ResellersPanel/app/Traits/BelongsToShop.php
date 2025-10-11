<?php

namespace Modules\ResellersPanel\Traits;

use Modules\ResellersPanel\Models\Shop;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\ResellersPanel\Models\Scopes\TenantScope;

trait BelongsToShop
{
    protected static function bootBelongsToShop(): void
    {
        static::addGlobalScope(new TenantScope());

        static::creating(function ($model) {
            if (session->has('shop_id')) {
                $model->shop_id = session()->get('shop_id');
            }
        });
    }

    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class, 'shop_id');
    }
}