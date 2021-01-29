@extends('layout')

@section('title', 'Upload App')

@section('container')
    <div class="container">
        <form action="{{ route('dev.post') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mt-3">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name">
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" class="form-control" name="price">
            </div>
            <div class="form-group">
            <label for="category">Category</label> <br>
                <select class="custom-select" name="category">
                    @foreach($categories as $category)
                        <option value="{{ $category->name }}"> {{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="image">Photo</label>    
                <input type="file" class="form-control" name="image">
            </div>
                <button type="submit" class="btn btn-primary">Submit</button>
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