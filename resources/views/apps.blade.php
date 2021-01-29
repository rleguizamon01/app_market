@extends('layout')

@section('title', 'Apps')

@section('container')

    <!-- Category button -->

    <div class="d-flex dropdown ml-4 mt-4 justify-content-center">
    <button class="btn btn-lg btn-secondary dropdown-toggle" type="button" id="categoryButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Categories 
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="{{ route('apps') }}"> All ({{ $totalapps->count() }})</a>
        @foreach($categories as $category)
            <a class="dropdown-item" href="{{ route('category', $category->name) }}"> {{ $category->name}} ({{ $totalapps->where('category', $category->name)->count() }}) </a>
        @endforeach
    </div>
    </div>

    <!-- App cards -->

    <div class="container d-flex flex-wrap justify-content-around">
        @foreach($apps as $app)
            <div class="card mb-4 mt-4 shadow p-3 mb-5 bg-white rounded" style="width: 18rem;">
                @if($app->photo == "")
                <img src="https://via.placeholder.com/253x169" class="card-img-top img-thumbnail" alt="...">
                @else
                <img src="{{asset('images')}}/{{$app->photo}}" class="img-thumbnail" />
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $app->name }}</h5>
                    <p class="card-text">${{ $app->price}}</p>
                </div>
                <div class="card-body">
                    <a href="{{ route('details', $app->app_id) }}" class="card-link">Details</a> 
                </div>
            </div>         
        @endforeach
    </div>

    <!-- Pagination button -->

   
        <div class="d-flex justify-content-center">
        {{ $apps->links('pagination::bootstrap-4') }}
        </div>

@endsection

