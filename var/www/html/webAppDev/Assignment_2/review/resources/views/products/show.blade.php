
@extends('layouts.master')

@section('heading')
  Detail Page
@endsection

@section('paneContent')
@endsection
      
@section('mainContent')                                                                    


            <div id="vehicles">


              <div class="vehicle">
                <div class="vehicle_image">
                <img src="{{$product->image}}" width="200" height=auto>
                </div>
                <div class="vehicle_details">
                  <div class="vehicle_rego">
                    <p>{{ $product->name }}</p>
                  </div>
                  <div class="vehicle_description">
                    <p>$ {{ $product->price }}</p>
                    <p>Manufacturer: {{ $product->manufacturer->name }}</p>
                  </div>
                  <div class="vehicle_description">
                    <p> Description</p><br>
                    <p> {{ $product->description }}</p>
                  </div>
                  @if(!empty($product->url))
                    <hr>
                  <div class="vehicle_description">
                  <a href="{{ $product->url }}">See More</a>
                  </div>
                  <hr>
                  @endif

                </div>
                <div class="btn-group">
                  <a href="{{ url('product') }}" class="btn btn-primary" role="button">HOME</a>
                  @auth
                  @if(Auth::user()->type == "Moderator")
                  <form method="GET" action="{{ url("product/$product->id/edit") }}">
                  <input type="submit" class="btn btn-primary" role="button" value="EDIT">
                  </form>
                  <form method="POST" action="{{ url("product/$product->id") }}">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                    <input type="submit" class="btn btn-primary" role="button" value="DELETE">
                  </form>
                  @endif
                  @endauth
                  
                  @auth
                  <a href="{{ url("product/review_item/$product->id") }}" class="btn btn-primary" role="button">Review Product</a>
                  @endauth
                </div>

              </div>
              
             





            </div>

            <div id="bookingHeading">
                  <p>Reviews</p>
            </div>

            @forelse($reviews as $review)
            <?php
                $like = 0;
                $dislike = 0;

                foreach($votes as $vote){
                  if($vote->review_id == $review->id){
                    if($vote->vote == 1){
                      $like++;
                    }else{$dislike++;}
                  }else{
                    $like = 1;
                    $dislike = 0;
                  }
                }
            ?>
                <div class="{{ ($dislike>$like) ? 'bookingFail' : 'booking'; }}">
                  <div class="booking_details">
                    <div class="vehicle_description">
                      <p>Reviewed by: {{ $review->user->name }}</p>
                      <p>Rating: {{ $review->rating }}</p>
                    </div>
                    <div class="vehicle_description">
                      <p>Comments: {{ $review->review }}</p>
                      <p>Date Reviewed: {{ $review->updated_at }}</p>
                    </div>
                    <hr>

                    <form method="POST" action="{{url('product/vote_review')}}">
                    {{csrf_field()}}
                    <input type="hidden" name="vote_input" value="1">
                    <input type="hidden" name="prod_id" value="{{$review->product->id}}">
                    <input type="hidden" name="reviewID" value="{{$review->id}}">
                    @auth
                    <input type="hidden" name="userID" value="{{Auth::user()->id}}">
                    @else
                    <input type="hidden" name="userID" value="0">
                    @endauth
                    <input type="submit" class="btn btn-primary" role="button" value="👍">
                    </form>

                    <form method="POST"action="{{url('product/vote_review')}}">
                    {{csrf_field()}}
                    <input type="hidden" name="vote_input" value="0">
                    <input type="hidden" name="prod_id" value="{{$review->product->id}}">
                    <input type="hidden" name="reviewID" value="{{$review->id}}">
                    @auth
                    <input type="hidden" name="userID" value="{{Auth::user()->id}}">
                    @else
                    <input type="hidden" name="userID" value="0">
                    @endauth
                    <input type="submit" class="btn btn-primary" role="button" value="👎">
                    </form>
                      
                      
                    <br>
                    <hr>
                    @auth
                    @if(($review->user_id == Auth::user()->id) || Auth::user()->type == "Moderator")
                    <form method="GET" action="{{ url("product/$review->id/edit_review_form") }}">
                    <input type="submit" class="btn btn-primary" role="button" value="Edit">
                    </form>
                    <form method="POST" action="{{ url("product/delete_review/$review->id") }}">
                    {{csrf_field()}}
                    <input type="submit" class="btn btn-primary" role="button" value="Delete">
                  </form>
                    @endif
                    @endauth
                    <form method="POST" action="{{url('product/follow_unfollow')}}">
                    {{csrf_field()}}
                    <input type="hidden" name="uid" value="{{$review->user->id}}">
                    @auth
                    <input type="hidden" name="follower_id" value="{{Auth::user()->id}}">
                    @else
                    <input type="hidden" name="follower_id" value="0">
                    @endauth
                    <input type="submit" class="btn btn-primary" role="button" value="Follow/Unfollow {{$review->user->name}}">
                    </form>
                  </div>
                </div>
            @empty
                <div class="booking">
                      <p>No no reviews for this product</p>
                </div>
            @endforelse
@endsection


<?php

// <div id="bookingHeading">
// <p>Bookings</p>
// </div>


// @forelse($bookings as $booking)
// <div class="booking">
// <div class="booking_details">
//   <div class="vehicle_rego">
//     <p>Name: {{ $booking->Name }}</p>
//     <p>Lisence No.: {{ $booking->LisenceNo }}</p>
//   </div>
//   <div class="vehicle_description">
//     <p>Pick-up date: {{ $booking->Pickup }}</p>
//     <p>Return date: {{ $booking->Dropoff }}</p>
//   </div>
//   <a href="{{ url("returnVehicle/$booking->Booking_id") }}" class="btn btn-primary" role="button">Return Vehicle</a>
// </div>
// </div>
// @empty
// <div class="booking">
//     <p>No bookings for {{$vehicle->Rego}}</p>
// </div>
// @endforelse


?>