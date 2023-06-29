<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tableau de bord') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-xl shadow-lg">
                    {{ __("Heureux de vous revoir ". auth()->user()->full_name." !") }}
                </div>
            </div>
              <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100 text-xl shadow-lg">
                     <div class="grid grid-cols-1 md:grid-cols-1 gap-4 lg:gap-8">
                         <div class='grid grid-cols-1 md:grid-cols-2 gap-1 lg:gap-8'>
                           @if(auth()->user()->isAdmin())
                            <livewire:stats.admin />
                            @elseif(auth()->user()->isChief())
                            <livewire:stats.superior />
                            @else
                            <livewire:stats.employe/>
                            @endif
                         </div>
                     </div>
                </div>
            </div>
        </div>
    </div>
<script>
    {!! $lendChart->renderChartJsLibrary() !!}
    {!! $lendChart->renderJs() !!}
</script>
</x-app-layout>
