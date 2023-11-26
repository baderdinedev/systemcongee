@extends('layouts.app')
@section('content')

    <div class="container">
       <h2>Welcome, {{ Auth::user()->name }}</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createEmployeeModal">
            Create Employee
        </button>


        <button type="button" class="btn @if($totalLeaves > 0) btn-danger @else btn-dark @endif" data-bs-toggle="modal" data-bs-target="#showRequest">
            Leave Requests: {{$totalLeaves}}
        </button>



        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $employee)
                    <tr>
                        <td>{{ $employee->id }}</td>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editEmployeeModal{{ $employee->id }}">
                                Edit
                            </button>
                            <div class="modal fade" id="editEmployeeModal{{ $employee->id }}" tabindex="-1" aria-labelledby="editEmployeeModalLabel{{ $employee->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editEmployeeModalLabel{{ $employee->id }}">Edit Employee</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            @include('responsable.gestion_employe.edit', ['employee' => $employee])
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form action="" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

            <div class="modal fade" id="createEmployeeModal" tabindex="-1" aria-labelledby="createEmployeeModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createEmployeeModalLabel">Create Employee</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @include('responsable.gestion_employe.create')
                    </div>
                </div>
            </div>
            </div>


            <div class="modal fade" id="showRequest" tabindex="-1" aria-labelledby="showRequest" aria-hidden="true">
                <div class="modal-dialog" style="max-width: 1000px; max-height: 600px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createEmployeeModalLabel">Leave Request</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @include('leave.leave-request')
                        </div>
                    </div>
                </div>
            </div>


        
@endsection
