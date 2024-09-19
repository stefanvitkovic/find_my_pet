@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

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
                        <div class="row">
                            <div class="col-12 text-center col col-sm-12 col-xs-12 ">
                                <div class="form-group">
                                    @if ($pet->image)
                                        <img class="rounded-circle shadow-lg p-1 bg-body rounded float-left m-2"
                                            style="width: 250px !important;height: 250px !important; object-fit: cover;object-position: 100% 0;"
                                            alt="avatar2" src="{{ asset('images/' . $pet->image->url) }}" />
                                    @else
                                        <img class="rounded-circle shadow-lg p-1 bg-body rounded float-left m-2"
                                            style="width: 250px !important;height: 250px !important; object-fit: cover;object-position: 100% 0;"
                                            alt="avatar2" src="{{ asset('images/default.png') }}" />
                                    @endif
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('pets.update', ['pet' => $pet->id]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mt-4">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="user_id">Vlasnik</label>
                                        @if (Auth::user()->admin || Auth::user()->superadmin)
                                            <select class="form-select" id="user_id" name="user_id">
                                                @foreach ($owners as $user)
                                                    <option {{ $user->id == $pet->user_id ? 'selected' : '' }}
                                                        value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        @else
                                            <select disabled class="form-select">
                                                <option selected disabled>{{ $pet->owner->name }}</option>
                                            </select>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Ime</label>
                                        <input value="{{ $pet->name }}" type="text" class="form-control"
                                            id="name" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="nickname">Nadimak</label>
                                        <input value="{{ $pet->nickname }}" type="text" class="form-control"
                                            id="nickname" name="nickname">
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Adresa</label>
                                        <input value="{{ $pet->owner->address }}" type="text" class="form-control"
                                            id="address" name="address">
                                    </div>
                                    <div class="form-group">
                                        <label for="type">Tip</label>
                                        <select class="form-select" id="type" name="type">
                                            @foreach ($animals as $animal)
                                                <option value="{{ $animal->id }}"
                                                    {{ $animal->id == $pet->type ? 'selected' : '' }}>
                                                    {{ $animal->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="breed">Rasa</label>
                                        <input value="{{ $pet->breed }}" type="text" class="form-control"
                                            id="breed" name="breed">
                                    </div>
                                    <div class="form-group">
                                        <label for="gender">Pol</label>
                                        <select class="form-select" id="gender" name="gender">
                                            <option value="1" {{ $pet->gender == '1' ? 'selected' : '' }}>Muski
                                            </option>
                                            <option value="2" {{ $pet->gender == '2' ? 'selected' : '' }}>Zenski
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="dob">Datum Rodjenja</label>
                                        <input value="{{ $pet->dob }}" type="date" class="form-control"
                                            id="dob" name="dob">
                                    </div>
                                    <div class="form-group">
                                        <label for="height">Visina (cm)</label>
                                        <input value="{{ $pet->height }}" type="number" class="form-control"
                                            id="height" name="height">
                                    </div>
                                    <div class="form-group">
                                        <label for="weight">Tezina (g)</label>
                                        <input value="{{ $pet->weight }}" type="number" class="form-control"
                                            id="weight" name="weight">
                                    </div>
                                    <div class="form-group">
                                        <label for="color">Boja</label>
                                        <input value="{{ $pet->color }}" type="text" class="form-control"
                                            id="color" name="color">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="allergies">Alergije</label>
                                        <input value="{{ $pet->allergies }}" type="text" class="form-control"
                                            id="allergies" name="allergies">
                                    </div>
                                    <div class="form-group">
                                        <label for="health_issues">Zdravstveni Problemi</label>
                                        <input value="{{ $pet->health_issues }}" type="text" class="form-control"
                                            id="health_issues" name="health_issues">
                                    </div>
                                    <div class="form-group">
                                        <label for="therapy">Terapija</label>
                                        <input value="{{ $pet->therapy }}" type="text" class="form-control"
                                            id="therapy" name="therapy">
                                    </div>
                                    <div class="form-group">
                                        <label for="food_type">Tip Hrane</label>
                                        <select class="form-select" id="food_type" name="food_type">
                                            <option value="1" {{ $pet->food_type == '1' ? 'selected' : '' }}>
                                                Ljudska Hrana</option>
                                            <option value="2" {{ $pet->food_type == '2' ? 'selected' : '' }}>
                                                Granule</option>
                                            <option value="3" {{ $pet->food_type == '3' ? 'selected' : '' }}>Miks
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="vet_name">Veterinar</label>
                                        <input value="{{ $pet->vet_name }}" type="text" class="form-control"
                                            id="vet_name" name="vet_name">
                                    </div>
                                    <div class="form-group">
                                        <label for="vet_contact">Veterinar Kontakt</label>
                                        <input value="{{ $pet->vet_contact }}" type="text" class="form-control"
                                            id="vet_contact" name="vet_contact">
                                    </div>
                                    <div class="form-group">
                                        <label for="other_emergency_contacts">Drugi Kontakt</label>
                                        <input value="{{ $pet->other_emergency_contacts }}" type="text"
                                            class="form-control" id="other_emergency_contacts"
                                            name="other_emergency_contacts">
                                    </div>
                                    <div class="form-group">
                                        {{-- <label for="reward_fee">Reward</label> --}}
                                        <input value="{{ $pet->reward }}" {{ $pet->reward ? 'checked' : '' }}
                                            type="checkbox" value="1" id="reward" name="reward">
                                        <label for="reward">Nagrada</label>
                                        <input value="{{ $pet->reward_fee }}" type="text" class="form-control"
                                            id="reward_fee" name="reward_fee">
                                    </div>
                                    <div class="form-group">
                                        <label for="note">Dodatno</label>
                                        <input value="{{ $pet->note }}" type="text" class="form-control"
                                            id="note" name="note">
                                    </div>
                                    <div class="form-group mt-4">
                                        <div class="row">
                                            <div class="col">
                                                <input {{ $pet->puppy ? 'checked' : '' }} type="checkbox"
                                                    id="puppy" name="puppy">
                                                <label for="puppy">Stene</label><br>

                                                <input {{ $pet->sterilised ? 'checked' : '' }} type="checkbox"
                                                    id="sterilised" name="sterilised">
                                                <label for="sterilised">Sterilisan</label><br>
                                            </div>
                                            <div class="col">
                                                <input {{ $pet->vaccinated ? 'checked' : '' }} type="checkbox"
                                                    id="vaccinated" name="vaccinated">
                                                <label for="vaccinated">Vakcinisan</label><br>

                                                <input {{ $pet->socialized ? 'checked' : '' }} type="checkbox"
                                                    id="socialized" name="socialized">
                                                <label for="socialized">Socijalizovan</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="image">Slika</label>
                                        <input type="file" name="image" id="image" style="width: -webkit-fill-available;">
                                    </div>
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
        $(document).ready(function() {



        });
    </script>
@endsection
