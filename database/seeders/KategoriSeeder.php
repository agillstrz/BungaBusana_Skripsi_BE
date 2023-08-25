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
              "image"=> "https://images.tokopedia.net/img/cache/900/VqbcmM/2022/12/8/b7516647-ba50-44c0-847c-ae2880090776.jpg"
            ],
            [
                "name"=> "Blazer",
                "image"=> "https://images.tokopedia.net/img/cache/900/VqbcmM/2022/4/5/40270242-8640-4dd9-900b-7dd2e9a37c20.jpg"
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
                "image"=> "https://images.tokopedia.net/img/cache/900/VqbcmM/2022/8/23/f6b88f6d-f8c7-4b6b-b527-85d5927f5e4d.jpg"
            ],
            [
                "name"=> "Pakaian tidur",
                "image"=> "https://images.tokopedia.net/img/cache/900/hDjmkQ/2022/11/15/a3781130-5149-443c-9ae1-0ba04c6f231a.jpghttps://images.tokopedia.net/img/cache/900/VqbcmM/2022/12/13/d59ea7df-5eb9-4f57-adbb-c6986ef950c8.jpg"
            ],
            [
                "name"=> "Hoodie",
                "image"=> "https://images.tokopedia.net/img/cache/900/VqbcmM/2020/9/28/18c02e74-5af4-47a3-a81c-e7cb1aaf4086.jpg"
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