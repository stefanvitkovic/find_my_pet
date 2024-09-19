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

@keyframes glowing {
    0% {
        background-color: red;
        box-shadow: 0 0 5px red;
    }
    50% {
        background-color: white;
        box-shadow: 0 0 20px white;
    }
    100% {
        background-color: red;
        box-shadow: 0 0 5px red;
    }
    }
.missing_button {
animation: glowing 1300ms infinite;
}

</style>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">  
                    <span>Ljubimci</span>
                </div>

                <div class="card-body table-responsive">
                    @if(Auth::user()->admin || Auth::user()->superadmin)
                        <a class="btn btn-outline-success btn-sm float-right mb-3" href="{{ route('pets.create') }}">Novi Ljubimac</a> 
                    @endif
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div style="width:100%;height:50px !important;opacity:0.3;background-image: url({{ asset("/images/sape_niz.png")}});background-size: contain;"></div> 

                    <table class="table table-striped table-hover table-responsive text-center align-middle mt-1">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Ime</th>
                        <th scope="col">Vlasnik</th>
                        <th scope="col">Tip</th>
                        <th scope="col">Opcije</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pets as $pet)
                            <tr>
                                <th scope="row">{{ $pet->id }}</th>
                                <td>{{ $pet->name }}</td>
                                <td>{{ $pet->owner->name }}</td>
                                <td>{{ $pet->animalType }}</td>
                                
                                <td class='text-center options_td'>
                                    @if(Auth::user()->admin || Auth::user()->superadmin)
                                        <a data-toggle="tooltip" title="Prikaži" class="btn btn-outline-primary btn-sm" href="{{ route('pets.show',['pet' => $pet->id]) }}"><i class="fa fa-eye" ></i></a>
                                        <a data-toggle="tooltip" title="Promeni" class="btn btn-outline-warning btn-sm" href="{{ route('pets.edit',['pet' => $pet->id]) }}"><i class="fa fa-edit"></i></a>
                                        <a data-toggle="tooltip" title="Kopiraj" href="#" data-token="{{"http://" . request()->getHttpHost() . '/identify/' . $pet->token }}" class="btn btn-outline-secondary btn-sm token" href="{{ route('pets.show',['pet' => $pet->id]) }}"><i class="fa fa-gear"></i></a>
                                        <a data-toggle="tooltip" title="QR" class="btn btn-outline-success btn-sm" href="{{ route('qr',['id' => $pet->id]) }}"><i class="fa fa-image"></i></a>
                                        <form data-toggle="tooltip" title="Obriši" onClick="return confirm('Da li ste sigurni? Informacije će biti trajno obrisane!')" class="m-0" style="display: inline-block;" action="{{ route('pets.destroy',['pet' => $pet->id]) }}" method="post">
                                            <button class="btn btn-outline-danger btn-sm " type="submit"><i class="fa fa-trash"></i></button>
                                            <input type="hidden" name="_method" value="delete" />
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        </form>
                                        <form data-toggle="tooltip" title="{{ ($pet->missing) ? "Pronađen":"Prijavi Nestanak" }}" onClick="return confirm('Da li ste sigurni? Svi korisnici će biti obavešteni!')" class="m-0" style="display: inline-block;" action="{{ route('pets.set_missing_status') }}" method="post">
                                            <button class="btn btn-outline-dark btn-sm {{ ($pet->missing) ? "missing_button":"" }}" type="submit"><i class="fa fa-bullhorn"></i></button>
                                            <input type="hidden" name="pet_id" value="{{ $pet->id }}" />
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        </form>
                                        <form data-toggle="tooltip" title="{{ ($pet->status) ? "Deaktiviraj":"Aktiviraj" }}" onClick="return confirm('Da li ste sigurni? Tag će biti {{ ($pet->statis) ? "deaktiviran i niko neće videti profil Vašeg ljubimca" : "aktiviran i svi će moći da vide profil Vašeg ljubimca" }}!')" class="m-0" style="display: inline-block;" action="{{ route('pets.set_status') }}" method="post">
                                            <button class="btn btn-outline-dark btn-sm" type="submit">{!! ($pet->status) ? "<i class='fa fa-toggle-on'></i>" : "<i class='fa fa-toggle-off'></i>" !!}</button>
                                            <input type="hidden" name="pet_id" value="{{ $pet->id }}" />
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        </form>
                                    @elseif(Auth::id() == $pet->user_id)
                                        <a data-toggle="tooltip" title="Prikaži" class="btn btn-outline-primary btn-sm" href="{{ route('pets.show',['pet' => $pet->id]) }}"><i class="fa fa-eye"></i></a>
                                        <a data-toggle="tooltip" title="Promeni" class="btn btn-outline-warning btn-sm" href="{{ route('pets.edit',['pet' => $pet->id]) }}"><i class="fa fa-edit"></i></a>
                                        <form data-toggle="tooltip" title="Obriši" onClick="return confirm('Da li ste sigurni? Informacije će biti trajno obrisane!')" class="m-0" style="display: inline-block;" action="{{ route('pets.destroy',['pet' => $pet->id]) }}" method="post">
                                            <button class="btn btn-outline-danger btn-sm" type="submit"><i class="fa fa-trash"></i></button>
                                            <input type="hidden" name="_method" value="delete" />
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        </form>
                                        <form data-toggle="tooltip" title="{{ ($pet->missing) ? "Pronađen":"Prijavi Nestanak" }}" onClick="return confirm('Da li ste sigurni? Svi korisnici će biti obavešteni!')" class="m-0" style="display: inline-block;" action="{{ route('pets.set_missing_status') }}" method="post">
                                            <button class="btn btn-outline-dark btn-sm {{ ($pet->missing) ? "missing_button":"" }}" type="submit"><i class="fa fa-bullhorn"></i></button>
                                            <input type="hidden" name="pet_id" value="{{ $pet->id }}" />
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        </form>
                                        <form data-toggle="tooltip" title="{{ ($pet->status) ? "Deaktiviraj":"Aktiviraj" }}" onClick="return confirm('Da li ste sigurni? Tag će biti {{ ($pet->statis) ? "deaktiviran i niko neće videti profil Vašeg ljubimca" : "aktiviran i svi će moći da vide profil Vašeg ljubimca" }}!')" class="m-0" style="display: inline-block;" action="{{ route('pets.set_status') }}" method="post">
                                            <button class="btn btn-outline-dark btn-sm" type="submit">{!! ($pet->status) ? "<i class='fa fa-toggle-on'></i>" : "<i class='fa fa-toggle-off'></i>" !!}</button>
                                            <input type="hidden" name="pet_id" value="{{ $pet->id }}" />
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        </form>
                                    @else
                                        <a data-toggle="tooltip" title="Prikaži" class="btn btn-outline-primary btn-sm" href="{{ route('pets.show',['pet' => $pet->id]) }}"><i class="fa fa-eye"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
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
