@extends('layouts.app')

<style>

    .options_td > a,button {
        width: 60px !important;
        margin:5px !important;
    }
    
    .options_td > form > input,button {
        width: 60px !important;
        margin:5px !important;
    }
    
    td > * {
        vertical-align : middle;
    }
    
    </style>
    
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Korisnik</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="#">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Ime</label>
                                    <input disabled value="{{ $user->name }}" type="text" class="form-control" id="name" name="name" >
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input disabled value="{{ $user->email }}" type="text" class="form-control" id="email" name="email" >
                                </div>
                                <div class="form-group">
                                    <label for="address">Adresa</label>
                                    <input disabled value="{{ $user->address }}" type="text" class="form-control" id="address" name="address" >
                                </div>
                                <div class="form-group">
                                    <label for="city">Grad</label>
                                    <input disabled value="{{ $user->city }}" type="text" class="form-control" id="city" name="city" >
                                </div>
                                <div class="form-group">
                                    <label for="phone_nummber">Telefom</label>
                                    <input disabled value="{{ $user->phone_nummber }}" type="text" class="form-control" id="phone_nummber" name="phone_nummber" >
                                </div>
                                <div class="form-group">
                                    <label for="notification_type">Tip Notifikacije</label>
                                    <input disabled value="{{ $user->notification }}" type="text" class="form-control" id="notification_type" name="notification_type" >
                                </div>
                                <div class="form-group mt-2">
                                    <input disabled value="{{ $user->missing_notification }}" {{ ($user->missing_notification) ? 'checked' : '' }} type="checkbox" value="1" id="missing_notification" name="missing_notification" >
                                    <label for="missing_notification">Notifikacije o izgubljenim Šapama</label>
                                </div>
                                <hr>
                                <i>Podaci koji će biti vidljivi prilikom očitavanja taga</i>
                                <div class="form-group">
                                    <input disabled value="{{ $user->share_name }}" {{ ($user->share_name) ? 'checked' : '' }} type="checkbox" value="1" id="share_name" name="share_name" >
                                    <label for="share_name">Podeli Ime</label>
                                </div>
                                <div class="form-group">
                                    <input disabled value="{{ $user->share_contact }}" {{ ($user->share_contact) ? 'checked' : '' }} type="checkbox" value="1" id="share_contact" name="share_contact" >
                                    <label for="share_contact">Podeli Kontakt Telefon</label>
                                </div>
                                <div class="form-group">
                                    <input disabled value="{{ $user->share_address }}" {{ ($user->share_address) ? 'checked' : '' }} type="checkbox" value="1" id="share_address" name="share_address" >
                                    <label for="share_address">Podeli Adresu</label>
                                </div>
                                <div class="form-group">
                                    <input disabled value="{{ $user->share_other_contact }}" {{ ($user->share_other_contact) ? 'checked' : '' }} type="checkbox" value="1" id="share_other_contact" name="share_other_contact" >
                                    <label for="share_other_contact">Podeli Drugi Kontakt</label>
                                </div>
                                <div class="form-group">
                                    <input disabled value="{{ $user->share_vet_info }}" {{ ($user->share_vet_info) ? 'checked' : '' }} type="checkbox" value="1" id="share_vet_info" name="share_vet_info" >
                                    <label for="share_vet_info">Podeli Informacije Veterinara</label>
                                </div>
                                <hr>
                                @if(Auth::user()->admin)
                                    <div class="form-group">
                                        <label for="token">Token</label>
                                        <input disabled value="{{ $user->remember_token }}" type="text" class="form-control" id="token" name="token" >
                                    </div>
                                    <div class="form-group">
                                        <br>
                                        <input disabled value="{{ $user->admin }}" {{ ($user->admin) ? 'checked' : '' }} type="checkbox" value="1" id="admin" name="admin" >
                                        <label for="admin">Is Admin</label>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            @if(Auth::user()->admin)
            <div class="card mt-4">
                <div class="card-header">Ljubimci</div>
                <div class="card-body table-responsive">
                    <table class="table table-striped table-hover table-responsive text-center align-middle">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Ime</th>
                            <th scope="col">Nadimak</th>
                            <th scope="col">Tip</th>
                            <th scope="col">Rasa</th>
                            <th scope="col">Oprije</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($user->pets)
                            @foreach($user->pets as $pet)
                                <tr>
                                    <th scope="row">{{ $pet->id }}</th>
                                    <td>{{ $pet->name }}</td>
                                    <td>{{ $pet->nickname }}</td>
                                    <td>{{ $pet->animalType }}</td>
                                    <td>{{ $pet->breed }}</td>
                                    <td class='text-center options_td'>
                                        @if(Auth::user()->admin)
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('pets.show',['pet' => $pet->id]) }}"><i class="fa fa-eye"></i></a>
                                        <a class="btn btn-outline-warning btn-sm" href="{{ route('pets.edit',['pet' => $pet->id]) }}"><i class="fa fa-edit"></i></a>
                                        <a href="#" data-token="{{"http://www." . request()->getHttpHost() . '/identify/' . $pet->token }}" class="btn btn-outline-dark btn-sm token" href="{{ route('pets.show',['pet' => $pet->id]) }}"><i class="fa fa-gear"></i></a>
                                        <form onClick="return confirm('are you sure?')" class="m-0" style="display: inline-block;" action="{{ route('pets.destroy',['pet' => $pet->id]) }}" method="post">
                                            <button class="btn btn-outline-danger btn-sm" type="submit"><i class="fa fa-trash"></i></button>
                                            <input type="hidden" name="_method" value="delete" />
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        </form>
                                        @elseif(Auth::id() == $pet->user_id)
                                            <a class="btn btn-outline-primary btn-sm" href="{{ route('pets.show',['pet' => $pet->id]) }}"><i class="fa fa-eye"></i></a>
                                            <a class="btn btn-outline-warning btn-sm" href="{{ route('pets.edit',['pet' => $pet->id]) }}"><i class="fa fa-edit"></i></a>
                                        @else
                                            <a class="btn btn-outline-primary btn-sm" href="{{ route('pets.show',['pet' => $pet->id]) }}"><i class="fa fa-eye"></i></a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
<script>
$(document).ready(function(){

    $('.token').click(function(e){
        e.preventDefault();
        let token = $(this).data('token');

        navigator.clipboard.writeText(token);
    })
   
    
});
</script>
@endsection
