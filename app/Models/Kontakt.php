<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kontakt extends Model
{
    use HasFactory;

    protected $table = 'kontakti';
    protected $fillable = ['tvrtka_id', 'ime', 'prezime', 'email', 'telefon', 'status'];

    public function tvrtka(): BelongsTo
    {
        return $this->belongsTo(Tvrtka::class, 'tvrtka_id');
    }

    public function dealovi(): HasMany
    {
        return $this->hasMany(Deal::class, 'kontakt_id');
    }
}
