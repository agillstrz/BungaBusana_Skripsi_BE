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
        $data= [
            [
              "name"=> "Kaos",
              "image"=> "https://images.tokopedia.net/img/cache/900/hDjmkQ/2023/5/7/e4115cc4-8ac6-4580-9592-da24465824a0.jpg"
            ],
            [
                "name"=> "Blazer",
                "image"=> "https://images.tokopedia.net/img/cache/900/VqbcmM/2023/2/19/24e06a99-1210-4e70-a270-d85f9a0ac24c.jpg"
            ],
            [
                "name"=> "Kemeja",
                "image"=> "https://images.tokopedia.net/img/cache/900/hDjmkQ/2023/7/5/44804fe5-4137-4851-b2b6-0c7fd13c28b0.jpg"
            ],
            [
                "name"=> "Batik",
                "image"=> "https://images.tokopedia.net/img/cache/900/VqbcmM/2023/7/7/f0df9c3c-86cd-483b-93dd-31bef7788060.jpg"
            ],
            [
                "name"=> "Blus",
                "image"=> "https://images.tokopedia.net/img/cache/900/VqbcmM/2023/7/24/b1f443c7-d9f2-40cd-ba46-ffff1f392b04.jpg"
            ],
            [
                "name"=> "Pakaian tidur",
                "image"=> "https://images.tokopedia.net/img/cache/900/hDjmkQ/2022/11/15/a3781130-5149-443c-9ae1-0ba04c6f231a.jpg"
            ],
            [
                "name"=> "Hoodie",
                "image"=> "https://images.tokopedia.net/img/cache/900/VqbcmM/2020/9/28/f157c904-2c51-46b0-b299-96ef18efb9b2.jpg"
            ],
        ];

      foreach ($data as $item) {
        Kategori::create([
            'name' => $item["name"],
            'image' => $item["image"]
        ]);
      }
        
    }
}