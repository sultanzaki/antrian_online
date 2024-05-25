<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;

    protected $table = 'layanan';
    protected $primaryKey = 'layanan_id';
    protected $fillable = ['nama_layanan'];

    public function nomorAntrian()
    {
        return $this->hasMany(NomorAntrian::class, 'layanan_id', 'layanan_id');
    }

    public function loketPelayanan()
    {
        return $this->hasMany(LoketPelayanan::class, 'layanan_id', 'layanan_id');
    }
}
