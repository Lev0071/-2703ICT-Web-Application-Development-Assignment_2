
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
            <h2>Add a Gadget</h2>

            <p>
          	<caption>Personal details form</caption>
    <form method="POST" action='{{ url("product") }}'>
            {{csrf_field()}}
            
            <label> Name </label>
            <input type="text" name="name" size=30 value="{{ old('name') }}"> <br><br>
            <label> Image </label>
            <input type="text" name="image" size=30 placeholder="Add Image url"> <br><br>
            <label> URL </label>
            <input type="text" name="url" size=30 value="{{ old('url') }}"> <br><br>
            <label> Description </label>
            <textarea  name="description" size=30 rows="3" value="{{ old('description') }}"> {{ old('description') }} </textarea><br><br>
            <label> Price </label>
            <input type="text" name="price" size=10 value="{{ old('price') }}"><br><br>	
            <label> Brand </label>
            <select name="brand">
            <option value=0 selected hidden>Choose Brand</option>
            <option value=0 >None here</option>
            @foreach($manufacturers as $man)
                      <option value="{{$man->id}}"> {{$man->name}} </option>
            @endforeach
            </select> <br><br>
            <label> Another Brand </label>
            <input type="text" name="brand2" size=13 placeholder="Add Manufacturer"> <br><br>
            <input type="submit" name="submit" value="Add">
            <input type="reset"  name="reset"  value="Reset">
    </form>

</div>

            <!-- Boooking Form :::-->

@endsection          