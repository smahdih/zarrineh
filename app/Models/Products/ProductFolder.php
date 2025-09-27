<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductFolder extends Model
{
    protected $table = 'product_folders';

    protected $fillable = [
        'serial',
        'avatar',
    ];

    public function products() : HasMany
    {
        return $this->hasMany(Product::class, 'folder_id');
    }
}
