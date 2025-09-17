<?php

namespace App\Models\Organization;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeamUser extends Pivot
{
    protected $table = 'team_users';

    protected $fillable = [
        'team_id',
        'user_id',
        'is_manager',
    ];

    public function team() : BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}