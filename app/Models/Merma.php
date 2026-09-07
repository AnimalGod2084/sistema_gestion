<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merma extends Model
{
    use HasFactory;

    protected $fillable = [
        'producto_id',
        'user_id',
        'fecha',
        'cantidad',
        'motivo',
    ];

    protected $casts = [
        'fecha' => 'date',
        'cantidad' => 'decimal:2',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
