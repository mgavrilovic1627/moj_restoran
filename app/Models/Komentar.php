<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    use HasFactory;

    protected $fillable = [
        'sadrzaj',
        'user_id',
        'sto_id',
        'ocena'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sto()
    {
        return $this->belongsTo(Sto::class);
    }
}
