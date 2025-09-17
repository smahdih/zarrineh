<?php

namespace App\Models\Organization;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Section extends Model
{
    protected $table = 'sections';

    protected $fillable = [
        'department_id',
        'name',
        'slug',
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function sectionFlows(): HasMany
    {
        return $this->hasMany(SectionFlow::class, 'section_id');
    }
}
