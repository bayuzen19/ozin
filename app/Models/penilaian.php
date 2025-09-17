<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penilaian extends Model
{
    use HasFactory;
    /*
    protected $fillable = [
        'aplikasi_id', 'nama_indikator', 'bobot', 'nilai', 'keterangan', 'bukti'
    ];
    */

    protected $table = 'penilaian';
    protected $guarded = [''];
    protected $fillable = ['aplikasi_id', 'indikator_id', 'bobot', 'nilai', 'keterangan', 'bukti'];
    public $timestamps = false;

    /*
    public function aplikasi()
    {
        return $this->belongsTo((Aplikasi::class));
    }

    public function rataRataNilai()
    {
        return $this->penilaian()->avg('nilai');
    }
    */
}
