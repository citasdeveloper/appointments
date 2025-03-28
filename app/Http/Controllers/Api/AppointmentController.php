<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Resources\AppointmentResource;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->user()->role == 'admin') {
            return AppointmentResource::collection(Appointment::all());
        }
        return AppointmentResource::collection(Appointment::where('user_id', Auth::id())->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
            'appointment_time' => 'required|date',
        ]);

        $appointment = Appointment::create($validated);

        return new AppointmentResource($appointment);
    }

    public function show(Appointment $appointment)
    {
        return new AppointmentResource($appointment);
    }

    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
            'appointment_time' => 'required|date',
        ]);

        $appointment->update($validated);

        return new AppointmentResource($appointment);
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return response()->noContent();
    }
}
