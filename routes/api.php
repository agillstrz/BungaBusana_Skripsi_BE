<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HandlePaymentController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MLController;
use App\Http\Controllers\OngkirController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\PredictController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\RajaOngkirController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\RecomendationController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Redis\Connectors\PredisConnector;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('login', [LoginController::class, 'login']);
Route::post('register', [RegisterController::class, 'Register']);
Route::get('me', [LoginController::class, 'me'])->middleware('auth:sanctum');

//Crud Produk
Route::get('produk', [ProdukController::class, 'index']);

Route::post('produk', [ProdukController::class, 'addProduk']);
Route::put('produk/{id}', [ProdukController::class, 'updateProduk']);
Route::delete('produk/{id}', [ProdukController::class, 'deleteProduk']);

// Crud kategori
Route::get('kategori', [KategoriController::class, 'index']);
Route::post('kategori', [KategoriController::class, 'addKategori']);
Route::put('kategori/{id}', [KategoriController::class, 'updateKategori']);
Route::delete('kategori/{id}', [KategoriController::class, 'deleteKategori']);

//Rating 
Route::post('rating', [RatingController::class, 'addRating'])->middleware('auth:sanctum');
Route::post('rating/{productId}', [RatingController::class, 'rekomendasi'])->middleware('auth:sanctum');
Route::get('rekomendasiProduk', [RatingController::class, 'recommendProducts']);
Route::get('rating/{id}', [RatingController::class, 'index']);

// Route::post('rating', [RatingController::class, 'index'])->middleware('auth:sanctum');


//keranjang 
Route::get('keranjang', [CartController::class, 'index'])->middleware('auth:sanctum');
Route::post('keranjang', [CartController::class, 'store'])->middleware('auth:sanctum');
Route::put('keranjang', [CartController::class, 'update'])->middleware('auth:sanctum');
Route::get('jmlkeranjang', [CartController::class, 'jmlkeranjang'])->middleware('auth:sanctum');
Route::delete('keranjang/{id}', [CartController::class, 'destroy'])->middleware('auth:sanctum');

//pesan
Route::post('pesan', [PesananController::class, 'store'])->middleware('auth:sanctum');

//pesanan
Route::get('pesanan', [PesananController::class, 'index']);


// ongkir
Route::post('ongkir', [OngkirController::class, 'addOngkir']);
Route::get('province', [OngkirController::class, 'getProvince']);
Route::get('ongkir/{id}', [OngkirController::class, 'getPesanan'])->middleware('auth:sanctum');


Route::get('/ml', [MLController::class, 'knn']);



//user
Route::get('produkUser', [UserController::class, 'produkUser']);
Route::get('detailProdukUser/{id}', [UserController::class, 'detailProdukUser']);
Route::get('checkoutBarang', [UserController::class, 'checkoutBarang'])->middleware('auth:sanctum');
Route::get('history', [UserController::class, 'historyProduk'])->middleware('auth:sanctum');
Route::get('detailPesananUser/{id}', [UserController::class, 'detailPesananUser']);
Route::get('produk-home', [UserController::class, 'produkHome']);




Route::get('/rajaongkir/provinces', [RajaOngkirController::class, 'getProvinces']);


Route::get('/province', function () {
    $apiKey = env('API_RAJA_ONGKIR'); // Ganti dengan API key Anda dari Raja Ongkir

    $response = Http::withHeaders([
        'key' => $apiKey,
    ])->get('https://api.rajaongkir.com/starter/province');

    return $response->json();
});



Route::get('city', function (Request $request) {
    $provinsi  =  $request->provinsi;
    $apiKey = env('API_RAJA_ONGKIR'); // Ganti dengan API key Anda dari Raja Ongkir
    $response = Http::withHeaders([
        'key' => $apiKey,
    ])->get('https://api.rajaongkir.com/starter/city?province='. $provinsi);

    return $response->json();
});



Route::get('listPemesan', [AdminController::class, 'pemesan']);
Route::get('detailPesananAdmin/{id}', [AdminController::class, 'detailPesananAdmin']);
Route::get('dashboard', [AdminController::class, 'dashboard'])->middleware('auth:sanctum');
Route::get('pengguna', [AdminController::class, 'pengguna'])->middleware('auth:sanctum');
Route::put('updatePesanan/{id}', [AdminController::class, 'updatePesanan'])->middleware('auth:sanctum');

Route::post('midtrans/notif', [HandlePaymentController::class]);
Route::post('beli', [PesananController::class,'beli'])->middleware('auth:sanctum');
Route::post('cekBeli', [PesananController::class,'webhook']);