<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'units';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'symbol_en',
        'symbol_fa',
    ];
}
