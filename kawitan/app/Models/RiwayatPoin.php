<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatSetoran extends Model
{
    use HasFactory;


    protected $table = 'riwayat_poin';
    protected $primaryKey = 'id_riwayat';
    public $timestamps = false;


    protected $fillable = [
        'id_user',
        'poin',
    ];



    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function penukaranPoin()
    {
        return $this->hasMany(PenukaranPoin::class, 'id_riwayat', 'id_riwayat');
    }
}
