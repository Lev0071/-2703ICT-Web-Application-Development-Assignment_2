
@extends('layouts.master')

@section('heading')
    New Gadget
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
            <h2>Edit Gadget</h2>

            <p>
          	<caption>Update gadget details</caption>
    <form method="POST" action="{{ url('product/$product->id') }}">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <input type="hidden" name="itemId" value="{{$product->id}}">
            <label> Name </label>
            <input type="text" name="name" size=30 value="{{ old('name') }}"> <br><br>
            <label> Image </label>
            <input type="text" name="image" size=30 placeholder="Add Imgae url" value="{{$product->image}}"> <br><br>
            <label> URL </label>
            <input type="text" name="url" size=30 value="{{ old('url') }}"> <br><br>
            <label> Description </label>
            <textarea  name="description" size=30 rows="3" value="{{ old('description') }}"> {{$product->description}} </textarea><br><br>
            <label> Price </label>
            <input type="text" name="price" size=10 value="{{ old('price') }}"><br><br>	
            <label> Brand </label>
            <select name="brand">
            <!-- <option value="0"> None </option> -->
            <option value="0"> NONE Here </option>
            @foreach($manufacturers as $man)
                @if($man->id == $product->manufacturer_id)
                    <option value="{{$man->id}}" selected>{{$man->name}}</option>
                @else
                    <option value="{{$man->id}}"> {{$man->name}} </option>
                @endif
            @endforeach
            </select> <br><br>
            <label> Another Brand </label>
            <input type="text" name="brand2" size=13 placeholder="Add Manufacturer"> <br><br>
            <input type="submit" name="submit" value="Update">
            <input type="reset"  name="reset"  value="Reset">
        </form>

</div>

            <!-- Boooking Form :::-->

@endsection          