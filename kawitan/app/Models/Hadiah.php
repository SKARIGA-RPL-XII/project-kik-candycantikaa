<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hadiah extends Model
{
    use HasFactory;


    protected $table = 'hadiah';
    protected $primaryKey = 'id_hadiah';
    public $timestamps = false;


    protected $fillable = [
        'gambar',
        'nama_hadiah',
        'poin_dibutuhkan',
        'stok',
        'deskripsi',
    ];



    public function penukaranPoin()
    {
        return $this->hasMany(PenukaranPoin::class, 'id_hadiah', 'id_hadiah');
    }
}
