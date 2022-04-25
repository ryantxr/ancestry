<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List') }}
        </h2>
    </x-slot>
    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @foreach( $persons as $person )
            <div class="">
                <a class="link" href="/persons/{{ $person->id }}">{{ $person->id }}</a>
                <span class="text-green-600 font-bold">{{ $person->fullName }} {{ $person->suffix }}</span>
                
                @if ( $person->born || $person->died )
                (
                    @if ( $person->born ) b. {{ $person->born }} @endif
                    @if ( $person->died ) @if ( $person->born ) - @endif d. {{ $person->died }} @endif
                    @if ( $person->deathAge ) age: {{ $person->deathAge }} @endif
                )
                @endif
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>

