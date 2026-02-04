<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenukaranPoin extends Model
{
    use HasFactory;


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



    public function riwayatSetoran()
    {
        return $this->belongsTo(RiwayatSetoran::class, 'id_riwayat', 'id_riwayat');
    }

    public function hadiah()
    {
        return $this->belongsTo(Hadiah::class, 'id_hadiah', 'id_hadiah');
    }
}
