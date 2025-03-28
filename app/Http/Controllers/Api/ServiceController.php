<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Resources\ServiceResource;

class ServiceController extends Controller
{
    public function index()
    {
        return ServiceResource::collection(Service::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $service = Service::create($validated);

        return new ServiceResource($service);
    }

    public function show(Service $service)
    {
        return new ServiceResource($service);
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $service->update($validated);

        return new ServiceResource($service);
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return response()->noContent();
    }
}
