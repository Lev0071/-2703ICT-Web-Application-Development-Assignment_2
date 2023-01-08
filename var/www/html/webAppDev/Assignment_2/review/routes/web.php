 <?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

use App\Models\Product;
use App\Models\User;
use App\Models\Review;
use App\Models\Vote;
use App\Models\Follow;
//use App\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// - Route for the home page
Route::get('/product', [ProductController::class, 'index']);
// - Route to review a product on the details page
Route::get('/product/review_item/{id}', [ProductController::class, 'reviewProduct']);
// - Route to create a new review for a product
Route::post('/product/review_item', [ProductController::class, 'create_review_product']);
// - Route to return form to edit an existing review
Route::get('/product/{id}/edit_review_form', [ProductController::class, 'edit_review_product']);
// - Route edit existing review after submitting the form via POST
Route::post('/product/update_review', [ProductController::class, 'update_review']);
// - Route deleting an existing review record
Route::post('/product/delete_review/{id}', [ProductController::class, 'delete_review']);
// - Route to like or dislike a review
Route::post('/product/vote_review', [ProductController::class, 'review_like_dislike']);
// - Route to show all existing users
Route::get('/product/users', [ProductController::class, 'show_users']);
// - Route to follow or unfollow existing users
Route::post('/product/follow_unfollow', [ProductController::class, 'follow_unfollow']);

