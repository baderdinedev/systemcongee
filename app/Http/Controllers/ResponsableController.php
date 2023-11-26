<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResponsableController extends Controller
{
    public function index()
    {
        $employees = User::where('role', 'employee')->get();
        $totalLeaves = Leave::count();
        $leaveRequests = Leave::all();

        $responsable = auth()->user();

        if ($responsable) {
            $notifications = $responsable->unreadNotifications;
            $responsable->unreadNotifications->markAsRead();
        } else {

            $notifications = null;
        }

        return view('responsable.dashboard', [
            'employees' => $employees,
            'totalLeaves' => $totalLeaves,
            'leaveRequests' => $leaveRequests,
            'notifications' => $notifications,
        ]);
    }


    public function create()
    {
        return view('responsable.gestion_employe.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => 'employee',
        ]);

        return redirect()->route('responsable.dashboard')->with('success', 'Employee created successfully.');
    }

    public function edit($id)
    {
        $employee = User::findOrFail($id);
        return view('employee.edit', ['employee' => $employee]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
        ]);

        $employee = User::findOrFail($id);
        $employee->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->has('password') ? bcrypt($request->input('password')) : $employee->password,
        ]);

        return redirect()->route('responsable.dashboard')->with('success', 'Employee updated successfully.');
    }
}
