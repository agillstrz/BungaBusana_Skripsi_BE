<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function pemesan (){
        return $this->belongsTo(Pemesan::class);
    }

    public function produk (){
        return $this->belongsTo(Produk::class);
    }
    public function ongkir (){
        return $this->belongsTo(Ongkir::class);
    }
}