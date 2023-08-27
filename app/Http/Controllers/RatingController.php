<?php

namespace App\Http\Controllers;

use App\Models\Pemesan;
use App\Models\Pesanan;
use App\Models\Produk;
use Phpml\Math\Distance\Jaccard;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Phpml\Math\Distance\Cosine;
class RatingController extends Controller
{


  public function index($id){

    $ulasan = Rating::where('produk_id', $id)->get();

    return response()->json([
      'data' => $ulasan
    ]);
  }
    public function addRating(Request $request){

      
  //  Rating::create([
  //       'user_id' => Auth::id(),
  //       'produk_id' => $request->produk_id,
  //       'komentar' => $request->komentar,
  //       'rating'=> $request->rating
  //     ]);

    
      $check_user = Rating::where('user_id', Auth::id())->where('produk_id', $request->produk_id)->exists();
      if($check_user){
        throw ValidationException::withMessages([
          'produk' => ["Anda Sudah memberi rating"]
      ]);

      } else{
        $rating = Rating::create([
          'user_id' => Auth::id(),
          'produk_id' => $request->produk_id,
          'komentar' => $request->komentar,
          'rating'=> $request->rating
        ]);

        $produk = Produk::find($request->produk_id);
      
        $produkRating = Rating::where('produk_id', $request->produk_id)->avg('rating');
        $produk->rating = $produkRating;
        $produk->save();
     
        return response()->json([
          'data'=> $rating,
          'message' => "berhasil memberikan rating"
        ]);

      }

   


    }




  

public function recommendProducts(Request $request)
{
  $allProduk = Rating::all();
  $prediksiWeightSum=[];
  $allProdukSelect=[];

 if($request->user_id){
  foreach ($allProduk as $items) {
    $selectedProductRatings = Rating::where('produk_id', $items->produk_id)->get();
    $similarRatings = Rating::whereIn('user_id', $selectedProductRatings->pluck('user_id'))->where('produk_id', '!=', $items->produk_id)->get();
    $similarities = [];
    $x = 0;
    $y = 0;
    
    foreach ($similarRatings->groupBy('produk_id') as $produk_id => $rating) {
      $product = Produk::find($produk_id);
      $cekUserRating = Rating::where('produk_id' , $produk_id)->where('user_id', $request->user_id)->exists();
      $productRatingUser = Rating::where('produk_id' , $produk_id)->where('user_id', $request->user_id)->first();
      $similarity = $this->calculateSimilarity($selectedProductRatings, $rating);
      $allProdukSelect[$product->id][$items->produk_id] = $similarity;
      if($similarity > 0 && $similarity <=1 && $cekUserRating  ){
        $similarities[$product->id] = $similarity;
       
        $x+= $productRatingUser->rating * $similarity;
        $y+= $similarity;
  
      } 
    }
  
   if($cekUserRating && $x!==0){
    $prediksiWeightSum[$items->produk_id] = abs($x / $y);
   }
  
   
  
  
  }
  
  arsort($prediksiWeightSum);  // Mengurutkan array asli
  
  $sortedKeys = array_keys($prediksiWeightSum);  // Mendapatkan kunci-kunci terurut
  
  
            $recommendedProducts = Produk::whereIn('id', $sortedKeys);
  
            if (!empty($sortedKeys)) {
                $recommendedProducts->orderByRaw("FIELD(id, " . implode(',', $sortedKeys) . ")");
                $rekomendasi = $recommendedProducts->get();
            } else{
  
              $rekomendasi = Produk::orderByDesc('rating')->take(4)->get();
  
            }
 } else {
  $rekomendasi = Produk::orderByDesc('rating')->get();
 }
          

   return response()->json(
    [
      'cek' => $prediksiWeightSum,
      'similarity' => $allProdukSelect,
      'rekomendasi' => $rekomendasi
    ]
   );

}
   
public function rekomendasi($productId)
{
  $allProduk = Rating::all();
  
  $selectedProductRatings = Rating::where('produk_id', $productId)->get();
  $similarRatings = Rating::whereIn('user_id', $selectedProductRatings->pluck('user_id'))->where('produk_id', '!=', $productId)->get();

   $similarities = [];

 
  foreach ($similarRatings->groupBy('produk_id') as $produk_id => $rating) {
    $product = Produk::find($produk_id);
    $similarity = $this->calculateSimilarity($selectedProductRatings, $rating);
    // if($similarity > 0 && $similarity <=1  ){
      $similarities[$product->id] = $similarity;
    // } 
}
          $recommendedProducts = Produk::whereIn('id', array_keys($similarities))->where('id', '!=', 1)->get();
          // ->where('id', '!=', $productId)->take(6)->get();
  
   return response()->json(
    [
      'calculate' => $similarities,
      'rekomendasi' => $recommendedProducts
    ]
   );

}
   
      
private function calculateSimilarity($pro1, $pro2){
  $dotProduct = 0;
  $normA = 0;
  $normB = 0;
  foreach ($pro1 as $rating1) { 
    foreach ($pro2 as $rating2) {
        if ($rating1->user_id === $rating2->user_id) {
          
          $avg1 = Rating::where('produk_id', $rating1->produk_id)->avg('rating');
          $avg2 = Rating::where('produk_id', $rating2->produk_id)->avg('rating');
         
          $dotProduct+= ($rating1->rating - $avg1) * ($rating2->rating - $avg2);
          $normA  +=  pow(($rating1->rating - $avg1),2);
          $normB  +=  pow(($rating2->rating - $avg2),2);

          
        }
    }
}


if($dotProduct == 0  ){
  return 0;
} else{
  $Similarity = $dotProduct / (sqrt($normA) * sqrt($normB));
}

if($Similarity > 0 && $Similarity<=1){
  return $Similarity;
}  else{
  return 0;
}


}


  public function checklogic($produkId){
    
  }
}