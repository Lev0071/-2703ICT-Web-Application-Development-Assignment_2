<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Manufacturer;
use App\Models\Review;
use App\Models\Vote;
use App\Models\User;
use App\Models\Follow;
use DB;
use Illuminate\Support\Facades\Auth;
//use App\Models\Vote;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Product::all();
        return view('products.index')->with('products',$products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::check()){
            return view("products.create_item_form")->with('manufacturers',Manufacturer::all());
        }else{
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

   
            $this->validate($request, [
                'name' => 'required|max:255|unique:products,name',
                'price' => 'required|numeric',
                'url' => 'nullable|url',
             ]);
  


        //
        //dd("Store function");
        $brand = $request->brand;
        $brand2 = $request->brand2;
        $image = "https://icon-library.com/images/no-image-icon/no-image-icon-0.jpg";

        //dd($request->brand);

        
        //dd(isset($request->brand2));
        //dd($request->brand2);
        if( (isset($request->image)) ){
            $image = $request->image;
        }

        if( (isset($request->name)) && (isset($image)) && (isset($request->price)) ){
            
                if($brand != 0){
                    //dd($brand);
                    $product = new Product();
                    $product->name = $request->name;
                    $product->price = $request->price;
                    $product->image = $image;
                    $product->manufacturer_id = $request->brand;
                    if(isset($request->url)){
                        $product->url = $request->url;
                    }else{
                        $product->url = "";
                    }
                    if(isset($request->description)){
                        $product->description = $request->description;
                    }else{
                        $product->description = "";
                    }
                    $product->save();
                    return redirect("product/$product->id");
                }
                else if($brand == 0 && (isset($request->brand2)) ){
                    //dd($brand2);
                    $manufacturerExists = Manufacturer::whereRaw('name = ?',array($request->brand2))->first();
                    if(!empty($manufacturerExists)){
                        $product = new Product();
                        $product->name = $request->name;
                        $product->price = $request->price;
                        $product->image = $image;
                        if(isset($request->url)){
                            $product->url = $request->url;
                        }else{
                            $product->url  = "";
                        }
                        if(isset($request->description)){
                            $product->description = $request->description;
                        }else{
                            $product->description = "";
                        }
                        $product->manufacturer()->associate($manufacturerExists);
                        $product->save();
                        return redirect("product/$product->id");
                    }else{
                        $manufacturer = new Manufacturer();
                        $manufacturer->name = $request->brand2;
                        $manufacturer->save();
                        $product = new Product();
                        $product->name = $request->name;
                        $product->price = $request->price;
                        $product->image = $image;
                        if(isset($request->url)){
                            $product->url = $request->url;
                        }else{
                            $product->url  = "";
                        }
                        if(isset($request->description)){
                            $product->description = $request->description;
                        }else{
                            $product->description = "";
                        }
                        $product->manufacturer()->associate($manufacturer);
                        $product->save();
                        return redirect("product/$product->id");
                    }
                }
                else {
                    dd("ERROR_1");
                }

        }else{
            dd("ERROR_2");
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $product = Product::find($id);
        $manufacturer = Product::find($id)->manufacturer;
        $reviews = Review::whereRaw('product_id = ?',array($id))->get();
        //dd($reviews);
        $votes = [];
        $results = [];
        //foreach($reviews as $review){
            //$votes = Vote::whereRaw('review_id = ?',array($review->id))->get();
            $votes = Vote::whereHas('review',function($query)use($id){
                return $query->whereRaw('product_id = ?',array($id));
            })->get();
            //$results = DB::select("select votes.id,votes.vote,votes.created_at,votes.updated_at,votes.user_id,votes.review_id,products.id as prod_id from votes,reviews,products where votes.review_id = reviews.id and reviews.product_id = $id");
            //dd($results);
        //}
        //dd($votes);
        return view('products.show')->with('product',$product)->with('reviews',$reviews)->with('votes',$votes)->with('results',$results);
        //return view('products.show')->with('product',product)->with('manufacturer',manufacturer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //dd("at edit");
        //dd($id);
        if(Auth::user()->type == "Moderator"){
            $product = Product::find($id);
            return view('products.edit_item_form')->with('product',$product)->with('manufacturers',Manufacturer::all());
        }else{
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd("at update");

        if(!empty($request->url)){
            $this->validate($request, [
                //|unique:products,name
                'name' => 'required|max:255',
                'price' => 'required|numeric',
                'url' => 'url',
             ]);
        }else{
            $this->validate($request, [
                'name' => 'required|max:255|unique:products,name',
                'price' => 'required|numeric',
             ]);
        }

        $brand = $request->brand;
        $brand2 = $request->brand2;
        $name = $request->name;
        $image = "https://icon-library.com/images/no-image-icon/no-image-icon-0.jpg";
        $price = $request->price;
        $itemId = $request->itemId;

        $input = array();
        $input = [];

        if( (isset($request->image)) ){
            $image = $request->image;
        }

        if( (isset($request->name)) && (isset($image)) && (isset($request->price)) ){
            
                if($brand != 0){
                    $input = [$brand,$name,$image,$price,$itemId];
                    //dd($input);
                    //dd($brand);
                    $product = Product::find($itemId);
                    $product->name = $request->name;
                    $product->price = $request->price;
                    $product->image = $image;
                    $product->manufacturer_id = $request->brand;
                    if(isset($request->url)){
                        $product->url = $request->url;
                    }
                    if(isset($request->description)){
                        $product->description = $request->description;
                    }else{
                        $product->description = "";
                    }
                    $product->save();
                    return redirect("product/$product->id");
                }
                else if($brand == 0 && (isset($request->brand2)) ){
                    $input = [$brand2,$name,$image,$price,$itemId];
                    //dd($input);
                    //dd($brand2);
                    $manufacturer = Manufacturer::whereRaw('name = ?', array($brand2))->first();
                    if(!(is_null($manufacturer))){
                        //dd($manufacturer->id);
                        $product = Product::find($itemId);
                        //dd($product->id);
                        $product->name = $request->name;
                        $product->price = $request->price;
                        $product->image = $image;
                        if(isset($request->url)){
                            $product->url = $request->url;
                        }
                        if(isset($request->description)){
                            $product->description = $request->description;
                        }else{
                            $product->description = "";
                        }
                        $product->manufacturer()->associate($manufacturer);
                        $product->save();
                        return redirect("product/$product->id");
                    }else{
                        //dd("FAIL");
                        $manufacturer = new Manufacturer();
                        $manufacturer->name = $request->brand2;
                        $manufacturer->save();
                        $product = Product::find($itemId);
                        $product->name = $request->name;
                        $product->price = $request->price;
                        $product->image = $image;
                        if(isset($request->url)){
                            $product->url = $request->url;
                        }
                        if(isset($request->description)){
                            $product->description = $request->description;
                        }else{
                            $product->description = "";
                        }
                        $product->manufacturer()->associate($manufacturer);
                        $product->save();
                        return redirect("product/$product->id");
                    }
                }
                else {
                    dd("ERROR_1");
                }

        }else{
            dd("ERROR_2");
        }
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        //dd("at destroy");
        if(Auth::user()->type == "Moderator"){
            $reviews = Review::where('product_id', '=', $id)->get();
            
            if($reviews != NULL){
                foreach($reviews as $review){
                    //dd($review);

                    $votes = Vote::where('review_id','=',$review->id)->get();
                    if(count($votes) != 0){
                        foreach($votes as $vote){
                            $vote->delete();
                        }
                    }

                    $review->delete();
                }
            }

            $product = Product::find($id);
            $product->delete();
            return redirect("product");
        }else{
            return redirect()->back();
        }

        
    }

    /**
     * Show the form for creating a new item review.
     *
     * 
     */
    public function reviewProduct($id)
    {
        if(Auth::guest()){
            return redirect()->back();
        }else{
            $canReview = false;
            //dd('Review Product Route');
            //dd($id);
            $currentUser_id = 4;
            $product = Product::find($id);
            $record = DB::select("select * from reviews where user_id = $currentUser_id and product_id = $id");
            //$record = DB::select('select * from reviews where user_id = 6 and product_id = 4');
            if (empty($record)){
                return view('products.review_item_form')->with('product',$product);
            }else{
                return redirect("product/$id");
            }
            
            //dd($product);
            return view('products.review_item_form')->with('product',$product);
        }
    }

    /**
     * Retrive form data for creating a new item review.
     *
     * 
     */
    public function create_review_product(Request $request){

        $this->validate($request, [
            'review' => 'required|min:5',
            'rating' => 'required|numeric|between:1,5',
         ]);

        $id = $request->prod_id;
        $review = new Review();
        $review->review = $request->review;
        $review->user_id = $request->uid;
        $review->product_id = $request->prod_id;
        $review->rating = $request->rating;
        $review->save();
        return redirect("product/$id");
    }

    /**
     * Show the form for updating an existing item review.
     *
     * 
     */
    public function edit_review_product($id){

        $review = Review::find($id);
        
        if(Auth::check()){
            if((Auth::user()->id == $review->user->id) || (Auth::user()->type == 'Moderator')){
                //dd($review->user->id);
                return view('products.edit_review_form')->with('review',$review);
            }
            
        }else{return redirect()->back();}

        // }

        // //dd('edit_review_product');
        // $review = Review::find($id);
        // //dd($review);
        // return view('products.edit_review_form')->with('review',$review);
    }

    /**
     * Retrieve form data submitted for updating an existing item review.
     *
     * 
     */
    public function update_review(Request $request){

        $this->validate($request, [
            'review' => 'required|min:5',
            'rating' => 'required|numeric|between:1,5',
         ]);
    
        $reviewRecord = Review::find($request->review_id);

        if( (isset($request->review)) && (isset($request->rating))  ){//##############
            
                $reviewRecord->review = $request->review;
                $reviewRecord->rating = $request->rating;
                $reviewRecord->save();
            }
            else {
                dd("Bullshit");
            }//##############
        
        return redirect("product/$request->prod_id");
    }

    /**
     * Deleting an existing review via a POST request from a button.
     *
     * 
     */
    public function delete_review($id){

        $review = Review::find($id);

        if(Auth::check()){
            if((Auth::user()->id == $review->user->id) || (Auth::user()->type == 'Moderator')){//--
                //dd($review->user->id);
                $votes = Vote::where('review_id','=',$id)->get();
                if(count($votes) != 0){
                    foreach($votes as $vote){
                        $vote->delete();
                    }
                }
        
                
                $prod_id = $review->product_id;
        
                $review->delete();
                return redirect("product/$prod_id");
            }//--
            
        }else{return redirect()->back();}


    }

    /**
     * Voting "Like" or "Unlike" for existing review submited via a POST request form.
     *
     * 
     */
    public function review_like_dislike(Request $request){

        if(Auth::guest()){
            return redirect("product/$request->prod_id");
        }else{
            
            //$votes = DB::select("SELECT * FROM votes WHERE user_id = $request->userID AND review_id = $request->reviewID");
            $voteRecord = Vote::whereRaw("user_id = $request->userID AND review_id = $request->reviewID")->first();
            if (!(empty($voteRecord))){
                //dd("You have mail");
                if($voteRecord->vote == $request->vote_input){
                    $vote = Vote::find($voteRecord->id);
                    $vote->delete();
                }else{
                    $vote = Vote::find($voteRecord->id);
                    $vote->vote = $request->vote_input;
                    $vote->save();
                }
            }else{
                //dd("Empty");
                $vote = new Vote();
                $vote->vote = $request->vote_input;
                $vote->user_id = $request->userID;
                $vote->review_id = $request->reviewID;
                $vote->save();
            }
            return redirect("product/$request->prod_id");
            //dd($votes);
            // $input = $request->all();
            // dd($input);
            // "vote_input" => "1"
            // "prod_id" => "4"
            // "reviewID" => "3"
            // "userID" => "6"
        }
    }

    /**
     * Show page to display all user in the database via get request.
     *
     * 
     */
    public function show_users()
    {
        //
        $users = User::all();
        //dd("All Users page");
        return view('products.show_users')->with('users',$users);
    }

    /**
     * Function to follow or unfollow a user by the logged in user.
     *
     * 
     */
    public function follow_unfollow(Request $request){

        if(Auth::guest()){
            //dd("Can not follow or unfollow");
            return redirect()->back();
        }else{
            
            $input = $request->all();
            //dd($input);
            // "_token" => "LhppH4qG0QtxE967WEwopj4RQiFBVWdxCmXIjBaD"
            // "uid" => "5"
            // "follower_id" => "2"
            $followRecord = Follow::whereRaw("user_id = $request->follower_id AND following = $request->uid")->first();
            if (!(empty($followRecord))){
                    $followRecord->delete();
            }else{
                $follow = new Follow();
                $follow->user_id = $request->follower_id;
                $follow->following = $request->uid;
                $follow->save();
            }
            return redirect()->back();
            // $input = $request->all();
            // dd($input);
        }
    }
}


