<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = [
        'sort',
        'item_id',
        'qty',
        'harga_setelah_pajak',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
