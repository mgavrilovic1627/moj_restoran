<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sto extends Model
{
    use HasFactory;

    protected $fillable = [
        'naziv_stola',
        'broj_mesta',
        'za_pusace'
    ];

    public function rezervacije()
    {
        return $this->hasMany(Rezervacija::class);
    }

    public function komentari()
    {
        return $this->hasMany(Komentar::class);
    }
}
