<x-app-layout>
    <x-slot name="header">
        <h2 class="leading-tight text-gray-800 ">
            <span class="text-xl font-semibold">{{ $person->fullName }} {{ $person->suffix }}</span> <span class="text-base text-gray-500">{{ $person->ageSpan }}<span>
        </h2>
    </x-slot>
    <div>
        <div class="px-2 py-2 mx-auto space-y-3 text-lg max-w-7xl sm:px-6 lg:px-8 sm:text-base">
            <div class="">
                <div class="">
                    <span class="inline-block font-bold">ID:</span> <span class="">{{ $person->id }}</span>
                </div>
                <div class="">
                    <span class="inline-block font-bold">First name:</span> <span class="">{{ $person->first }}</span>
                </div>
                <div class="">
                    <span class="inline-block font-bold">Middle names:</span> <span class="">{{ $person->middle_names }}</span>
                </div>
                <div class="">
                    <span class="inline-block font-bold">Last name:</span> <span class="">{{ $person->last }}</span>
                </div>
                <div class="">
                    <span class="inline-block font-bold">Born:</span> <span class="">{{ $person->born }} {{ $person->born_where }}</span>
                </div>
                <div class="">
                    <span class="inline-block font-bold">Died:</span> <span class="">{{ $person->died }} {{ $person->died_where }} (age: {{ $person->deathAge }})</span>
                </div>
            </div>
            <div class="">
                <div class="font-bold text-center sm:text-left">
                    Children
                    @if ( $children->count() > 0 )
                    ({{ $children->count() }})
                    @endif
                </div>
                <div class="space-y-2">
                    @forelse($children as $child)
                        <div class="sm:flex">
                            <div class="flex space-x-2">
                                <div class="">
                                    <a class="link" href="{{ $child->id }}">{{ $child->id }}</a>
                                </div>
                                <div class="">
                                    <a class="link" href="{{ $child->id }}">{{ $child->fullName }} {{ $child->suffix }}</a>
                                </div>
                            </div>
                            <div class="text-base text-gray-700">
                                (b. {{ ($child->born) ? $child->born : 'NA' }}; d. {{ ($child->died) ? $child->died : 'NA' }})
                            </div>
                        </div>
                    @empty
                    {{-- bg-yellow-100 bg-green-100 --}}
                        <div class="text-gray-600">Unknown</div>
                    @endforelse
                </div>
            </div>
            <div class="">
                <div class="font-bold text-center sm:text-left">
                    @if ( $marriages->count() > 1 )
                    Marriages(s)
                    @else
                    Marriage
                    @endif
                </div>
                @if ( $marriages->count() > 0 )
                    @foreach($marriages as $index => $marriage)
                        <div class="sm:flex">
                        @php
                            $spouse = $marriage->spouse($person->id);
                        @endphp
                            <div class="">
                                @if ( ! empty($spouse) )
                                <a class="link" href="{{ $spouse->id }}">{{ optional($spouse)->fullName }}</a>
                                <span class="text-sm">(<a class="link" href="{{ $spouse->id }}">{{ optional($spouse)->id }}</a>)</span>
                                @endif
                            </div>
                            <div class="text-sm text-gray-600">{{ $marriage->date }}</div>
                        </div>
                    @endforeach
                @else
                    <div class="text-gray-600">Unknown</div>
                @endif
            </div>
            <div class="">
                <div class="font-bold text-center sm:text-left">
                    Parents
                </div>
                <div class="">
                    <div class="">
                        <div class="text-center sm:text-left">Father:</div>
                        @if ( ! empty($father) )
                            <div class=""><a class="link" href="{{ $father->id }}">{{ $father->id }}</a> <a class="link" href="{{ $father->id }}">{{ $father->fullName }}</a></div>
                            <div class="text-gray-600">(b. {{ ($father->born) ? $father->born : 'NA' }}; d. {{ ($father->died) ? $father->died : 'NA' }})</div>
                        @else NA @endif
                    </div>
                    <div class="">
                        <div class="text-center sm:text-left">Mother:</div>
                        @if ( ! empty($mother) )
                            <div class=""><a class="link" href="{{ $mother->id }}">{{ $mother->id }}</a> <a class="link" href="{{ $mother->id }}">{{ $mother->fullName }}</a></div>
                            <div class="text-gray-600">(b. {{ ($mother->born) ? $mother->born : 'NA' }}; d. {{ ($mother->died) ? $mother->died : 'NA' }})</div>
                        @else NA @endif
                    </div>
                </div>
            </div>
            <div class="">
                <div class="font-bold text-center sm:text-left">
                    Notes
                </div>
                <div class="">
                    @foreach( explode("\n", $person->notes) as $note)
                    <div>
                    {{ $note }}
                    {{-- {{ str_replace("\n", "<br>", $person->notes) }} --}}
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

