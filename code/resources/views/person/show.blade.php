<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $person->fullName }} {{ $person->suffix }}
        </h2>
    </x-slot>
    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div>
                <div class="">
                    <span class="font-bold">ID:</span> {{ $person->id }}
                </div>
                <div class="">
                    <span class="font-bold">First name:</span> {{ $person->first }}
                </div>
                <div class="">
                    <span class="font-bold">Middle names:</span> {{ $person->middle_names }}
                </div>
                <div class="">
                    <span class="font-bold">Last name:</span> {{ $person->last }}
                </div>
                <div class="">
                    <span class="font-bold">Born:</span> {{ $person->born }} {{ $person->born_where }}
                </div>
                <div class="">
                    <span class="font-bold">Died:</span> {{ $person->died }} {{ $person->died_where }} (age: {{ $person->deathAge }})
                </div>
            </div>
            <div class="">
                <div class="font-bold">
                    Children
                    @if ( $children->count() > 0 )
                    ({{ $children->count() }})
                    @endif
                </div>
                <div class="">
                    @forelse($children as $child)
                        <div class="flex">
                            <div class=" w-12">
                                <a class="link" href="{{ $child->id }}">{{ $child->id }}</a>
                            </div>
                            <div class=" w-96">
                            {{ $child->fullName }} {{ $child->suffix }}
                            </div>
                            <div class=" w-96">
                                (b. {{ $child->born }}; d. {{ ($child->died) ? $child->died : 'unknown' }})
                            </div>
                        </div>
                    @empty
                    {{-- bg-yellow-100 bg-green-100 --}}
                        <div class="">None</div>
                    @endforelse
                </div>
            </div>
            <div class="">
                <div class="font-bold">
                    @if ( $marriages->count() > 1 )
                    Marriages(s)
                    @else
                    Marriage
                    @endif
                </div>
                @if ( $marriages->count() > 0 )
                    @foreach($marriages as $index => $marriage)
                        <div class="flex">
                        @php
                            $spouse = $marriage->spouse($person->id);
                        @endphp
                            <div class="">
                                To. {{ optional($spouse)->fullName }}
                                @if ( ! empty($spouse) )
                                (<a class="link" href="{{ $spouse->id }}">{{ optional($spouse)->id }}</a>)
                                @endif
                            </div>
                            <div class="pl-2">{{ $marriage->date }}</div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="">
                <div class="font-bold">
                    Parents
                </div>
                <div class="">
                    <div class="">
                        Father: @if ( ! empty($father) ) <a class="link" href="{{ $father->id }}">{{ $father->id }}</a> {{ $father->fullName }} (b. {{ ($father->born) ? $father->born : 'unknown' }}; d. {{ ($father->died) ? $father->died : 'unknown' }})  @else NA @endif
                    </div>
                    <div class="">
                        Mother: @if ( ! empty($mother) ) <a class="link" href="{{ $mother->id }}">{{ $mother->id }}</a> {{ $mother->fullName }} (b. {{ ($mother->born) ? $mother->born : 'unknown' }}; d. {{ ($mother->died) ? $mother->died : 'unknown' }}) @else NA @endif
                    </div>
                </div>
            </div>
            <div class="">
                <div class="font-bold">
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

