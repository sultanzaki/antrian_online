<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CounterRate extends Model
{
    use HasFactory;

    protected $table = 'counter_rate_tables';

    protected $fillable = [
        'kode',
        'mata_uang',
        'tenor_1_bulan',
        'tenor_3_bulan',
        'tenor_6_bulan',
        'tenor_12_bulan',
        'tenor_24_bulan',
    ];
}
