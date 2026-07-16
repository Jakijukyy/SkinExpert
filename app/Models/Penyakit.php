<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['kode', 'nama', 'deskripsi', 'penyebab', 'solusi', 'pencegahan', 'gambar'])]
class Penyakit extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Get the rules associated with this disease.
     */
    public function rules(): HasMany
    {
        return $this->hasMany(Rule::class, 'penyakit_id');
    }

    /**
     * Get the diagnoses where this disease was the highest screening prediction.
     */
    public function diagnoses(): HasMany
    {
        return $this->hasMany(Diagnosa::class, 'penyakit_tertinggi_id');
    }
}
