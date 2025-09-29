<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductPicture extends Model
{
    protected $table = 'product_pictures';

    protected $fillable = ['product_id', 'path', 'avatar'];

    protected $appends = ['path_url'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function getPathUrlAttribute(): string
    {
        return private_file_url($this->path);
    }
}
