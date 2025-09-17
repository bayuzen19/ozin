<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indikator extends Model
{
    use HasFactory;

    protected $table = 'indikator';
    protected $guarded = [''];
    protected $fillable = ['id', 'nama_indikator', 'bobot'];
    public $timestamps = false;
}
