<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tvrtka extends Model
{
    use HasFactory;

    protected $table = 'tvrtke';
    protected $fillable = ['naziv', 'email', 'telefon', 'adresa', 'status'];

    public function kontakti(): HasMany
    {
        return $this->hasMany(Kontakt::class, 'tvrtka_id');
    }

    public function dealovi(): HasMany
    {
        return $this->hasMany(Deal::class, 'tvrtka_id');
    }
}
