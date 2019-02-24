@extends('layouts.app')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/jquery.dataTables.min.css">

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background: black;color: white;">Update details of {{ $userDetails->name }} <a style="float: right" href="/users">Go Back</a></div>

                <div class="card-body">
                      <form id="my_form" method="POST" action="/users/{{ $userDetails->id }}" enctype="multipart/form-data" novalidate="" onsubmit="return validateData();">
                        @csrf
                        {{ method_field('PUT') }}

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $userDetails->name }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $userDetails->email }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mobile" class="col-md-4 col-form-label text-md-right">{{ __('Mobile No') }}</label>

                            <div class="col-md-6">
                                <input id="mobile" type="number" class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" name="mobile" value="{{ $userDetails->mobile }}" required>

                                @if ($errors->has('mobile'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="date_of_birth" class="col-md-4 col-form-label text-md-right">{{ __('Date of Birth') }}</label>

                            <div class="col-md-6">
                                <input id="date_of_birth" type="date" class="form-control{{ $errors->has('date_of_birth') ? ' is-invalid' : '' }}" name="date_of_birth" value="{{ $userDetails->date_of_birth }}" required autofocus>

                                @if ($errors->has('date_of_birth'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('date_of_birth') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="profile_photo" class="col-md-4 col-form-label text-md-right">{{ __('Upload Profile Photo') }}</label>

                            <div class="col-md-6">
                                <input id="profile_photo" type="file" class="form-control{{ $errors->has('profile_photo') ? ' is-invalid' : '' }}" name="profile_photo" value="{{ old('profile_photo') }}">

                                @if ($errors->has('profile_photo'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('profile_photo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    @if(Session::has('success')) 
                        <div class="alert alert-success">
                            <strong>Success!</strong> {{ Session('success') }}
                        </div>
                        @elseif(Session::has('failure'))
                         <div class="alert alert-danger">
                            <strong>Oops!</strong> {{  Session('failure') }}
                        </div>
                    @endif  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        function validateData()
        {
            var name = document.getElementById('name').value;
            var email = document.getElementById('email').value;
            var mobile = document.getElementById('mobile').value;
            var dob = document.getElementById('date_of_birth').value;
            var profilePhoto = document.getElementById('profile_photo').value;
            if (name == "") {
                alert("Name is required");
                return false;
            } else if (name.length < 3) {
                alert('Name should have atleast 3 characters');
                return false;
            } else if (email == ''){
                alert('Email is required');
                return false;
            } else if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
                alert('Email isnt valid');
                return false;
            } else if (mobile == ''){
                alert('Mobile is required');
                return false;
            } else if (mobile.length < 10 || mobile.length > 10 ){
               alert('Mobile must be of 10 digits only');
               return false; 
            } else if (!/^\d+$/.test(mobile)){
                alert('Mobile should have only digits');
                return false;
            } else if (dob == ''){
                alert('Date of birth is required');
                return false;
            } else if (profilePhoto == ""){
                alert('Profile photo is required');
                return false;
            } else if (profilePhoto !== ""){
                var fileExtension = profilePhoto.substring(profilePhoto.lastIndexOf('.') + 1).toLowerCase();
                if (fileExtension == "png" || fileExtension == "jpeg" || fileExtension == "jpg") {
                    var fileSize = document.getElementById('profile_photo').files[0].size;
                    if (fileSize > 100000) {
                        alert('Max upload size is 100kb');
                        return false;
                    }
                } else {
                    alert('Only jpg and png are allowed');
                    return false;
                } 
            }
        }
    </script>
@endsection