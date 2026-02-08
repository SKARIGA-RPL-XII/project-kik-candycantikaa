<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatPoin extends Model
{
    protected $table = 'riwayat_poin';
    protected $primaryKey = 'id_riwayat';
    public $timestamps = true;

    protected $fillable = [
        'id_user',
        'poin',          
        'jumlah_poin',
        'keterangan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
