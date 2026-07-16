<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['diagnosa_id', 'gejala_id', 'cf_user'])]
class DetailDiagnosa extends Model
{
    use HasFactory;

    /**
     * Get the parent diagnosis.
     */
    public function diagnosa(): BelongsTo
    {
        return $this->belongsTo(Diagnosa::class, 'diagnosa_id');
    }

    /**
     * Get the symptom selected by the user.
     */
    public function gejala(): BelongsTo
    {
        return $this->belongsTo(Gejala::class, 'gejala_id');
    }
}
