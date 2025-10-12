<?php

namespace Modules\ResellersPanel\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\ResellersPanel\Database\Factories\ShopOrderFactory;

class ShopOrder extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): ShopOrderFactory
    // {
    //     // return ShopOrderFactory::new();
    // }
}
