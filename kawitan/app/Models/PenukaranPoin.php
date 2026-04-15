<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\RiwayatPoin;
use App\Models\Hadiah;

class PenukaranPoin extends Model
{
    protected $table = 'penukaran_poin';
    protected $primaryKey = 'id_penukaran';
    public $timestamps = false;

    protected $fillable = [
        'id_riwayat',
        'id_hadiah',
        'poin_dipakai',
        'tanggal',
        'status',
    ];

    public function riwayatPoin()
    {
        return $this->belongsTo(RiwayatPoin::class, 'id_riwayat', 'id_riwayat');
    }

    public function hadiah()
    {
        return $this->belongsTo(Hadiah::class, 'id_hadiah', 'id_hadiah');
    }
}
