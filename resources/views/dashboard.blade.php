<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold leading-tight text-center text-gray-800">
            {{ __('WEBMAPPING DE RANOMAFANA') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-h-screen mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-transparent shadow-xl sm:rounded-lg">
                <x-map />
            </div>
        </div>
    </div>
</x-app-layout>
