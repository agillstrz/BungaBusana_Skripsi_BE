<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ongkir extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function pesanan(){
        return $this->hasOne(Pesanan::class);
    }
}