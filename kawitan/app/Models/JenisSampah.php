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
            'Plastik PET'        => [2.9, 180, 80],
            'Plastik HDPE'       => [2.5, 160, 70],
            'Plastik Campuran'   => [3.0, 200, 90],

            'Kertas'             => [1.0, 40, 20],
            'Karton'             => [1.2, 50, 25],
            'Koran'              => [0.9, 35, 18],

            'Aluminium'          => [5.5, 120, 150],
            'Besi'               => [2.1, 90, 60],
            'Logam Campuran'     => [3.5, 110, 100],

            'Kaca'               => [0.8, 30, 15],

            'Sampah Organik'     => [0.3, 20, 5],
            'Sisa Makanan'       => [0.4, 25, 6],

            'Tekstil'            => [3.2, 250, 120],
            'Elektronik'         => [6.0, 300, 200],
        ];

        return $map[$nama] ?? [1.05, 50, 30];
    }

    public function setoran()
    {
        return $this->hasMany(Setoran::class, 'id_jenis', 'id_jenis');
    }
}
