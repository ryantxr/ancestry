
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Index') }}
        </h2>
    </x-slot>
    <div>
        <div class="py-2 mx-auto space-y-1 text-lg sm:text-base max-w-7xl sm:px-6 lg:px-8">
            <input class="px-2 py-1 border" wire:model.debounce.500="search" placeholder="Search">
        </div>
        <div class="py-2 mx-auto space-y-1 text-lg sm:text-base max-w-7xl sm:px-6 lg:px-8">
            @foreach( $persons as $person )
            <div class="" rel="person"> <!-- person -->
                <div class="px-1 sm:flex">
                    <div class="">
                        <a class="link" href="/persons/{{ $person->id }}">{{ $person->id }}</a>
                        <a class="link" href="/persons/{{ $person->id }}">{{ $person->fullName }} {{ $person->suffix }}</a>
                    </div>
                    <div class=""><!-- dates -->
                        @if ( $person->born || $person->died )
                            <span class="hidden sm:inline">(</span>
                            @if ( $person->born ) <div class="text-gray-600 sm:inline">b. {{ $person->born }}</div> @endif
                            @if ( $person->died )
                                <div class="text-gray-600 sm:inline"><!-- died -->
                                    @if ( $person->born )
                                        <span class="hidden sm:inline">-</span>
                                    @endif
                                    d. {{ $person->died }}
                                    @if ( $person->deathAge ) age: {{ $person->deathAge }} @endif
                                </div><!-- died -->
                            @endif
                            <span class="hidden sm:inline">)</span>
                        @endif
                    </div><!-- dates -->
                </div>
            </div><!-- person -->
            @endforeach
        </div>
    </div>



