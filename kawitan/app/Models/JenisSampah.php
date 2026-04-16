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
            'Plastik PET' => [2.9, 180, 80],
            'Plastik HDPE' => [2.5, 160, 70],
            'Plastik PVC' => [2.7, 170, 75],
            'Plastik LDPE' => [2.6, 165, 72],
            'Plastik PP' => [2.8, 175, 78],
            'Plastik PS' => [3.1, 210, 95],
            'Plastik Campuran' => [3.0, 200, 90],

            'Kertas' => [1.0, 40, 20],
            'Karton' => [1.2, 50, 25],
            'Koran' => [0.9, 35, 18],
            'Majalah' => [1.1, 45, 22],

            'Aluminium' => [5.5, 120, 150],
            'Kaleng Aluminium' => [5.2, 115, 140],
            'Besi' => [2.1, 90, 60],
            'Baja' => [2.3, 95, 65],
            'Tembaga' => [3.8, 100, 110],
            'Logam Campuran' => [3.5, 110, 100],

            'Kaca' => [0.8, 30, 15],
            'Botol Kaca' => [0.9, 35, 18],

            'Sampah Organik' => [0.3, 20, 5],
            'Sisa Makanan' => [0.4, 25, 6],
            'Daun Kering' => [0.2, 15, 4],
            'Kayu' => [0.6, 30, 10],

            'Tekstil' => [3.2, 250, 120],
            'Katun' => [3.0, 270, 110],
            'Polyester' => [3.5, 260, 130],
            'Elektronik' => [6.0, 300, 200],
            'Ban Bekas' => [4.0, 200, 180],
        ];

        return $map[$nama] ?? [1.05, 50, 30];
    }

    public function setoran()
    {
        return $this->hasMany(Setoran::class, 'id_jenis', 'id_jenis');
    }
}
