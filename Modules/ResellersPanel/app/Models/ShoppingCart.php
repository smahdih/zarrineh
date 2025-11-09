<?php

namespace Modules\ResellersPanel\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Modules\ResellersPanel\Models\ShopUser;
// use Modules\ResellersPanel\Database\Factories\ShoppingCartFactory;

class ShoppingCart extends Model
{
    protected $table = 'shopping_carts';
    protected $fillable = [
        'created_by',
        'customer_id',
        'serial',
        'active',
        'delivery_at',
        'store',
        'total_price',
        'total_area',
        'priority',
        'status',
        'description',
        'timeline',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(ShopUser::class, 'created_by');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(ShopCustomer::class, 'customer_id');
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('active', 1);
    }

    public function scopeUserActiveCart(Builder $query): void
    {
        $query->where('active', 1)->where('created_by', '=', Auth::id());
    }
}
