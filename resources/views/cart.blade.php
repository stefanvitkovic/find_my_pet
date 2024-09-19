@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if ($message = Session::get('success'))
                <div class="row">
                    <p class="">{{ $message }}</p>
                </div>
            @endif
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="card">
            <div class="card-header">
                <span>Korpa</span>
            </div>
        <div class="card-body table-responsive">

            <table class="table table-hover table-bordered bg-white table-responsive text-center align-middle text-dark">
                <form action="{{ route('cart.finish') }}" method="POST" class="d-inline">
                    @csrf
                    <thead>
                        <tr class="">
                            {{-- <th scope="col">Slika</th> --}}
                            <th scope="col">Naziv</th>
                            <th scope="col">Kolicina</th>
                            <th scope="col">Cena po komadu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartItems as $item)
                            <tr>
                                {{-- <td class="">
                                    <a href="#">
                                        <img src="{{ $item->attributes->image }}" class="p-3"
                                            style="width:150px;height:150px;margin:auto" alt="Thumbnail">
                                    </a>
                                </td> --}}
                                <td>
                                    <a href="{{ route('products.product') }}">
                                        <p class="">{{ $item->name }}</p>
                                    </a>
                                </td>
                                <td>
                                    <input type="number" min='1' class="border text-center w-100" name="quantity"
                                        value="{{ $item->quantity }}" id="quantity">
                                </td>
                                <td class="">
                                    <span class="" id="price" data-value="{{ $item->price }}">
                                        {{ $item->price }} rsd
                                    </span>
                                </td>

                            </tr>
                        @endforeach

                    </tbody>
            </table>

            <div>
                <h1 style="font-size: 20px">
                    <b>
                        Ukupno: <span id="total"> {{ Cart::getTotal() }}</span> rsd
                    </b>
                </h1>
            </div>

            <div class="row m-0 row-cols-md-3 row-cols-xs-1 row-cols-sm-1 row-cols-1" id="">
                {{-- <h3>Korisnicki podaci</h3> --}}
                <div class="col">
                    <div class="form-group">
                        <label for="name">Ime</label>
                        <input required value="{{ old('name') }}" type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Prezime</label>
                        <input required value="{{ old('last_name') }}" type="text" class="form-control" id="last_name" name="last_name">
                    </div>
                    <div class="form-group">
                        <label for="phone">Telefon</label>
                        <input required value="{{ old('phone') }}" type="phone" class="form-control" id="phone" name="phone">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input required value="{{ old('email') }}" type="email" class="form-control" id="email" name="email">
                    </div>

                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="address">Adresa</label>
                        <input required value="{{ old('address') }}" type="text" class="form-control" id="address" name="address">
                    </div>
                    <div class="form-group">
                        <label for="city">Grad</label>
                        <input required value="{{ old('city') }}" type="text" class="form-control" id="city" name="city">
                    </div>
                    <div class="form-group">
                        <label for="postcode">Postanski broj</label>
                        <input required value="{{ old('postcode') }}" type="text" class="form-control" id="postcode" name="postcode">
                    </div>
                    <div class="form-group">
                        <label for="note">Dodatno</label>
                        <input value="{{ old('note') }}" type="text" class="form-control" id="note" name="note">
                    </div>

                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="pet_name">Ime ljubimca</label>
                        <input required value="{{ old('pet_name') }}" type="text" class="form-control" id="pet_name" name="pet_name">
                    </div>
                    <div class="form-group">
                        <label for="type">Tip ljubimca</label>
                        <input required value="{{ old('type') }}" type="text" class="form-control" id="type" name="type" placeholder="Pas/Macka..">
                    </div>
                </div>
            </div>



            <div class="d-grid gap-2 d-md-block mt-3 ml-0 p-0 d-inline">
                <button type="submit" class="btn btn-outline-success w-100">Poruci</button>
                
            </div>
            </form>

            <div class="d-grid gap-2 d-md-block mt-3 ml-0 p-0 d-inline">
            <form action="{{ route('cart.clear') }}" method="POST" class="mt-3 ml-0 p-0">
                @csrf
                <button type="submit" class="btn btn-outline-danger w-100">Otkazi</button>
            </form>
            </div>

            
        </div>
        <div>
        </div>

    </div>



    </div>


    <script>
        $(document).ready(function() {

            $('#quantity').on("keyup change", function(e) {
                let quantity = $(this).val();
                let price = $('#price').data('value');

                $('#total').text(quantity * price);
            });

        });
    </script>
@endsection
