<?php

namespace App\Models\Products\Groups;

use App\Models\Products\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GroupDetailProduct extends Model
{
    protected $table = 'group_details_products';

    protected $fillable = ['product_group_detail_id', 'product_id', 'value'];

    public function productGroupDetail(): BelongsTo
    {
        return $this->belongsTo(
            ProductGroupDetail::class,
            'product_group_detail_id',
        );
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
