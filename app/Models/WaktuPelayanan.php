<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaktuPelayanan extends Model
{
    use HasFactory;

    protected $table = 'waktu_pelayanan_tables';

    protected $primaryKey = 'waktu_pelayanan_id';

    protected $fillable = [
        'layanan_id',
        'loket_id',
        'nomor_antrian_id',
        'waktu_mulai_tunggu',
        'waktu_selesai_tunggu',
        'total_waktu_tunggu',
        'waktu_mulai_pelayanan',
        'waktu_selesai_pelayanan',
        'total_waktu_pelayanan',
    ];

    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'layanan_id', 'layanan_id');
    }

    public function loket()
    {
        return $this->belongsTo(LoketAntrian::class, 'loket_id', 'loket_id');
    }

    public function nomorAntrian()
    {
        return $this->belongsTo(NomorAntrian::class, 'nomor_antrian_id', 'nomor_antrian_id');
    }
}
