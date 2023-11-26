@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Employee Dashboard</h2>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createLeaveRequestModal">
        Demande Leave
    </button>

    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#createAuthorizationRequestModal">
        Demande Authorization
    </button>


    <div class="modal fade" id="createLeaveRequestModal" tabindex="-1" aria-labelledby="createLeaveRequestModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createLeaveRequestModalLabel">Demande Leave Request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @include('employee.leave.create')
                </div>
            </div>
        </div>
    </div>

        <div class="modal fade" id="createAuthorizationRequestModal" tabindex="-1" aria-labelledby="createAuthorizationRequestModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createAuthorizationRequestModalLabel">Demande Authorization</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                   @include('employee.leave.authorizationCreate')
                </div>
            </div>
        </div>
    </div>

<div class="row">
    <div class="col-md-6">
        <h2>Authorization Requests</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Reason</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($authorizationRequests as $authorization)
                    <tr>
                        <td>{{ $authorization->start_time }}</td>
                        <td>{{ $authorization->end_time }}</td>
                        <td>{{ $authorization->reason }}</td>
                        <td style="background-color: 
                            @if($authorization->status == 'en attent') yellow 
                            @elseif($authorization->status == 'accepted') green 
                            @elseif($authorization->status == 'refused') red 
                            @endif "
                        >{{ $authorization->status }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">No authorization requests.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>


    <div class="col-md-6">
        <h2>Leave Requests</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Reason</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($leaveRequests as $leave)
                    <tr>
                        <td>{{ $leave->start_date }}</td>
                        <td>{{ $leave->end_date }}</td>
                        <td>{{ $leave->reason }}</td>
                        <td style="background-color: 
                            @if($leave->status == 'en attent') yellow 
                            @elseif($leave->status == 'accepted') green 
                            @elseif($leave->status == 'refused') red 
                            @endif "
                        >{{ $leave->status }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">No leave requests.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>


    </div>
@endsection
