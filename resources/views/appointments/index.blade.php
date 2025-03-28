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
                        <a href="{{ route('appointments.create') }}">
                            <x-primary-button>{{ __('Create appointment') }}</x-primary-button>
                        </a>
                        <table class="table mt-3">
                            <thead>
                            <tr>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Service') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($appointments as $appointment)
                                <tr>
                                    <td>{{ $appointment->user->name }}</td>
                                    <td>{{ $appointment->service->name }}</td>
                                    <td>{{ $appointment->appointment_time }}</td>
                                    <td>{{ $appointment->status }}</td>
                                    <td>
                                        <a href="{{ route('appointments.edit', $appointment->id) }}" >
                                            <x-secondary-button class="ms-2">
                                                {{ __('Edit') }}
                                            </x-secondary-button>
                                        </a>
                                        <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <x-danger-button class="ms-2">
                                                {{ __('Delete') }}
                                            </x-danger-button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div>
                            {{ $appointments->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
