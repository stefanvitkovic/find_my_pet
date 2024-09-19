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

                    <div class="row">
                        <div class="col-12 text-center col col-sm-12 col-xs-12 ">
                            <div class="form-group">
                                @if($pet->image)
                                    <img class="rounded-circle shadow-lg p-1 bg-body rounded float-left m-2" style="width: 250px !important;height: 250px !important; object-fit: cover;object-position: 100% 0;" alt="avatar2" src="{{ asset('images/'.$pet->image->url) }}" />
                                @else
                                    <img class="rounded-circle shadow-lg p-1 bg-body rounded float-left m-2" style="width: 250px !important;height: 250px !important; object-fit: cover;object-position: 100% 0;" alt="avatar2" src="{{ asset('images/default.png') }}" />
                                @endif
                            </div>
                        </div>
                    </div>
                    <form action="#">
                        <div class="row mt-4">
                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Ime</label>
                                    <input disabled value="{{ $pet->name }}" type="text" class="form-control" id="name" name="name" >
                                </div>
                                <div class="form-group">
                                    <label for="nickname">Nadimak</label>
                                    <input disabled value="{{ $pet->nickname }}" type="text" class="form-control" id="nickname" name="nickname" >
                                </div>
                                <div class="form-group">
                                    <label for="address">Adresa</label>
                                    <input disabled value="{{ $pet->address }}" type="text" class="form-control" id="address" name="address" >
                                </div>
                                <div class="form-group">
                                    <label for="type">Tip</label>
                                    <select disabled class="form-select" id="type" name="type" >
                                        <option value="{{ $pet->type }}">{{ $pet->animalType }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="breed">Rasa</label>
                                    <input disabled value="{{ $pet->breed }}" type="text" class="form-control" id="breed" name="breed" >
                                </div>
                                <div class="form-group">
                                    <label for="gender">Pol</label>
                                    <select disabled class="form-select" id="gender" name="gender" >
                                        <option value="{{ $pet->gender }}">{{ ($pet->gender == '1') ? 'Muski' : 'Zenski' }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="dob">Datum Rodjenja</label>
                                    <input disabled value="{{ $pet->dob }}" type="date" class="form-control" id="dob" name="dob" >
                                </div>
                                <div class="form-group">
                                    <label for="height">Visina (cm)</label>
                                    <input disabled value="{{ $pet->height }}" type="number" class="form-control" id="height" name="height" >
                                </div>
                                <div class="form-group">
                                    <label for="weight">Tezina (g)</label>
                                    <input disabled value="{{ $pet->weight }}" type="number" class="form-control" id="weight" name="weight" >
                                </div>
                                <div class="form-group">
                                    <label for="color">Boja</label>
                                    <input disabled value="{{ $pet->color }}" type="text" class="form-control" id="color" name="color" >
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="allergies">Alergije</label>
                                    <input disabled value="{{ $pet->allergies }}" type="text" class="form-control" id="allergies" name="allergies" >
                                </div>
                                <div class="form-group">
                                    <label for="health_issues">Zdravstveni Problemi</label>
                                    <input disabled value="{{ $pet->health_issues }}" type="text" class="form-control" id="health_issues" name="health_issues" >
                                </div>
                                <div class="form-group">
                                    <label for="therapy">Terapija</label>
                                    <input disabled value="{{ $pet->therapy }}" type="text" class="form-control" id="therapy" name="therapy" >
                                </div>
                                <div class="form-group">
                                    <label for="food_type">Hrana</label>
                                    <select disabled class="form-select" id="food_type" name="food_type" >
                                        <option value="{{ $pet->food_type }}">{{ $pet->food }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="vet_name">Veterinar</label>
                                    <input disabled value="{{ $pet->vet_name }}" type="text" class="form-control" id="vet_name" name="vet_name" >
                                </div>
                                <div class="form-group">
                                    <label for="vet_contact">Veterinar Kontakt</label>
                                    <input disabled value="{{ $pet->vet_contact }}" type="text" class="form-control" id="vet_contact" name="vet_contact" >
                                </div>
                                <div class="form-group">
                                    <label for="other_emergency_contacts">Drugi Kontakt</label>
                                    <input disabled value="{{ $pet->other_emergency_contacts }}" type="text" class="form-control" id="other_emergency_contacts" name="other_emergency_contacts" >
                                </div>
                                <div class="form-group">
                                    {{-- <label for="reward_fee">Reward</label> --}}
                                    <input disabled value="{{ $pet->reward }}" {{ ($pet->reward) ? 'checked' : '' }} type="checkbox" value="1" id="reward" name="reward" >
                                    <label for="reward">Nagrada</label>
                                    <input disabled value="{{ $pet->reward_fee }}" type="text" class="form-control" id="reward_fee" name="reward_fee" >
                                </div>
                                <div class="form-group">
                                    <label for="note">Dodatno</label>
                                    <input disabled value="{{ $pet->note }}" type="text" class="form-control" id="note" name="note" >
                                </div>
                                <div class="form-group mt-3">
                                    <div class="row">
                                        <div class="col">
                                            <input disabled value="{{ $pet->puppy }}" {{ ($pet->puppy) ? 'checked' : '' }} type="checkbox" id="puppy" name="puppy" >
                                            <label for="puppy">Stene</label><br>
                                            
                                            <input disabled value="{{ $pet->sterilised }}" {{ ($pet->sterilised) ? 'checked' : ''}} type="checkbox" value="1" id="sterilised" name="sterilised" >
                                            <label for="sterilised">Sterilisan</label><br>
                                        </div>
                                        <div class="col">
                                            <input disabled value="{{ $pet->vaccinated }}" {{ ($pet->vaccinated) ? 'checked' : '' }} type="checkbox" value="1" id="vaccinated" name="vaccinated" >
                                            <label for="vaccinated">Vakcinisan</label><br>

                                            <input disabled value="{{ $pet->socialized }}" {{ ($pet->socialized) ? 'checked' : '' }} type="checkbox" value="1" id="socialized" name="socialized" >
                                            <label for="socialized">Socijalizovan</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-12 mt-3" style="width:100%;height:50px !important;background-image: url({{ asset('images/sape_niz.png') }});background-size: contain;">
            </div>
            <div class="card mt-3">
                <div class="row g-0">
                  <div class="col-md-3">
                    <div class="card-body text-white bg-success">
                        <h5 class="card-title text-center m-0">Istorija</h5>
                        <p class="card-text"></p>
                    </div>
                    <ul class="list-group list-group-flush" role="tablist">
                        @if($tag_history)
                        @foreach($tag_history as $point)
                            <li class="history_point list-group-item list-group-item-action" data-bs-toggle="list" data-lat="{{ $point->latitude }}" data-long="{{ $point->longitude }}" data-id="{{ $point->id }}">
                                
                                    {{ $point->created_at }}
                                
                            </li>
                        @endforeach
                        @endif
                    </ul>
                  </div>
                  <div class="col-md-9">
                    <div id="map" class="mapouter show text-center mx-auto">
                        <div class="gmap_canvas mx-auto">
                            <iframe width="100%" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q={{ $pet->owner->address }}&Vojvode%20Stepe%20545&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
                            </iframe>
                            <a href="https://123movies-to.org">
                            </a>
                            <br>
                            <style>.mapouter{position:relative;height:500px;width:100%;}
                            </style>
                            <a href="https://www.embedgooglemap.net">
                            </a>
                            <style>.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:100%;}</style>
                        </div>
                    </div>
                  </div>
                </div>
              </div>

        </div>
    </div>
</div>
<script>
$(document).ready(function(){

   $('.history_point').click(function(e)
   {

        let lat = $(this).data('lat');
        let long = $(this).data('long');
        
        let src = "https://maps.google.com/maps?q="+lat+"%20"+long+"&t=&z=13&ie=UTF8&iwloc=&output=embed";

        $('#gmap_canvas').attr("src",src);

   });
    
});
</script>
@endsection
