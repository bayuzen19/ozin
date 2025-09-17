<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aplikasi extends Model
{
    use HasFactory;

    protected $table = 'aplikasi';
    protected $guarded = [''];
    protected $fillable = ['nama_aplikasi', 'kematangan', 'predikat', 'deskripsi'];
    public $timestamps = false;
    /*
    public function penilaian()
    {
        return $this->hasMany(penilaian::class);
    }

    
    public function hitungKematangan()
    {
        $totalNilai = 0;
        $totalBobot = 0;

        foreach ($this->penilaian as $penilaian) {
            $totalNilai += $penilaian->nilai * ($penilaian->bobot / 100);
            $totalBobot += $penilaian->bobot;
        }

        return $totalBobot > 0 ? $totalNilai / ($totalBobot / 100) : 0;
    }
    */
}
