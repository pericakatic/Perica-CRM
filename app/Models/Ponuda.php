<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ponuda extends Model
{
    use HasFactory;

    protected $table = 'ponude';
    protected $fillable = ['deal_id', 'broj_ponude', 'ukupni_iznos', 'status'];

    public function deal(): BelongsTo
    {
        return $this->belongsTo(Deal::class, 'deal_id');
    }
}
