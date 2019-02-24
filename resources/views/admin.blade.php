@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background: black;color: white;">Admin Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="/users/create" class="btn btn-primary">Regiter New User</a>
                    <a href="/users" class="btn btn-success">View Registered User</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection