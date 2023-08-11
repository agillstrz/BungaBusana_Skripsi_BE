<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Pemesan;
use App\Models\Pesanan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::create([
        //     'name' => 'agillstrz',
        //     'email' => 'agillstrz@gmail.com',
        //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 
        //     'role' => 1
        // ]);
        $data = [2,3,4,5,7];
        foreach ($data as $key => $item) {
            Pesanan::create([
                'pemesan_id'=> 1,
                'produk_id'=> $item,
                'jml_pesanan'=> 5,
                'total_harga'=> 135000,
            ]);
        }
        // Pesanan::create([
        //     'pemesan_id'=> 1,
        //     'produk_id'=> 1,
        //     'jml_pesanan'=> 5,
        //     'total_harga'=> 210000,
        // ]);

    //    Pemesan::create([
    //         'user_id' => 1,
    //         'nama' => 'Muhammad Agil',
    //         'email' => 'agillstrz@gmail.com',
    //         'nohp' => '082281788810',
    //         'provinsi' => 'Jambi',
    //         'kota' => 'Tebo',
    //         'alamat' => 'Tebo Tengah',
    //         'kodepos' => '37571',
    //         'tanggal_pemesanan' => '23-08-2023',
    //         'status_pembayaran' => true,
    //         'metode_pembayaran' => 'BCA',
    //         'harga_pesanan' => 120000
    //       ]);
    }
}