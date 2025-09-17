<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aspek extends Model
{
    use HasFactory;

    protected $fillable = ['nama_aspek', 'bobot_aspek'];
    public $timestamps = false;

    public function indikator()
    {
        return $this->hasMany(Indikator::class);
    }
}
