<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoketAntrian extends Model
{
    use HasFactory;

    protected $table = 'loket_pelayanan';
    protected $primaryKey = 'loket_id';
    protected $fillable = ['layanan_id', 'nama_loket'];

    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'layanan_id', 'layanan_id');
    }

    public function pelayananAktif()
    {
        return $this->hasOne(PelayananAktif::class, 'loket_id', 'loket_id');
    }
}
