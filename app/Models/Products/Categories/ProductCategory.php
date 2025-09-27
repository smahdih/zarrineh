<?php

namespace App\Models\Products\Categories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductCategory extends Model
{
    protected $table = 'product_categories';

    protected $fillable = [
        'name',
    ];

    public function subCategories() : HasMany
    {
        return $this->hasMany(ProductSubCategory::class, 'category_id');
    }
}
