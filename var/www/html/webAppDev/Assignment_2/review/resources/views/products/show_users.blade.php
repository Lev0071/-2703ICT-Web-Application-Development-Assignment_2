
@extends('layouts.master')

@section('heading')
  All Users
@endsection

@section('paneContent')
@endsection
      
@section('mainContent')                                                                    


@forelse($users as $user)
                <div class="booking">
                  <div class="booking_details">
                      <div class="vehicle_rego">
                        <p>User: #{{ $user->id }}</p>
                      </div>
                    <div class="vehicle_description">
                      <p>User Name: {{ $user->name }}</p>
                      <p>Type: {{ $user->type }}</p>
                    </div>
                    <div class="vehicle_description">
                      <p>Following:</p>
                      @forelse($user->following as $follow)
                      <ul>
                      <li>{{$follow->name}}</li>
                      </ul>
                      @empty
                      <p>(This user does not follow anyone)</p>
                      @endforelse
                    </div>
                    <hr>
                    <form method="POST" action="{{url('product/follow_unfollow')}}">
                    {{csrf_field()}}
                    <input type="hidden" name="uid" value="{{$user->id}}">
                    @auth
                    <input type="hidden" name="follower_id" value="{{Auth::user()->id}}">
                    @else
                    <input type="hidden" name="follower_id" value="0">
                    @endauth
                    <input type="submit" class="btn btn-primary" role="button" value="Follow/Unfollow {{$user->name}}">
                    </form>
                    
                  </div>
                </div>
            @empty
                <div class="booking">
                      <p>No Users on this page</p>
                </div>
            @endforelse
@endsection