@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Izmene</div>

                <div class="card-body">
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
                    <form action="{{ route('users.update',['user'=>$user->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Ime</label>
                                    <input value="{{ $user->name }}" type="text" class="form-control" id="name" name="name" >
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input value="{{ $user->email }}" type="text" class="form-control" id="email" name="email" >
                                </div>
                                <div class="form-group">
                                    <label for="address">Adresa</label>
                                    <input value="{{ $user->address }}" type="text" class="form-control" id="address" name="address" >
                                </div>
                                <div class="form-group">
                                    <label for="city">Grad</label>
                                    <input value="{{ $user->city }}" type="text" class="form-control" id="city" name="city" >
                                </div>
                                <div class="form-group">
                                    <label for="phone_nummber">Telefon</label>
                                    <input value="{{ $user->phone_nummber }}" type="tel" class="form-control" id="phone_nummber" name="phone_nummber" >
                                </div>
                                <div class="form-group">
                                    <label for="notification_type">Tip Notifikacije</label>
                                    <select  class="form-select" id="notification_type" name="notification_type" >
                                        <option value="1" {{ ($user->notification_type == '1') ? 'selected' : '' }}>Email</option>
                                        <option value="2" {{ ($user->notification_type == '2') ? 'selected' : '' }}>SMS</option>
                                        <option value="3" {{ ($user->notification_type == '3') ? 'selected' : '' }}>N/A</option>
                                    </select>
                                </div>
                                <div class="form-group mt-2">
                                    <input value="{{ $user->missing_notification }}" {{ ($user->missing_notification) ? 'checked' : '' }} type="checkbox" value="1" id="missing_notification" name="missing_notification" >
                                    <label for="missing_notification">Notifikacije o izgubljenim Šapama</label>
                                </div>
                                <hr>
                                <i>Podaci koji će biti vidljivi prilikom očitavanja taga</i>
                                <div class="form-group">
                                    <input value="{{ $user->share_name }}" {{ ($user->share_name) ? 'checked' : '' }} type="checkbox" value="1" id="share_name" name="share_name" >
                                    <label for="share_name">Podeli Ime</label>
                                </div>
                                <div class="form-group">
                                    <input value="{{ $user->share_contact }}" {{ ($user->share_contact) ? 'checked' : '' }} type="checkbox" value="1" id="share_contact" name="share_contact" >
                                    <label for="share_contact">Podeli Kontakt Telefon</label>
                                </div>
                                <div class="form-group">
                                    <input value="{{ $user->share_address }}" {{ ($user->share_address) ? 'checked' : '' }} type="checkbox" value="1" id="share_address" name="share_address" >
                                    <label for="share_address">Podeli Adresu</label>
                                </div>
                                <div class="form-group">
                                    <input value="{{ $user->share_other_contact }}" {{ ($user->share_other_contact) ? 'checked' : '' }} type="checkbox" value="1" id="share_other_contact" name="share_other_contact" >
                                    <label for="share_other_contact">Podeli Drugi Kontakt</label>
                                </div>
                                <div class="form-group">
                                    <input value="{{ $user->share_vet_info }}" {{ ($user->share_vet_info) ? 'checked' : '' }} type="checkbox" value="1" id="share_vet_info" name="share_vet_info" >
                                    <label for="share_vet_info">Podeli Informacije Veterinara</label>
                                </div>
                                <hr>
                                @if(Auth::user()->admin)
                                    <div class="form-group">
                                        <label for="token">Token</label>
                                        <input value="{{ $user->remember_token }}" type="text" class="form-control" id="token" name="token" >
                                    </div>
                                
                                    <div class="form-group">
                                        <br>
                                        <input value="{{ $user->admin }}" {{ ($user->admin) ? 'checked' : '' }} type="checkbox" value="1" id="admin" name="admin" >
                                        <label for="admin">Admin</label>
                                    </div>
                                @endif
                            </div>
                            <div class="form-row">
                                <button type="submit" class="btn btn-primary mt-3">Posalji</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){


    
});
</script>
@endsection
