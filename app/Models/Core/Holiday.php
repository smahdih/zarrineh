<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    protected $table = 'holidays';

    protected $fillable = ['date', 'event', 'type', 'team_id', 'is_manual'];
}
