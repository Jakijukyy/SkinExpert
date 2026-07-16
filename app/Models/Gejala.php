<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['kode', 'nama'])]
class Gejala extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Get the rules associated with this symptom.
     */
    public function rules(): HasMany
    {
        return $this->hasMany(Rule::class, 'gejala_id');
    }

    /**
     * Get the details of diagnoses checking this symptom.
     */
    public function details(): HasMany
    {
        return $this->hasMany(DetailDiagnosa::class, 'gejala_id');
    }
}
