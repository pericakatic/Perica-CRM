<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Deal extends Model
{
    use HasFactory;

    protected $table = 'dealovi';
    protected $fillable = ['tvrtka_id', 'kontakt_id', 'naziv', 'vrijednost', 'status'];

    public function tvrtka(): BelongsTo
    {
        return $this->belongsTo(Tvrtka::class, 'tvrtka_id');
    }

    public function kontakt(): BelongsTo
    {
        return $this->belongsTo(Kontakt::class, 'kontakt_id');
    }

    public function ponude(): HasMany
    {
        return $this->hasMany(Ponuda::class, 'deal_id');
    }
}
