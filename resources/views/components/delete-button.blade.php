<div class="row mt-3">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
    <button class="btn btn-danger mr-3 "  onclick="return confirm('This will cancel your purchase or delete it from your wishlist. Are you sure?')" type="submit" id="deleteClientApp" value="">Delete</button>
</div>