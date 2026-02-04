<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setoran extends Model
{
    use HasFactory;

    protected $table = 'setoran';
    protected $primaryKey = 'id_setoran';
    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'id_jenis',
        'berat',
        'total_poin',
        'total_co2',
        'total_air',
        'total_energi',
        'tanggal',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function jenis()
    {
        return $this->belongsTo(JenisSampah::class, 'id_jenis', 'id_jenis');
    }
}
