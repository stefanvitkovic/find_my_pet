@extends('layouts.app')

<style>

nav {
    display:none !important;
}

</style>

<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>


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

                                <br>

                                <div id="note" class="text-start m-3">
                                    {{-- <i>
                                        Hi there! My name is {{ $pet->nickname }}!
                                        <br>
                                        Somehow i manage to lost myself . Here is mine and my owner contact informations.
                                        You can call them or notify them via email of mine location by clicking on green button bellow.
                                    </i> --}}
                                    <i>
                                        Pozdrav! Moje ime je {{ $pet->nickname }}!
                                        <br>
                                        Nekako sam uspeo da se izgubim. Ovde se nalaze sve potrebne informacije za moj povratak kuci !
                                        Mozete pozvati ili obavestiti mog vlasnika o lokaciji na kojoj se nalazim putem mejla, tako sto ce te kliknuti na zeleno dugme ispod.
                                    </i>
                                </div>
                                <div id="owners_note" class="text-end m-3">
                                    @if($pet->note)
                                    {{-- <i>Here is a note from my owner: 
                                        <br>
                                        {{ $pet->note }}
                                    </i> --}}
                                    <i>Ovo je poruka mog vlasnika: 
                                        <br>
                                        {{ $pet->note }}
                                    </i>
                                    @endif
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-xs-12 ">
                            <div class="form-group">
                                <label for="name">Ime</label>
                                <input disabled value="{{ $pet->name }}" type="text" class="form-control" id="name" name="name" >
                            </div>
                            @if($pet->owner->share_name)
                            <div class="form-group">
                                <label for="owner">Vlasnik</label>
                                <input disabled value="{{ $pet->owner->name }}" type="text" class="form-control" id="owner" name="owner" >
                            </div>
                            @endif
                            @if($pet->owner->share_contact)
                            <div class="form-group">
                                <label for="owner_phone">Kontakt</label>
                                <input disabled value="{{ $pet->owner->phone_nummber }}" type="text" class="form-control" id="owner_phone" name="owner_phone" >
                            </div>
                            @endif
                            @if($pet->owner->share_address)
                            <div class="form-group">
                                <label for="address">Adresa</label>
                                <input disabled value="{{ $pet->owner->address }}, {{ $pet->owner->city }}" type="text" class="form-control" id="address" name="address" >
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="row text-center mt-3 mb-4">

                        <div class="col w-100 d-grid gap-2">
                            <button type="button" class="btn btn-success w-100" onclick="getLocation()" id="demo">
                                Obavesti vlasnika o lokaciji
                            </button>
                        {{-- </div>

                        <div class="col w-100"> --}}
                            <button id="full_profile_button" href="full_profile" type="button" class="btn btn-outline-success w-100" data-bs-toggle="collapse" data-bs-target="#full_profile">
                                Profil
                            </button>
                        </div>

                    </div>
                    
                    <div id="success_msg" class="alert alert-success alert-dismissible fade d-none" role="alert">
                        <strong>Hvala!</strong> Uspesno ste poslali email vlasniku ljubimca.
                        <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                    @if($pet->owner->share_address)
                    <div id="map" class="row mapouter show text-center mx-auto">
                        <div class="gmap_canvas mx-auto">
                            <iframe width="100%" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q={{ $pet->owner->address }}&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
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
                    @endif

                    <div class="row collapse mt-4" id="full_profile">
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
                                <input disabled value="{{ $pet->owner->address }}" type="text" class="form-control" id="address" name="address" >
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
                                <label for="dob">Datum rodjenja</label>
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
                                <label for="health_issues">Zdravstveni problemi</label>
                                <input disabled value="{{ $pet->health_issues }}" type="text" class="form-control" id="health_issues" name="health_issues" >
                            </div>
                            <div class="form-group">
                                <label for="therapy">Terapija</label>
                                <input disabled value="{{ $pet->therapy }}" type="text" class="form-control" id="therapy" name="therapy" >
                            </div>
                            <div class="form-group">
                                <label for="food_type">Tip hrane</label>
                                <select disabled class="form-select" id="food_type" name="food_type" >
                                    <option value="{{ $pet->food_type }}">{{ $pet->food }}</option>
                                </select>
                            </div>
                            @if($pet->owner->share_vet_info)
                            <div class="form-group">
                                <label for="vet_name">Veterinar</label>
                                <input disabled value="{{ $pet->vet_name }}" type="text" class="form-control" id="vet_name" name="vet_name" >
                            </div>
                            <div class="form-group">
                                <label for="vet_contact">Veterinar kontakt</label>
                                <input disabled value="{{ $pet->vet_contact }}" type="text" class="form-control" id="vet_contact" name="vet_contact" >
                            </div>
                            @endif
                            @if($pet->owner->share_other_contact)
                            <div class="form-group">
                                <label for="other_emergency_contacts">Drugi kontakt</label>
                                <input disabled value="{{ $pet->other_emergency_contacts }}" type="text" class="form-control" id="other_emergency_contacts" name="other_emergency_contacts" >
                            </div>
                            @endif
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
                    <div class="col-md-12 mt-3" style="width:100%;height:50px !important;background-image: url({{ asset('images/sape_niz.png') }});background-size: contain;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
  
  <!-- Modal -->
  <div class="modal fade" data-backdrop="static" data-keyboard="false" id="askForNumber" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
            <p>
                Da li zelite da prosledite Vas broj telefona vlasniku ljubimca, kako bi vas kontaktirao ?
            </p>
            <div class="form-group">
                <input type="number" class="form-control" id="founder_phone" placeholder="06********" name="founder_phone" >
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Zatvori</button>
          <button id="sendNumber" class="btn btn-outline-success">Posalji</button>
        </div>
      </div>
    </div>
  </div>

