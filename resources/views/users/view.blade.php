@extends('layouts.app')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/jquery.dataTables.min.css">

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background: black;color: white;">Registered Users <a style="float: right" href="/users/create">Register New User</a></div>

                <div class="card-body">
                    <table id="myTable" class="display" style="width:100%" border="1">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Date of Birth</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($users))
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->mobile }}</td>
                                        <td>{{ $user->date_of_birth }}</td>
                                        <td>
                                            <a href="/users/{{ $user->id }}" class="btn btn-success btn-xs">View</a>
                                            <a href="/users/{{ $user->id }}/edit" class="btn btn-info btn-xs">Edit</a>
                                            <a href="/users" onclick="deleteUser({{ $user->id }})" class="btn btn-danger btn-xs">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
        function deleteUser(userId)
        {
            if(confirm('Are you really want to delete?')){
                $.ajax({
                    url: '/users/'+userId,
                    type: 'DELETE',   
                    data: {
                        "_token": "{{ csrf_token() }}"                    
                    }
                });
            }
        }
    </script>
@endsection