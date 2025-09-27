<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;

class Procedure extends Model
{
    protected $table = 'procedures';

    protected $fillable = ['name', 'type'];
}