<script>

var x = document.getElementById("demo");
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
        $('#demo').prop('disabled',true);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }

    const successCallback = (position) => {
        $('#demo').prop('disabled',true);
    };

    const errorCallback = (error) => {
        // alert("We can't send location to this pet owner. Please allow location access.")
        alert("Ne mozemo da posaljemo lokaciju vlasniku ovog ljubimca. Molimo vas omogucite pristup lokaciji.")
    };

    navigator.geolocation.getCurrentPosition(successCallback, errorCallback);

}

let email_sent = 0;

function showPosition(position) {

    let latitude = position.coords.latitude;
    let longitude = position.coords.longitude;

    // let src = "https://maps.google.com/maps?q="+latitude+"%20"+longitude+"&t=&z=13&ie=UTF8&iwloc=&output=embed";

    // $('#gmap_canvas').attr("src",src);
    // $('#map').removeClass('d-none');
    // console.log(position.coords.latitude,position.coords.longitude);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    if(!email_sent)
    {
        // console.log('sending email');

        $.ajax({
            type: 'POST',
            url: '<?= url('pet_founded'); ?>',
            data: { 
                'lat': position.coords.latitude, 
                'long': position.coords.longitude,
                'email': "{{ $pet->owner->email }}",
                'token': "{{ $pet->id }}"
            },
            success: function(data){
                if(data.code == 200)
                {

                    $('#success_msg').removeClass('d-none').addClass('show');

                    $('#askForNumber').modal('show');

                }
            }
        });

        email_sent = 1;

    }

}

$(document).ready(function(){

    $('#askForNumber').modal({backdrop: 'static', keyboard: false},'show')

    $('#full_profile_button').click(function(event){
        //prevent the default action for the click event
        event.preventDefault();

        //get the full url - like mysitecom/index.htm#home
        var trgt = $(this).attr('href');

        //get the top offset of the target anchor
        var target_offset = $("#"+trgt).offset();
        var target_top = target_offset.top - 15;

        // console.log(target_top);

        //goto that anchor by setting the body scroll top to anchor top
        $('html, body').animate({scrollTop:target_top}, 500);
    });

    $('#sendNumber').click(function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        let founder_phone = $('#founder_phone').val();

        if(!founder_phone)
        {
            founder_phone = prompt('Molimo vas unesite broj telefon.');
        }
        // console.log(founder_phone,'sending number');

        $.ajax({
            type: 'POST',
            url: '<?= url('send_number'); ?>',
            data: { 
                'founder_phone': founder_phone, 
                'email': "{{ $pet->owner->email }}"
            },
            success: function(data){
                if(data.code == 200)
                {
                    // console.log(data);

                    $('#askForNumber').modal('hide');

                }
            }
        });

    });
    
});
</script>
@endsection
