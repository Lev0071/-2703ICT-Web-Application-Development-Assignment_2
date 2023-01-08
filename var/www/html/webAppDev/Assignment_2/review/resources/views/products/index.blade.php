@extends('layouts.master')

@section('heading')
    Home Page
@endsection

@section('paneContent')
@endsection
        
 @section('mainContent')                          
               
              <div id="vehicles">
                <p><?php echo "array.length(): " , count($products)?></p>
                
                @foreach ($products as $product)
                <div class="vehicle">
                          <div class="vehicle_image">
                            <img src="{{ $product->image }}" width="200" height=auto>
                          </div>
                    <div class="vehicle_details">
                            <div class="vehicle_rego">
                              <p>{{ $product->name }}</p>
                            </div>
                        <a href="{{ url("product/$product->id") }}" class="btn btn-primary" role="button">View</a>
                    </div>
                </div>
                @endforeach


              </div>

              
@endsection  
