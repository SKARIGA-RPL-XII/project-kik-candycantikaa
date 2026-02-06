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

    public static function ecoImpactMap(string $nama): array
    {
        $map = [
            'Plastik PET'        => [2.09, 180, 80],
            'Plastik HDPE'       => [2.05, 160, 70],
            'Plastik Campuran'   => [3.0, 200, 90],

            'Kertas'             => [1.0, 40, 20],
            'Karton'             => [1.02, 50, 25],
            'Koran'              => [0.09, 35, 18],

            'Aluminium'          => [5.05, 120, 150],
            'Besi'               => [2.01, 90, 60],
            'Logam Campuran'     => [3.05, 110, 100],

            'Kaca'               => [0.08, 30, 15],

            'Sampah Organik'     => [0.03, 20, 5],
            'Sisa Makanan'       => [0.04, 25, 6],

            'Tekstil'            => [3.02, 250, 120],
            'Elektronik'         => [6.0, 300, 200],
        ];

        return $map[$nama] ?? [1.05, 50, 30];
    }

    public function setoran()
    {
        return $this->hasMany(Setoran::class, 'id_jenis', 'id_jenis');
    }
}
