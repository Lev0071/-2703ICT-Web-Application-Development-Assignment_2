
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
            <h2>Review {{ $product->name }}</h2>

            <p>
          	<caption>Personal details form</caption>
    <form method="POST" action='{{ url("product/review_item") }}'>
            {{csrf_field()}}
            
            <label> Review </label>
            <textarea  name="review" size=30 rows="3" value="{{ old('review') }}"> {{ old('review') }} </textarea><br><br>
            <label> Rate the Product </label>
            <select name="rating">
            <option value=0 selected hidden>Choose Rating</option>
            <option value="1"> 1 </option>
            <option value="2"> 2 </option>
            <option value="3"> 3 </option>
            <option value="4"> 4 </option>
            <option value="5"> 5 </option>
            </select> <br><br>
            <input type="hidden" name="prod_id" value="{{ $product->id }}">
            <input type="hidden" name="uid" value="{{Auth::user()->id}}">
            <input type="submit" name="submit" value="Add">
            <input type="reset"  name="reset"  value="Reset">
      </form>

</div>

            <!-- Boooking Form :::-->

@endsection          