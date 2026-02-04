<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisSampah extends Model
{
    protected $table = 'jenis_sampah';
    protected $primaryKey = 'id_jenis';
    public $timestamps = false;

    protected $fillable = [
        'nama_jenis',
        'poin_per_kg',
        'co2_per_kg',
        'air_per_kg',
        'energi_per_kg',
    ];

    public function setoran()
    {
        return $this->hasMany(Setoran::class, 'id_jenis', 'id_jenis');
    }
}
