@extends('layout')

@section('title', 'Wishlist')

@section('container')
<div class="container">
    <table class="table">
    <thead>
        <tr>
        <th scope="col">Name</th>
        <th scope="col">Category</th>
        <th scope="col">Price</th>
        <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <!-- Shows data from apps that client added to wishlist -->
        @foreach($clientApps as $clientApp)
            <tr>
                <th scope="row"> {{ $clientApp->apps->name }} </th>
                <td> {{ $clientApp->apps->category }}  </td>
                <td> {{ $clientApp->apps->price }}  </td>
                <td> 
                     <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                     
                    <!-- Buy app button -->
                    <button class="btn btn-primary mr-3 " type="submit" id="buyButton" value="{{ $clientApp->apps->app_id }}">Buy</button>
                    
                    <!-- Delete from wishlist button -->
                    <button class="btn btn-danger mr-3 " type="submit" id="deleteApp" value="{{ $clientApp->apps->app_id }}">Delete</button>
                </td>
            </tr>
        @endforeach
    </tbody>
    </table>
</div> 

<!-- AJAX requests to controller --> 
<script>
    $('#buyButton').click(function(){
        var appid = $('#buyButton').val();
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

    $('#deleteApp').click(function(){
        var appid = $('#deleteApp').val();
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