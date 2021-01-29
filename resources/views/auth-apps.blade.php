@extends('layout')

@section('title', 'My Apps')

@section('container')
    <div class="container d-flex flex-wrap justify-content-around">

    <!-- Shows all apps that clients bought or devs created -->
    @if($apps->count() > 0)
    @foreach($apps as $app)
             
            <div class="card mb-4 mt-4 shadow p-3 mb-5 bg-white rounded" style="width: 18rem;">
                
                <!-- App Photo -->
                @if(Auth::user()->role == 'client')
                    @if($app->apps->photo == "")
                        <img src="https://via.placeholder.com/253x169" class="card-img-top img-thumbnail" alt="...">
                    @else
                        <img src="{{asset('images')}}/{{$app->apps->photo}}" class="img-thumbnail" />
                    @endif
                @else
                @if($app->photo == "")
                        <img src="https://via.placeholder.com/253x169" class="card-img-top img-thumbnail" alt="...">
                    @else
                        <img src="{{asset('images')}}/{{$app->photo}}" class="img-thumbnail" />
                    @endif
                @endif

                <!-- App name -->
                <div class="card-body">
                    <h5 class="card-title">
                        @if(Auth::user()->role == 'client')
                            {{ $app->apps->name }}
                        @else
                            {{ $app->name }}
                        @endif
                    </h5>

                    <!-- App price -->
                    <p class="card-text">
                        @if(Auth::user()->role == 'client')
                            ${{ $app->apps->price }}
                        @else
                            ${{ $app->price }}
                        @endif
                    </p>

                </div>

                <!-- Link to detailed app -->
                <div class="card-body">
                    @if(Auth::user()->role == 'client')
                        <a href="{{ route('details', $app->apps->app_id) }} " class="card-link">Details</a>
                    @else
                        <a href="{{ route('details', $app->app_id) }} " class="card-link">Details</a>
                    @endif
                    

                </div>
            </div>
    @endforeach
    @endif

    </div>
    
    <!-- Pagination button -->
    <div class="d-flex justify-content-center">
    {{ $apps->links('pagination::bootstrap-4') }}
    </div>
@endsection