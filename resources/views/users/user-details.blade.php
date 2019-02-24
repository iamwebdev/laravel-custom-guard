@extends('layouts.app')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/jquery.dataTables.min.css">

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background: black;color: white;">Registration details of {{ $userDetails->name }} <a style="float: right" href="/users">Go Back</a></div>
                <div class="card-body">
                       <h5>Fullname: {{ $userDetails->name }}</h5>
                       <h5>Email: {{ $userDetails->email }}</h5> 
                       <h5>Mobile no: {{ $userDetails->mobile }}</h5> 
                       <h5>Date of Birth: {{ \Carbon\Carbon::parse($userDetails->date_of_birth)->format('d-m-Y') }}</h5> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
@endsection