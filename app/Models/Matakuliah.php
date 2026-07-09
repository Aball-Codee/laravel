<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    protected $table = 'matakuliah';

    protected $fillable = [
        'kode',
        'nama',
        'sks'
    ];

    public function nilais()
    {
        return $this->hasMany(Nilai::class);
    }
}