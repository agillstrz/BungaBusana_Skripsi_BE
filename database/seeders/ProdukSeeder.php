<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data= [
            [
              "kategori"=> 1,
              "harga" => 125000,
              "foto"=> "https://images.tokopedia.net/img/cache/900/VqbcmM/2022/11/16/c7daff31-6211-4bf0-88bc-64e64a658a69.jpg",
              "nama"=> "Kaos",
              "deskripsi"=> "Occlusion of Middle Colic Artery with Extraluminal Device, Percutaneous Approach"
            ],
            [
                "kategori"=> 3,
                "harga" => 125000,
                "foto"=> "https://images.tokopedia.net/img/cache/900/VqbcmM/2022/6/30/b895cf09-f2f0-4b04-8527-61f285bf03a0.jpg",
                "nama"=> "Mickout Casual Shirt Scientific White - M",
                "deskripsi"=> "Restriction of Middle Esophagus, Via Natural or Artificial Opening"
            ],
            [
                "kategori"=> 3,
                "harga" => 125000,
                "foto"=> "https://images.tokopedia.net/img/cache/900/product-1/2020/9/8/12805457/12805457_7fbe4712-fcf0-47c8-a8f9-1096c2b41be9_1018_1018",
                "nama"=> "kemeja PUTIH polos pria lengan panjang",
                "deskripsi"=> "Restriction of Middle Esophagus, Via Natural or Artificial Opening"
            ],
            [
                "kategori"=> 6,
                "harga" => 125000,
                "foto"=> "https://images.tokopedia.net/img/cache/900/VqbcmM/2022/3/8/3018642f-58f1-4a17-a339-505c4bb22d14.jpg",
                "nama"=> "BAJU TIDUR WANITA | PIYAMA - GOOD NIGHT",
                "deskripsi"=> "Restriction of Middle Esophagus, Via Natural or Artificial Opening"
            ],
            [
                "kategori"=> 6,
                "harga" => 125000,
                "foto"=> "https://images.tokopedia.net/img/cache/900/VqbcmM/2023/7/6/f0188fde-5a1d-425e-afc2-b60cd4b70981.jpg",
                "nama"=> "ROSE LONGSLEEVES BAJU TIDUR-PAKAIAN WANITA",
                "deskripsi"=> "Restriction of Middle Esophagus, Via Natural or Artificial Opening"
            ],
            [
                "kategori"=> 3,
                "harga" => 125000,
                "foto"=> "https://images.tokopedia.net/img/cache/900/hDjmkQ/2023/7/4/17eb3dd7-6fd3-4777-99b6-5a2f70b6b7d7.jpg",
                "nama"=> "Kemeja Polo Knit - Cozy Knit Polo ",
                "deskripsi"=> "Restriction of Middle Esophagus, Via Natural or Artificial Opening"
            ],
            [
                "kategori"=> 5,
                "harga" => 125000,
                "foto"=> "https://images.tokopedia.net/img/cache/900/hDjmkQ/2023/5/19/083bc34d-9f48-424b-8b41-52fcf78f0cc1.jpg",
                "nama"=> "Blouse Atasan Batik Wanita - Asri Blouse",
                "deskripsi"=> "Restriction of Middle Esophagus, Via Natural or Artificial Opening"
            ],
            [
                "kategori"=> 5,
                "harga" => 125000,
                "foto"=> "https://images.tokopedia.net/img/cache/900/VqbcmM/2022/11/18/c09d151c-cb5c-4f95-bf98-8de2d142fe0b.jpg",
                "nama"=> "Blouse korea wanita",
                "deskripsi"=> "Restriction of Middle Esophagus, Via Natural or Artificial Opening"
            ],
            [
                "kategori"=> 3,
                "harga" => 125000,
                "foto"=> "https://images.tokopedia.net/img/cache/900/VqbcmM/2022/10/13/bc850aef-647d-4b5b-9781-965dcbc98f86.png",
                "nama"=> "Zianna Top - Blus Kemeja Wanita ",
                "deskripsi"=> "Restriction of Middle Esophagus, Via Natural or Artificial Opening"
            ],
            [
                "kategori"=> 7,
                "harga" => 125000,
                "foto"=> "https://images.tokopedia.net/img/cache/900/VqbcmM/2022/6/19/eb9bee26-5a9b-4096-bd2c-5340633d5cdc.png",
                "nama"=> "Hoodie Polos Jumbo Bigsize ",
                "deskripsi"=> "Restriction of Middle Esophagus, Via Natural or Artificial Opening"
            ],
            [
                "kategori"=> 7,
                "harga" => 125000,
                "foto"=> "https://images.tokopedia.net/img/cache/900/VqbcmM/2022/7/2/2e1f3d35-1e77-4a3c-8f14-53f702cb3c53.jpg",
                "nama"=> "Hoodie Panjang Light Brown 2197A",
                "deskripsi"=> "Restriction of Middle Esophagus, Via Natural or Artificial Opening"
            ],
            [
                "kategori"=>7,
                "harga" => 125000,
                "foto"=> "https://images.tokopedia.net/img/cache/900/VqbcmM/2023/2/23/28dc61dc-4ecc-4874-8135-282612d9285b.jpg",
                "nama"=> "Jaket Pria Jaket Parasut",
                "deskripsi"=> "Restriction of Middle Esophagus, Via Natural or Artificial Opening"
            ],
        ];

        foreach ($data as $item) {
            Produk::create([
                'kategori_id'=>  $item["kategori"],
                "harga" => $item["harga"],
                'nama'=>  $item["nama"],
                'deskripsi'=>  $item["deskripsi"],
                'foto'=>  $item["foto"],
                'foto2'=>  $item["foto"],
                'foto3'=>  $item["foto"],
            ]);
       
        }  

    }
}