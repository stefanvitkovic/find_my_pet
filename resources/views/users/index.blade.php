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
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                @if(Auth::user()->admin)
                    <span>Korisnici</span>
                @else
                    <span>Profil</span>
                @endif
                </div>

                <div class="card-body table-responsive">
                @if(Auth::user()->admin || Auth::user()->superadmin)
                <a class="btn btn-outline-success btn-sm float-right mb-3" href="{{ route('users.create') }}">Novi Korisnik</a> 
                @endif
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div style="width:100%;height:50px !important;opacity:0.3;background-image: url({{ asset("images/sape_niz.png") }});background-size: contain;"></div> 

                    <table class="table table-striped table-hover table-responsive text-center align-middle">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Ime</th>
                        <th scope="col">Email</th>
                        <th scope="col">Ljubimci</th>
                        <th scope="col">Opcije</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->pets->count() }}</td>
                            <td class='text-center options_td'>
                                @if(Auth::user()->admin || Auth::user()->superadmin)
                                    <a class="btn btn-outline-primary btn-sm" href="{{ route('users.show',['user' => $user->id]) }}"><i class="fa fa-eye"></i></a>
                                    <a class="btn btn-outline-warning btn-sm" href="{{ route('users.edit',['user' => $user->id]) }}"><i class="fa fa-edit"></i></a>
                                    @if(Auth::id() == $user->id)
                                        <a class="btn btn-outline-dark btn-sm" href="{{ route('change-password') }}"><i class="fa fa-key"></i></a>
                                    @endif
                                    <form onClick="return confirm('are you sure?')" class="m-0" style="display: inline-block;" action="{{ route('users.destroy',['user' => $user->id]) }}" method="post">
                                        <button class='btn btn-outline-danger btn-sm' type="submit"><i class="fa fa-trash"></i> </button>                                     
                                        <input type="hidden" name="_method" value="delete" />
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    </form>
                                @elseif(Auth::id() == $user->id)
                                    <a class="btn btn-outline-primary btn-sm" href="{{ route('users.show',['user' => $user->id]) }}"><i class="fa fa-eye"></i></a>
                                    <a class="btn btn-outline-warning btn-sm" href="{{ route('users.edit',['user' => $user->id]) }}"><i class="fa fa-edit"></i></a>
                                    <a class="btn btn-outline-dark btn-sm" href="{{ route('change-password') }}"><i class="fa fa-key"></i></a>
                                @else
                                    <a class="btn btn-outline-primary btn-sm" href="{{ route('users.show',['user' => $user->id]) }}"><i class="fa fa-eye"></i></a>
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

});
</script>
@endsection
