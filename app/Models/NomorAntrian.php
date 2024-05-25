<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NomorAntrian extends Model
{
    use HasFactory;

    protected $table = 'nomor_antrian';
    protected $primaryKey = 'nomor_antrian_id';
    protected $fillable = ['layanan_id', 'nomor_antrian', 'status'];

    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'layanan_id', 'layanan_id');
    }

    public function loketPelayanan()
    {
        return $this->hasOne(LoketPelayanan::class, 'loket_id', 'loket_id');
    }

    public function pelayananAktif()
    {
        return $this->hasOne(PelayananAktif::class, 'nomor_antrian_id', 'nomor_antrian_id');
    }
}
