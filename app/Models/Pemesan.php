<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function pesanan(){
        return $this->hasMany(Pesanan::class);
    }
    public function ongkir(){
        return $this->hasMany(Ongkir::class);
    }
}