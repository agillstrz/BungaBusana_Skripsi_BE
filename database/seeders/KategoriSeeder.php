<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kategori::create([
            'name' => 'kategori2',
            'image' => 'https://lzd-img-global.slatic.net/g/p/5cbc3ccfc9b8ea34046532edcef7439f.jpg_720x720q80.jpg'
        ]);
        
    }
}
