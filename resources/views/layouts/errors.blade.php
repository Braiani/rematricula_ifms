@if(count($errors))
    <div class="row">
        <div class="alert alert-danger flash-message" role="alert">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    </div>
@endif