Route::resource('product',ProductController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

// TESTS
// Test first development
// All code here was used to test the function to retrieve data from the model before implementing the view

Route::get('/testReview', function () {
    $user = User::find(1);
    $prods = $user->products; // products user has reviewed
    //dd($prods);

    $name = "Surface Pro";
    $products = $user->products()->whereRaw('name like ?',array("%$name%"))->get();
    dd($products);
});
// Route::get('/test', function () {
//     // $product = new Product;
//     // $product->name = 'ipod 11';
//     // $product->price = 19.99;
//     // $product->save();
//     // $id = $product->id;
//     // dd($product);
  
//     //$product = Product::create(array('name'=>'Google Pixel','price'=>1000));
//   });
  
  Route::get('/get', function () {
    $products = Product::all();
    //dd($products);
  
    foreach ($products as $product){
      echo "$product->name <br>";
    }
  });
  
  Route::get('product/{id}', function ($id) {
    $product = Product::find($id);
    echo "$product->name <br>";
  });
  
  Route::get('productPriceG/{price}', function ($price) {
    $products = Product::where('price','>',$price)->get();
    dd($products);
    //echo "$product->name <br>";
  });
  
  Route::get('count', function () {
    $count = Product::all()->count();
    dd($count);
    //echo "$product->name <br>";
  });
  
  // Return product(s) of a manufacturer
  Route::get('productFromMan/{id}', function ($id) {
    $products = Manufacturer::find($id)->products;
    dd($products);
    // foreach($products as $product){
    //   echo "$product->name <br>";
    // }
  });
  
  // Return manufacturer of a product(s) using product ID
  Route::get('manufaturerFromProd/{id}', function ($id) {
    $manufacturer = Product::find($id)->manufacturer;
    dd($manufacturer);
    // foreach($manufacturer as $man){
    //   echo "$man->name <br>";
    // }
  });
  
  // Return product(s) of a manufacturer
  Route::get('productFromManCount', function () {
    $products = Manufacturer::all()->count();
    dd($products);
    // foreach($products as $product){
    //   echo "$product->name <br>";
    // }
  });

  Route::get('/U-R-P', function () {
    $user = User::find(1);
    $prods = $user->products; // products user has reviewed
    dd($prods);

    $name = "Surface Pro";
    $products = $user->products()->whereRaw('name like ?',array("%$name%"))->get();
    dd($products);
});

Route::get('/P-R-U', function () {
  $prod = Product::find(3);
  $user = $prod->users; // products user has reviewed
  dd($user);

  $name = "Surface Pro";
  $products = $user->products()->whereRaw('name like ?',array("%$name%"))->get();
  dd($products);
});

Route::get('/reviews', function () {
  $reviews = Review::all();
  //dd($reviews);
  foreach ($reviews as $review){
    echo "review: . $review->review <br>";
    $user = User::find($review->user_id);
    echo "User: .  $user->name<br>";
    $prod = Product::find($review->product_id);
    echo "Product Id: . $prod->name <br>";
    echo "Rating: .$review->rating <br>";
    //echo "Created at: .$review->created_at <br>";
    echo "<br><br>";
  }
});

Route::get('/reviewsFromProd/{id}', function ($id) {
  $product = Product::find($id);
  //$reviews = $product->user; // products user has reviewed
  $reviews = Review::whereRaw('product_id = ?',array($id))->get();
  
  echo "product: . $product->name <br>";

  foreach ($reviews as $review){
    $user = User::find($review->user_id);
    echo "User: .  $user->name<br>";
    $prod = Product::find($review->product_id);
    echo "Product Id: . $prod->name <br>";
    echo "review: . $review->review <br>";
    echo "Rating: .$review->rating <br>";
    //echo "Created at: .$review->created_at <br>";
    echo "<br><br>";
  }

});


Route::get('/votes', function () {
  $votes = Vote::all();
  //dd($votes);
  foreach ($votes as $vote){
    echo "Vote ID: {$vote->id} <br><br>";
    echo "Review ID: {$vote->review->user->id} <br>";
    echo "Reviewer Name: {$vote->review->user->name} <br>";
    echo "Comments: {$vote->review->review} <br>";

    echo "Voter ID:  {$vote->user_id} <br>";
    echo "Voter Name: {$vote->user->name} <br>";
    if($vote->vote == 1){
      echo "Vote : 👍";
    }else{
      echo "Vote : 👎";
    }
    echo "<br><br>";
    echo "Product ID: {$vote->review->product_id} <br>";
    echo "<hr>";
    echo "<br><br>";
  }
});

Route::get('/votes1', function () {
  $votes = Vote::all();
  //dd($votes);
  foreach ($votes as $vote){
    $var1 = $vote->review->user->id;
    $var2 = $vote->review->user->name;
    $var3 = $vote->review->review;
    $var4 = $vote->review->user_id;
    $var5 = $vote->user->name;
    echo "Review ID: $var1 <br>";
    echo "Reviewer Name: $var2 <br>";
    echo "Comments: $var3 <br>";

    echo "Voter ID:  $var4 <br>";
    echo "Voter Name: $var5 <br>";
    if($vote->vote == 1){
      echo "Vote : 👍";
    }else{
      echo "Vote : 👎";
    }
    echo "<hr>";
    echo "<br><br>";
  }
});

Route::get('/votes0', function () {
  $votes = Vote::all();
  //dd($votes);
  foreach ($votes as $vote){
    echo "Review ID:  {{$vote->review->user->id}} <br>";
    echo "Reviewer Name:  {{$vote->review->user->name}} <br>";
    echo "Comments:  {{$vote->review->review}} <br>";

    echo "Voter ID:  {{$vote->review->user_id}} <br>";
    echo "Voter Name:  {{$vote->user->name}} <br>";
    if($vote->vote == 1){
      echo "Vote : 👍";
    }else{
      echo "Vote : 👎";
    }
    echo "<hr>";
    echo "<br><br>";
  } 
});

// https://s2921450.elf.ict.griffith.edu.au/webAppDev/week9(20)/review/public/follow
Route::get('/follow', function () {
  $follows = Follow::all();
  //dd($votes);
  foreach ($follows as $follow){
    echo "User Name:  {$follow->user->name} follows {$follow->follows->name} <br>";
    echo "<br><br>";
  } 
});

Route::get('/follow', function () {
  $follows = Follow::all();
  //dd($votes);
  foreach ($follows as $follow){
    echo "User Name:  {$follow->user->name} follows {$follow->follows->name} <br>";
    echo "<br><br>";
  } 
});

// https://s2921450.elf.ict.griffith.edu.au/webAppDev/week9(20)/review/public/follow2
Route::get('/follow2', function () {
  $users = User::all();
  foreach($users as $user){
    $id = $user->id;
    $following = Follow::whereHas('user',function($query)use($id){
      return $query->whereRaw('user_id = ?',array($id));
    })->get();
    echo "{$user->name} is following:<br>";
    foreach($following as $follow){
      echo "<ul>";
        echo "<li>{$follow->follows->name}</li>";
      echo "</ul>";
    }
  }
});

Route::get('/follow3', function () {
  $users = User::all();
  foreach($users as $user){
    // $id = $user->id;
    // $following = Follow::whereHas('user',function($query)use($id){
    //   return $query->whereRaw('user_id = ?',array($id));
    // })->get();
    echo "{$user->name} is following:<br>";
    foreach($user->following as $follow){
      if(is_null($follow)){
        echo "<p>Not following anyone</p>";
      }else{
        echo "<ul>";
        echo "<li>{$follow->name}</li>";
        echo "</ul>";
      }
    }
  }
});