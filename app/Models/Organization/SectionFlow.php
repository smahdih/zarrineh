<?php

namespace App\Models\Organization;

use App\Models\Core\Procedure;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SectionFlow extends Pivot
{
    protected $table = 'section_flows';

    protected $fillable = [
        'section_id',
        'procedure_id',
        'level',
    ];

    public function section() : BelongsTo
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function procedure() : BelongsTo
    {
        return $this->belongsTo(Procedure::class, 'procedure_id');
    }
}