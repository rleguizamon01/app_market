@extends('layout')

@section('title', 'My Apps')

@section('container')
    <div class="container d-flex flex-wrap justify-content-around">

    @if($apps->count() > 0)
    @foreach($apps as $app)
      <!--  @if($current_category == null 
             || (Auth::user()->role == 'client' && $app->apps->category == $current_category)
             || (Auth::user()->role == 'developer' && $app->category == $current_category)) -->
             
            <div class="card mb-4 mt-4 shadow p-3 mb-5 bg-white rounded" style="width: 18rem;">
                
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
                <div class="card-body">
                    <h5 class="card-title">
                        @if(Auth::user()->role == 'client')
                            {{ $app->apps->name }}
                        @else
                            {{ $app->name }}
                        @endif
                    </h5>

                    <p class="card-text">
                        @if(Auth::user()->role == 'client')
                            ${{ $app->apps->price }}
                        @else
                            ${{ $app->price }}
                        @endif
                    </p>

                </div>
                <div class="card-body">
                    @if(Auth::user()->role == 'client')
                        <a href="{{ route('details', $app->apps->app_id) }} " class="card-link">Details</a>
                    @else
                        <a href="{{ route('details', $app->app_id) }} " class="card-link">Details</a>
                    @endif
                    

                </div>
            </div>
        @endif
    @endforeach
    @endif

    </div>
    

    <div class="d-flex justify-content-center">
    {{ $apps->links('pagination::bootstrap-4') }}
    </div>
@endsection