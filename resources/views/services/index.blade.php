<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Services') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container">
                        <a href="{{ route('services.create') }}">
                            <x-primary-button>{{ __('Create service') }}</x-primary-button>
                        </a>
                        <table class="table mt-6 w-100">
                            <thead>
                            <tr>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Description') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($services as $service)
                                <tr>
                                    <td>{{ $service->name }}</td>
                                    <td>{{ $service->description }}</td>
                                    <td>
                                        <a href="{{ route('services.edit', $service->id) }}">
                                            <x-secondary-button class="ms-2">
                                                {{ __('Edit') }}
                                            </x-secondary-button>
                                        </a>
                                        <form action="{{ route('services.destroy', $service->id) }}" method="POST" style="display:inline;">
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
                            {{ $services->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
