<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesan extends Model
{
    use HasFactory;
    use HasUuids;

    protected $primaryKey = 'id'; // Jika kolom primary key menggunakan nama lain
    public $incrementing = false; // ID tidak berupa auto-increment
    protected $keyType = 'string'; // Tipe data primary key


 
   
    public function ongkir(){
        return $this->hasMany(Ongkir::class);
    }

    public function transaksi()
    {
        return $this->hasOne(Transaksi::class);
    }
}