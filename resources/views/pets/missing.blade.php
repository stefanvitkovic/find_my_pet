@extends('layouts.app')
    
@section('content')
<div class="container ">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class='row'>
        @foreach ($pets as $pet)
        <div class="col-md-4 mb-3 text-center">
            <div class="card mx-auto" style="width: 18rem;">
                @if($pet->image)
                    <img class="rounded-circle shadow-lg p-1 bg-body rounded float-left m-auto my-3" style="width: 250px !important;height: 250px !important; object-fit: cover;object-position: 100% 0;" alt="avatar2" src="{{ asset('images/'.$pet->image->url) }}" />
                @else
                    <img class="rounded-circle shadow-lg p-1 bg-body rounded float-left m-auto my-3" style="width: 250px !important;height: 250px !important; object-fit: cover;object-position: 100% 0;" alt="avatar2" src="{{ asset('images/default.png') }}" />
                @endif
                <div class="card-body border-top align-top mx-auto" 
                style="height:100px;display: flex; flex-flow: column nowrap; justify-content: center;" >
                    <h5 class="card-title m-0">
                        {{ $pet->name }}
                    </h5>
                </div>
            </div>
        </div>
        @endforeach
        </div>

        
</div>
@endsection
