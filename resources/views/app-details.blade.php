@extends('layout')

@section('title', 'App details')

@section('container')
<div class="container d-flex flex-wrap justify-content-around" >
    <div class="m-2 card w-100 p-4 ">
        <div class="row ">
            <div class="col-md-3">
            
                @if($app->photo == "")
                    <img src="https://via.placeholder.com/253x169" class="card-img-top img-thumbnail" alt="...">
               @else
                    <img src="{{asset('images')}}/{{$app->photo}}" class="img-thumbnail" />
               @endif
            </div>
            <div class="col-md-9">
                <div class="row">
                    <h1 class=""> {{ $app->name }} </h2>
                </div>
                <div class="row">
                    <h4> {{ $app->category}} </strong>
                </div>
                <div class="row">
                    <strong> ${{ $app->price }} </strong>
                </div>
            </div>
        </div>
        <!-- Client view to buy or add to wish list -->
            @if(Auth::check() && Auth::user()->role == 'client')

                @if($clientBoughtApp)
                    <div class="row mt-3">
                        <div class="d-inline-block alert alert-success" role="alert">
                            It's already bought!
                        </div>
                    </div>
                    
                    <x-delete-button/>

                @elseif($clientAddedWishlist)
                    <div class="row mt-3">
                        <div class="d-inline-block alert alert-success" role="alert">
                            It's already added to the wishlist!
                        </div>
                    </div>

                    <div class="row">
                        <x-buy-button/>
                    </div>

                    <x-delete-button/>
 
                @else
                <div class="row">
                    <x-buy-button/>
                    <x-wishlist-button/>
                </div>
                @endif

            @endif

            <!-- Developer view to delete or edit app -->
        @if(Auth::check() && Auth::user()->role == 'developer' && $app->developer_id == Auth::id())
        <form action="{{ route('dev.delete', $app->app_id) }}" method="POST">
            @METHOD('delete')
            @csrf
            <button type="submit" title="delete"  onclick="return confirm('Are you sure?')" class="btn btn-danger mr-3 mb-2 mt-3"> Delete App</button>
        </form>

        <a href="{{ route('dev.edit', $app->app_id) }}" title="show">
            <strong class="text-warning">Edit</strong>
        </a>
        @endif
    </div>
    
</div>

<script>
    $('#buyButton').click(function(){
        var appid = {{ $app->app_id }};
        var action = 'buy';
        var token = $('#token').val();
        var route = "{{ route('client.buy') }}";
        

        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN': token},
            type: 'POST',
            data:{app_id: appid, actionDone: action},
            success: function(){
                window.location.reload();
            },
            error: function(data){
                console.log(data);
            },
        })
    });

    $('#addToWishList').click(function(){
        var appid = {{ $app->app_id }};
        var action = 'wishlist';
        var token = $('#token').val();
        var route = "{{ route('client.buy') }}";
        

        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN': token},
            type: 'POST',
            data:{app_id: appid, actionDone: action},
            success: function(){
                window.location.reload();
            },
            error: function(data){
                console.log(data);
            },
        })
    });

    $('#deleteClientApp').click(function(){
        var appid = {{ $app->app_id }};
        var token = $('#token').val();
        var route = "{{ route('client.delete') }}";

        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN': token},
            type: 'DELETE',
            data:{app_id: appid},
            success: function(){
                window.location.reload();
            },
            error: function(data){
                console.log(data);
            },
        })
    });

</script>
 
@endsection
