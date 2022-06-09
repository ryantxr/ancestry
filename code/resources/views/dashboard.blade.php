<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="px-4 py-4 overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="">Ancestry Database</div>
                <div class=""><a class="link" href="/persons/create">Create</a></div>
            </div>
            <div class="">
            </div>
            <div class="">
            <x-quake-message></x-quake-message>
            </div>
            <div class="">
                <x-quake-form.tag>Default</x-quake-form.tag>
                <x-quake-form.tag class="text-white bg-red-600">Red</x-quake-form.tag>
                <x-quake-form.tag class="text-white bg-green-600">Green</x-quake-form.tag>
                <x-quake-form.tag class="text-white bg-blue-600">Blue</x-quake-form.tag>
                <x-quake-form.tag class="text-white bg-yellow-600">Yellow</x-quake-form.tag>
                <x-quake-form.tag class="text-white bg-gray-600">Gray</x-quake-form.tag>
            </div>
            <div class="">
                <x-quake-layout/>
            </div>
        </div>
    </div>
</x-app-layout>
