<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rezervacija extends Model
{
    use HasFactory;

    public function gost()
    {
        return $this->belongsTo(Gost::class);
    }

    
    public function sto()
    {
        return $this->belongsTo(Sto::class);
    }
}
