<?php

namespace App\Models\Organization;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    protected $table = 'departments';

    protected $fillable = [
        'name',
        'slug',
    ];

    public function sections(): HasMany
    {
        return $this->hasMany(Section::class, 'department_id');
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'department_id');
    }
}