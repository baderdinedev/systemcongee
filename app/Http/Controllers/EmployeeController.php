<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\LeaveRequestNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $authorizationRequests = $user->leaves()->where('type', 'authorization')->get();
        $leaveRequests = $user->leaves()->where('type', 'conge')->get();

        return view('employee.dashboard', compact('authorizationRequests', 'leaveRequests'));
    }

    public function createLeaveDemande()
    {
        return view('employee.leave.create');
    }

    public function storeLeaveDemande(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'reason' => 'required',
        ]);

        $user = auth()->user();

        $leave = $user->leaves()->create([
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'reason' => $request->input('reason'),
        ]);

        // Notify the responsable about the new leave request
        $responsable = User::where('role', 'responsable')->first();

        // Use Laravel's Notification::send to send a notification to the responsable
        Notification::send($responsable, new LeaveRequestNotification($leave));

        return redirect()->route('employee.dashboard')->with('success', 'Leave request submitted successfully.');
    }

    public function storeAuthorization(Request $request)
    {
        $request->validate([
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'reason' => 'required',
        ]);

        $user = auth()->user();

        $leave = $user->leaves()->create([
            'type' => 'authorization',
            'start_date' => now()->format('Y-m-d'),
            'end_date' => now()->format('Y-m-d'),
            'start_time' => $request->input('start_time'),
            'end_time' => $request->input('end_time'),
            'reason' => $request->input('reason'),
        ]);

        return redirect()->route('employee.dashboard')->with('success', 'Authorization request submitted successfully.');
    }
}
