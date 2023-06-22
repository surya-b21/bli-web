<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'sku',
        'nama',
        'harga',
        'stok',
        'unit_of_material'
    ];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
}
