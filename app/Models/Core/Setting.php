<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';
    protected $fillable = [
        'minimum_input',
        'minimum_output',
        'maximum_input',
        'maximum_output',
    ];
}
