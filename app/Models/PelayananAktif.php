<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelayananAktif extends Model
{
    use HasFactory;

    protected $table = 'pelayanan_aktif';
    protected $primaryKey = 'pelayanan_aktif_id';
    protected $fillable = ['loket_id', 'nomor_antrian_id'];

    public function loketPelayanan()
    {
        return $this->belongsTo(LoketPelayanan::class, 'loket_id', 'loket_id');
    }

    public function nomorAntrian()
    {
        return $this->belongsTo(NomorAntrian::class, 'nomor_antrian_id', 'nomor_antrian_id');
    }
}
