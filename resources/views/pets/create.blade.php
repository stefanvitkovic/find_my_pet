@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create</div>

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
                    <form action="{{ route('pets.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col">
                                @if(Auth::user()->admin || Auth::user()->superadmin)

                                <div class="form-group">
                                    <label for="user_id">Owner</label>
                                    <select class="form-select" id="user_id" name="user_id">
                                        <option selected disabled>Select owner</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                @endif
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" >
                                </div>
                                <div class="form-group">
                                    <label for="nickname">Nickname</label>
                                    <input type="text" class="form-control" id="nickname" name="nickname" value="{{ old('nickname') }}" >
                                </div>
                                <div class="form-group">
                                    <label for="type">Type</label>
                                    <select class="form-select" id="type" name="type" value="{{ old('type') }}" >
                                        <option selected disabled>Select</option>
                                        @foreach($animals as $animal)
                                            <option value="{{ $animal->id }}" {{ old('type') == $animal->id ? 'selected' : '' }}>{{ $animal->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="breed">Breed</label>
                                    <input type="text" class="form-control" id="breed" name="breed" value="{{ old('breed') }}" >
                                </div>
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select class="form-select" id="gender" name="gender" value="{{ old('gender') }}" >
                                        <option selected disabled>Select</option>
                                        <option value="1" {{ old('gender') == 1 ? 'selected' : '' }}>Male</option>
                                        <option value="2" {{ old('gender') == 2 ? 'selected' : '' }}>Female</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="dob">Date of birth</label>
                                    <input type="date" class="form-control" id="dob" name="dob" value="{{ old('dob') }}" >
                                </div>
                                <div class="form-group">
                                    <label for="height">Height (cm)</label>
                                    <input type="number" class="form-control" id="height" name="height" value="{{ old('height') }}" >
                                </div>
                                <div class="form-group">
                                    <label for="weight">Weight (g)</label>
                                    <input type="number" class="form-control" id="weight" name="weight" value="{{ old('weight') }}" >
                                </div>
                                <div class="form-group">
                                    <label for="color">Color</label>
                                    <input type="text" class="form-control" id="color" name="color" value="{{ old('color') }}" >
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="allergies">Allergies</label>
                                    <input type="text" class="form-control" id="allergies" name="allergies" value="{{ old('allergies') }}" >
                                </div>
                                <div class="form-group">
                                    <label for="health_issues">Health Issues</label>
                                    <input type="text" class="form-control" id="health_issues" name="health_issues" value="{{ old('health_issues') }}" >
                                </div>
                                <div class="form-group">
                                    <label for="therapy">Therapy</label>
                                    <input type="text" class="form-control" id="therapy" name="therapy" value="{{ old('therapy') }}" >
                                </div>
                                <div class="form-group">
                                    <label for="food_type">Food Type</label>
                                    <select class="form-select" id="food_type" name="food_type" value="{{ old('food_type') }}" >
                                        <option selected disabled>Select</option>
                                        <option value="1" {{ old('food_type') == 1 ? 'selected' : '' }}>Human food</option>
                                        <option value="2" {{ old('food_type') == 2 ? 'selected' : '' }}>Pellets</option>
                                        <option value="3" {{ old('food_type') == 3 ? 'selected' : '' }}>Mix</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="vet_name">Vet name</label>
                                    <input type="text" class="form-control" id="vet_name" name="vet_name" value="{{ old('vet_name') }}" >
                                </div>
                                <div class="form-group">
                                    <label for="vet_contact">Vet contact</label>
                                    <input type="text" class="form-control" id="vet_contact" name="vet_contact" value="{{ old('vet_contact') }}" >
                                </div>
                                <div class="form-group">
                                    <label for="other_emergency_contacts">Other Emergency contacts</label>
                                    <input type="text" class="form-control" id="other_emergency_contacts" name="other_emergency_contacts" value="{{ old('other_emergency_contacts') }}" >
                                </div>
                                <div class="form-group">
                                    {{-- <label for="reward_fee">Reward</label> --}}
                                    <input type="checkbox" value="1" id="reward" name="reward" {{ old('reward') == 1 ? 'checked' : '' }}>
                                    <label for="reward">Reward</label>
                                    <input type="text" class="form-control" id="reward_fee" name="reward_fee" value="{{ old('reward_fee') }}" >
                                </div>
                                <div class="form-group">
                                    <label for="note">Note</label>
                                    <input type="text" class="form-control" id="note" name="note" value="{{ old('note') }}" >
                                </div>
                                <div class="form-group mt-4">
                                    <div class="row">
                                        <div class="col">
                                            <input type="checkbox" id="puppy" name="puppy" {{ old('puppy', 0) ? 'checked' : '' }}>
                                            <label for="puppy">Puppy</label><br>
                                            
                                            <input type="checkbox" id="sterilised" name="sterilised" {{ old('sterilised', 0) ? 'checked' : '' }}>
                                            <label for="sterilised">Sterilised</label><br>
                                        </div>
                                        <div class="col">
                                            <input type="checkbox" id="vaccinated" name="vaccinated" {{ old('vaccinated', 0) ? 'checked' : '' }}>
                                            <label for="vaccinated">Vaccinated</label><br>
                                        
                                            <input type="checkbox" id="socialized" name="socialized" {{ old('socialized', 0) ? 'checked' : '' }}>
                                            <label for="socialized">Socialized</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="image">Image</label>
                                    <input type="file" name="image" id="image">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-row">
                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){

    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();

    if (dd < 10) {
    dd = '0' + dd;
    }

    if (mm < 10) {
    mm = '0' + mm;
    } 
        
    today = yyyy + '-' + mm + '-' + dd;
    document.getElementById("dob").setAttribute("max", today);
    // console.log(today);
    
});
</script>
@endsection
