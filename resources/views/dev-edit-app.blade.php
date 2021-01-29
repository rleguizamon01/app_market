@extends('layout')

@section('title', 'Edit App')

@section('container')

<div class="container">
    <div class="mt-3 mb-3">
     <h1> {{ $app->name }} </h1>
    </div>

    <!-- Dev changes price and/or photo from app -->
    <form action="{{ route('dev.update', $app->app_id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @METHOD('PUT')
        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" value="{{ $app->price }}"class="form-control" name="price">
        </div>
        <div class="form-group">
            <label for="image">Photo</label>    
            <input type="file" class="form-control" name="image">
        </div>
            <button type="submit" class="btn btn-warning">Submit</button>
    </form>

    @if ($errors->any())
    <div class="alert alert-danger mt-3">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if(session('status'))
        <div class="alert alert-success mt-3" role="alert">
            {{ session('status')}}
        </div>
    @endif
</div>
@endsection