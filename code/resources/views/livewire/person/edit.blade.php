<div>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="leading-tight text-gray-800 ">
                <span class="text-xl font-semibold">{{ $person->fullName }} {{ $person->suffix }}</span> <span class="text-base text-gray-500">{{ $person->ageSpan }}<span>
            </h2>
            <div>
                <button x-data="{}" class="btn" @click='window.location.href="/persons/show/{{ $person->id }}"'>Close</button>
            </div>
        </div>
    </x-slot>
    
    <div class="">
        <button class="btn" wire:click.prevent='saveData'>Save</button>
    </div>
    
    <div class="max-w-2xl px-8 pt-2">
        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="overflow-hidden bg-white shadow sm:rounded-lg">
            <div class="border-t border-gray-200">
                <dl>
                    <div class="px-4 py-3 bg-white sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">ID</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $person->id }}</dd>
                    </div>
                    <div class="px-4 py-3 bg-white sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <label class="text-sm font-medium text-gray-500">First name</label>
                        <input class="mt-1 text-sm text-gray-900 border sm:mt-0 sm:col-span-2" wire:model='person.first' type="text" />
                    </div>
                    <div class="px-4 py-3 bg-white sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <label class="text-sm font-medium text-gray-500">Middle names</label>
                        <input class="mt-1 text-sm text-gray-900 border sm:mt-0 sm:col-span-2" wire:model='person.middle_names' type="text">
                    </div>
                    <div class="px-4 py-3 bg-white sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <label class="text-sm font-medium text-gray-500">Last name</label>
                        <input class="mt-1 text-sm text-gray-900 border sm:mt-0 sm:col-span-2" wire:model='person.last' type="text">
                    </div>
                    <div class="px-4 py-3 bg-white sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <label class="text-sm font-medium text-gray-500">Born</label>
                        <div class="sm:col-span-2">
                            <div class="flex justify-between ">
                                <input class="w-24 mt-1 text-sm text-gray-900 border sm:mt-0 " placeholder="Born year" wire:model='person.born_year'type="text">
                                <input class="w-16 mt-1 text-sm text-gray-900 border sm:mt-0" placeholder="Born month" wire:model='person.born_month'type="text">
                                <input class="w-16 mt-1 text-sm text-gray-900 border sm:mt-0" placeholder="Born day" wire:model='person.born_day'type="text">
                            </div>
                            <div class="">
                                <input class="w-4" type="checkbox" wire:model='person.born_circa'> Approximate
                            </div>
                            <div class="">
                                <input class="mt-1 text-sm text-gray-900 border sm:mt-0 sm:col-span-2" placeholder="Born where" wire:model='person.born_where'type="text">
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 bg-white sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <label class="text-sm font-medium text-gray-500">Died</label>
                        <div class="sm:col-span-2">
                            <div class="flex justify-between ">
                                <input class="w-24 mt-1 text-sm text-gray-900 border sm:mt-0 " placeholder="Year" wire:model='person.died_year'type="text">
                                <input class="w-16 mt-1 text-sm text-gray-900 border sm:mt-0" placeholder="Month" wire:model='person.died_month'type="text">
                                <input class="w-16 mt-1 text-sm text-gray-900 border sm:mt-0" placeholder="Day" wire:model='person.died_day'type="text">
                            </div>
                            
                            <div class="">
                                <input class="mt-1 text-sm text-gray-900 border sm:mt-0 sm:col-span-2" placeholder="Born where" wire:model='person.died_where'type="text">
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="px-4 py-3 bg-white sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Died</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">Died:</span> <span class="">{{ $person->died }} {{ $person->died_where }} (age: {{ $person->deathAge }})</span></dd>
                    </div>

                    <div class="px-4 py-5 space-y-1 bg-white sm:px-6">
                        <dt class="flex justify-between text-sm font-medium text-gray-500">
                            <div class="">Children{{ $children->count() > 0 ? '(' . $children->count() . ')' : null }}</div>
                            
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <ul role="list" class="border border-gray-200 divide-y divide-gray-200 rounded-md">
                                <li>
                                    <div class="flex flex-col">
                                        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                                            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                                                <div class="overflow-hidden">
                                                    <table class="min-w-full">
                                                        <tbody>
                                                            @forelse($children as $child)
                                                                <tr class="">
                                                                    <td class="flex items-center px-2 py-4 text-sm font-medium text-gray-900 align-top whitespace-nowrap">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                                            <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
                                                                        </svg>
                                                                        <span class="ml-1"> <a class="link" href="{{ $child->id }}">{{ $child->id }}</a> </span>
                                                                    </td>
                                                                    <td class="px-2 py-4 text-sm font-light text-gray-900 whitespace-nowrap">
                                                                        <a class="link" href="{{ $child->id }}">{{ $child->fullName }} {{ $child->suffix }}</a>
                                                                    </td>
                                                                    <td class="px-2 py-4 text-sm font-light text-gray-900 whitespace-nowrap">
                                                                        (b. {{ ($child->born) ? $child->born : 'NA' }}; d. {{ ($child->died) ? $child->died : 'NA' }})
                                                                    </td>
                                                                </tr>
                                                            @empty
                                                                <tr><td class="px-6 py-4 text-sm font-light text-gray-900 whitespace-nowrap">Unknown</td></tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </dd>
                    </div>
                    <div class="px-4 py-5 space-y-1 bg-white sm:px-6">
                        <dt class="flex justify-between text-sm font-medium text-gray-500">
                            <div class="">Marriage{{ $marriages->count() > 1 ? '(s)' : null }}</div>
                            <div class="">
                                <button class="p-1 text-white bg-blue-600 rounded btn" wire:click='toggleAddMarriage'>Add</button>
                            </div>
                        </dt>
                        @if ( $addMarriage )
                        <div class="">
                            <div class="">
                                <x-form.select id="spouse" wire:model='marriage.to' label="Spouse">
                                    <option value="0">No one</option>
                                    @foreach($all as $item)
                                    <option value="{{ $item->id }}">{{ sprintf('%d %s %s %s', $item->id, $item->first, $item->middle_names, $item->last); }}</option>                    
                                    @endforeach
                                </x-form.select>
                            </div>
                            <div class="">
                                <input class="px-1 border" size="4" wire:model='marriage.year' placeholder="Year">
                                <input class="px-1 border" size="4" wire:model='marriage.month' placeholder="Month">
                                <input class="px-1 border" size="4" wire:model='marriage.day' placeholder="Day">
                            </div>
                            <div class="flex justify-between">
                                <button  class="p-1 text-white bg-blue-600 rounded btn" wire:click='saveMarriage'>Save</button>
                                <button  class="p-1 text-gray-900 bg-gray-100 rounded " wire:click='toggleAddMarriage'>Cancel</button>
                            </div>
                        </div>
                        @endif
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <ul role="list" class="border border-gray-200 divide-y divide-gray-200 rounded-md">
                                @if ( $marriages->count() > 0 )
                                    @foreach($marriages as $index => $marriage)
                                        @php
                                            $spouse = $marriage->spouse($person->id);
                                        @endphp
                                        <li class="flex py-3 pl-3 pr-4 text-sm justify-left ">
                                            <div class="flex items-center flex-1 w-0 ">
                                                <svg class="w-5 h-5 text-gray-400 x-flex-shrink-0" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                                                </svg>
                                                
                                                <span class="flex-1 w-16 ml-2 truncate"> 
                                                    @if ( ! empty($spouse) )
                                                        <a class="link" href="{{ $spouse->id }}">{{ optional($spouse)->id }} {{ optional($spouse)->fullName }}</a>
                                                    @endif
                                                </span>

                                            </div>
                                            

                                            <div class="whitespace-nowrap">
                                                m. {{ $marriage->date }}
                                            </div>
                                        </li>
                                    @endforeach
                                @else
                                    <div class="text-gray-600">Unknown</div>
                                @endif
                            </ul>
                        </dd>
                    </div>
                    
                    <x-form.select id="father" wire:model='person.father_id' label="Father">
                        <option value="0">No one</option>
                        @foreach($males as $item)
                        @php
                            $selected = ( $father && $item->id == $father->id) ? 'selected' : '';
                        @endphp
                        <option {{ $selected }} value="{{ $item->id }}">{{ sprintf('%d %s %s %s', $item->id, $item->first, $item->middle_names, $item->last); }}</option>                    
                        @endforeach
                    </x-form.select>
                    <x-form.select id="mother" wire:model='person.mother_id' label="Mother">
                        <option value="0">No one</option>
                        @foreach($females as $item)
                        @php
                            $selected = ( $mother && $item->id == $mother->id) ? 'selected' : '';
                        @endphp
                        <option {{ $selected }} value="{{ $item->id }}">{{ sprintf('%d %s %s %s', $item->id, $item->first, $item->middle_names, $item->last); }}</option>                    
                        @endforeach
                    </x-form.select>
                </dl>
            </div>
        </div>
        <div class="px-4 py-5 bg-white sm:px-6">
            <div class=""><label class="text-sm font-medium text-gray-500">Notes</label></div>
            <div class=""><textarea rows=30 cols=60 class="mt-1 text-sm text-gray-900 sm:mt-0" wire:model='person.notes'></textarea></div>
        </div>
    </div>


    
</div>
