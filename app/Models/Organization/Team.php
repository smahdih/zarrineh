<?php

namespace App\Models\Organization;

use App\Models\Organization\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Team extends Model
{
        protected $table = 'teams';

    protected $fillable = [
        'name',
        'department_id',
        'section_id',
    ];

    public function department() : BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function section() : BelongsTo
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function users() : HasMany
    {
        return $this->hasMany(TeamUser::class, 'team_id');
    }

    public function managers() : HasMany
    {
        return $this->hasMany(TeamUser::class, 'team_id')->where('is_manager', true);
    }
}
