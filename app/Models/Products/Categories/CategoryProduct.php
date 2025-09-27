<?php

namespace App\Models\Products\Categories;

use App\Models\Products\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Products\Categories\ProductSubCategory;

class CategoryProduct extends Model
{
    protected $table = 'categories_products';
    public $incrementing = true;
    protected $fillable = [
        'product_id',
        'sub_category_id',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(ProductSubCategory::class, 'sub_category_id');
    }
}
