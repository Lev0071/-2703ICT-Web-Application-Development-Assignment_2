
@extends('layouts.master')

@section('heading')
    Review Product
@endsection

@section('paneContent')
@endsection
        
 @section('mainContent')

 @if (count($errors) > 0 )
  <div class="alert">
    <ul>
      @foreach ($errors->all() as $error)
        <li> {{ $error }} </li>
      @endforeach
    </ul>
  </div>
 @endif
                                                                      
            <!--::: Boooking Form -->

            <div class="content">
            <h2> Edit Review </h2>

            <p>
          	<caption>Personal details form</caption>
    <form method="POST" action='{{ url("product/update_review") }}'>
            {{csrf_field()}}
            
            <label> Review </label>
            <textarea  name="review" size=30 rows="3" value="{{ $review->review }}"> {{ old('review') }} </textarea><br><br>
            <label> Rate the Product </label>
            <select name="rating">
            @for($i = 1; $i <= 5; $i++)
                @if($review->rating == $i)
                    <option value="{{$i}}" selected>{{$i}}</option>
                @else
                    <option value="{{$i}}"> {{$i}} </option>
                @endif
            @endfor
            </select> <br><br>
            <input type="hidden" name="prod_id" value="{{ $review->product_id }}">
            <input type="hidden" name="uid" value="{{Auth::user()->id}}">
            <input type="hidden" name="review_id" value="{{ $review->id }}">
            <input type="submit" name="submit" value="Update">
            <input type="reset"  name="reset"  value="Reset">
      </form>

</div>

            <!-- Boooking Form :::-->

@endsection          