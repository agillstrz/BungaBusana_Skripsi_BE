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
              "harga" => 45000,
              "foto"=> "https://images.tokopedia.net/img/cache/900/VqbcmM/2022/10/6/84a9d7d1-a006-4f71-89a1-4a574c7cd84e.jpg",
              "nama"=> "Daster Longdress Lengan Panjang",
              "deskripsi"=> "Daster Longdress Lengan Panjang"
            ],
            [
                "kategori"=> 3,
                "harga" => 98000,
                "foto"=> "https://images.tokopedia.net/img/cache/900/VqbcmM/2021/3/20/fdf60353-58d3-402b-ac64-191cb2d72446.png",
                "nama"=> "KEMEJA LENGAN PANJANG SLIMFIT",
                "deskripsi"=> "Ciptakan tampilan santai yang tetap keren dengan Kemeja Kasual kami yang baru ini. Dibuat dengan perpaduan sempurna antara gaya dan kenyamanan, kemeja ini akan menjadi tambahan yang sempurna untuk koleksi pakaian kasual Anda"
            ],
            [
                "kategori"=> 3,
                "harga" => 125000,
                "foto"=> "https://images.tokopedia.net/img/cache/900/product-1/2020/9/8/12805457/12805457_7fbe4712-fcf0-47c8-a8f9-1096c2b41be9_1018_1018",
                "nama"=> "kemeja PUTIH polos lengan panjang",
                "deskripsi"=> "Restriction of Middle Esophagus, Via Natural or Artificial Opening"
            ],
            [
                "kategori"=> 6,
                "harga" => 55000,
                "foto"=> "https://images.tokopedia.net/img/cache/900/VqbcmM/2022/6/17/3eadd429-c92b-4d9e-8971-0c748c2d0332.jpg",
                "nama"=> "Baju Tidur Piyama Wanita Katun",
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
                "foto"=> "https://images.tokopedia.net/img/cache/900/VqbcmM/2023/6/12/4be2fc74-3c24-4316-9485-5eaaeaf3571f.jpg",
                "nama"=> "Wulfi Atasan Kemeja Casual Shirt MintSage",
                "deskripsi"=> "Atasan kemeja bahan anti kusut dan gampang kering
                Kerah koko yang nyaman, kancing dari atas full sampai bawah sehingga juga busui friendly.
                Cutting membuat badan terlihat lebih ramping.
                Menggunakan bahan yang dirakit sendiri sehingga adem dan nyaman untuk kegiatan sehari-hari."
            ],
            [
                "kategori"=> 3,
                "harga" => 155000,
                "foto"=> "https://images.tokopedia.net/img/cache/900/VqbcmM/2023/3/10/00519f5f-8a06-4572-9926-2b72519bdea3.jpg",
                "nama"=> "Enzy Basic Kemeja Pria Oxford Lengan Pendek -Navy - S ",
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
                "harga" => 135000,
                "foto"=> "https://images.tokopedia.net/img/cache/900/VqbcmM/2022/12/2/64480794-792d-4fb6-84c9-6c0a66ec825f.jpg",
                "nama"=> "Kemeja Katun Wanita Lengan Panjang",
                "deskripsi"=> "Restriction of Middle Esophagus, Via Natural or Artificial Opening"
            ],
            [
                "kategori"=> 7,
                "harga" => 83000,
                "foto"=> "https://images.tokopedia.net/img/cache/900/VqbcmM/2023/2/17/1613704e-41b4-423e-8e19-91c5bd969f00.jpg",
                "nama"=> "Kemeja Batik Pria Slim Fit Lengan Pendek Cotton",
                "deskripsi"=> "Bahan cotton Stretch tebal, lembut, halus, tentunya adem dan nyaman di pakai"
            ],
            [
                "kategori"=> 7,
                "harga" => 83000,
                "foto"=> "https://images.tokopedia.net/img/cache/900/VqbcmM/2022/7/5/a45a9b05-343a-4693-afdc-77de120407ec.jpg",
                "nama"=> "BAJU KEMEJA BATIK PRIA LENGAN PANJANG FURING KATUN",
                "deskripsi"=> "Bahan cotton Stretch tebal, lembut, halus, tentunya adem dan nyaman di pakai"
            ],
            [
                "kategori"=>7,
                "harga" => 89000,
                "foto"=> "https://images.tokopedia.net/img/cache/900/VqbcmM/2022/11/21/b8e0026d-ecb5-48ea-a974-3a6da09d149c.jpg",
                "nama"=> "Mukena Dewasa Siti Khadijah Katun",
                "deskripsi"=> "Restriction of Middle Esophagus, Via Natural or Artificial Opening"
            ],
        ];

        // $data= [
        //     [
        //         "kategori"=> 3,
        //         "harga" => 85000,
        //         "foto"=> "https://down-id.img.susercontent.com/file/f3bd36b70bf7e900c0adc1605370806e",
        //         "nama"=> "HOODIE ZIPER SWEATER UNISEX",
        //         "deskripsi"=> "Sweater yang cocok untuk sista yang selalu mengikuti trend kekinian dan juga fashionable
        //         karna bahan lembut juga tidak mudah kusut tentunya menambah kesan rapi"
        //     ],
        //     [
        //         "kategori"=> 7,
        //         "harga" => 125000,
        //         "foto"=> "https://down-id.img.susercontent.com/file/id-11134201-7qul5-ljqdlm6x9j4r5f",
        //         "nama"=> "Baju Tidur Wanita Dewasa Oversize Piyama",
        //         "deskripsi"=> ""
        //     ],
        //     [
        //         "kategori"=> 7,
        //         "harga" => 90000,
        //         "foto"=> "https://down-id.img.susercontent.com/file/11fc949777e098395cc3de351d4e295d",
        //         "nama"=> "Baju Kaos Distro Lengan Pendek Original",
        //         "deskripsi"=> "Kaos Distro Lengan Pendek by DIKLINE"
        //     ],
        //     [
        //         "kategori"=>7,
        //         "harga" => 175000,
        //         "foto"=> "https://down-id.img.susercontent.com/file/11a398a5e9ed53b0b8ca10838d1525f7_tn",
        //         "nama"=> " Dexy Loose Oversize Shirt",
        //         "deskripsi"=> "Dexy Loose Oversize Shirt Bahan Katun Poly Fit L"
        //     ],
        // ];
     

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