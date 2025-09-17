<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;

class RecurringHoliday extends Model
{
    protected $fillable = [
        'name',
        'rule',
        'type',
        'team_id',
        'enabled',
    ];
}
