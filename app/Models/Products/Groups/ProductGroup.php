<?php

namespace App\Models\Products\Groups;

use App\Models\Products\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductGroup extends Model
{
    protected $table = 'product_groups';

    protected $fillable = [
        'name',
    ];

    public function details() : HasMany
    {
        return $this->hasMany(ProductGroupDetail::class, 'product_group_id');
    }

    public function products() : HasMany
    {
        return $this->hasMany(Product::class, 'product_group_id');
    }
}