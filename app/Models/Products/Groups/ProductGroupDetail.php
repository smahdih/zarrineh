<?php

namespace App\Models\Products\Groups;

use App\Models\Core\Unit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductGroupDetail extends Model
{
    protected $table = 'product_group_details';

    protected $fillable = [
        'product_group_id',
        'name',
        'unit_id',
    ];

    public function productGroup() : BelongsTo
    {
        return $this->belongsTo(ProductGroup::class, 'product_group_id');
    }

    public function unit() : BelongsTo
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
}