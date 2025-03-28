<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->user()->role == 'admin') {
            $appointments = Appointment::paginate(2);
        } else {
            $appointments = Appointment::where('user_id', Auth::id())->paginate(2);
        }

        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
        $services = Service::all();
        return view('appointments.create', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'appointment_time' => 'required|date',
        ]);

        Appointment::create([
            'service_id' => $request->service_id,
            'user_id' => Auth::id(),
            'appointment_time' => $request->appointment_time,
            'status' => 'pending',
        ]);

        return redirect()->route('appointments.index');
    }

    public function edit(Appointment $appointment)
    {
        $services = Service::all();
        return view('appointments.edit', compact('appointment', 'services'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'appointment_time' => 'required|date',
        ]);

        $appointment->update($request->all());

        return redirect()->route('appointments.index');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('appointments.index');
    }
}
