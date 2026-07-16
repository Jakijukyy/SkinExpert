<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['user_id', 'tanggal', 'penyakit_tertinggi_id', 'cf_tertinggi', 'hasil_json'])]
class Diagnosa extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'tanggal'    => 'datetime',
            'hasil_json' => 'array',
        ];
    }

    /**
     * Get the user who performed this diagnosis.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the highest-ranked disease of this diagnosis.
     */
    public function penyakit(): BelongsTo
    {
        return $this->belongsTo(Penyakit::class, 'penyakit_tertinggi_id');
    }

    /**
     * Get the symptom details of this diagnosis.
     */
    public function details(): HasMany
    {
        return $this->hasMany(DetailDiagnosa::class, 'diagnosa_id');
    }
}
