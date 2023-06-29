<x-app-layout>
    <x-slot name="header">
            <div class="sm:flex sm:items-center sm:justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
               {{ __('Liste des  departements') }}
            </h2>
            <div class="mt-3 sm:mt-0 sm:ml-4">
                <a href="{{ route('departments.create') }}"
                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                   Ajouter un departements
                </a>
            </div>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                   <livewire:department.department-table />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
