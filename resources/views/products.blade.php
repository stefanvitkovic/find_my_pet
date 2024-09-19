@extends('layouts.app')
    
@section('content')
<div class="container text-center mx-auto">
        {{-- <h3 class="">Our Product</h3> --}}
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        @foreach ($products as $product)
            <div class="card text-center mx-auto" style="width: 18rem;">
                <img class="card-img-top p-3" src="{{ asset('images/sapa.png') }}" style="object-fit: cover;object-position: 100% 0;" alt="Card image cap">
                <div class="card-body border-top mt-3 ">
                    <h5 class="card-title">
                        <a href="{{ route('products.product') }}" style="text-decoration: none;font-size:28px !important;color:orange">
                        {{ $product->name }}
                        </a>
                    </h5>
                    <p>{{ $product->price }} rsd</p>
                    <p class="card-text">{{ $product->description }}</p>
                    <form action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ $product->id }}" name="id">
                        <input type="hidden" value="{{ $product->name }}" name="name">
                        <input type="hidden" value="{{ $product->price }}" name="price">
                        <input type="hidden" value="{{ $product->image }}"  name="image">
                        <input type="hidden" value="1" name="quantity">
                        <button type="submit" class="btn btn-outline-success">Dodaj u korpu</button>
                    </form>
                </div>
            </div>
        @endforeach


        
</div>
@endsection
