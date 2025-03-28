<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Appointments') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container">
                        <h1 class="font-semibold text-lg text-gray-600">{{ __('Create appointment') }}</h1>
                        <form action="{{ route('appointments.store') }}" method="POST">
                            @csrf
                            <div class="form-group mt-4">
                                <x-input-label for="appointment_time" :value="__('Service')" />
                                <select name="service_id" id="service_id" class="form-control" required>
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mt-4">
                                <x-input-label for="appointment_time" :value="__('Date')" />
                                <x-text-input id="appointment_time" class="block mt-1 w-full" type="datetime-local" name="appointment_time" :value="old('appointment_time')" required autofocus autocomplete="appointment_time" />
                                <x-input-error :messages="$errors->get('appointment_time')" class="mt-2" />
                            </div>
                            <x-primary-button class="mt-6">
                                {{ __('Save') }}
                            </x-primary-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
