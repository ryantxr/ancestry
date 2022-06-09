<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Create') }}
        </h2>
    </x-slot>


    <div class="block max-w-xl p-6 bg-white rounded-lg shadow-lg">
        <form>
            <x-form.text placeholder="First name" wire:model="first" id="exampleInput121"></x-form.text>
            <x-form.text placeholder="Middle names" wire:model="middleNames" id="exampleInput122"></x-form.text>
            <x-form.text placeholder="Last name" wire:model="last" id="exampleInput122"></x-form.text>
            <x-form.text placeholder="Alternate last name" wire:model="altLast" id="exampleInput123"></x-form.text>
            <x-form.text placeholder="Suffix" wire:model="suffix" id="exampleInput124"></x-form.text>
            <x-form.text placeholder="Nickname" wire:model="nickname" id="exampleInput125"></x-form.text>
            <x-form.text placeholder="Title" wire:model="title" id="exampleInput126"></x-form.text>
            <x-form.select wire:model='sex' id="sex" label="Sex">
                <option value="M">M</option>
                <option value="F">F</option>
            </x-form.select>
            <hr>
            <div class="mb-6 text-center">
                <h1 class="text-xl font-bold">Birth</h1>
                <x-form.checkbox id="born_circa" wire:model="bornCirca">
                    Approximate date
                </x-form.checkbox>
                <div class="grid grid-cols-3">
                    <x-form.text placeholder="Born year" wire:model="bornYear" id="bornYear"></x-form.text>
                    <x-form.text placeholder="Born month" wire:model="bornMonth" id="bornMonth"></x-form.text>
                    <x-form.text placeholder="Born day" wire:model="bornDay" id="bornDay"></x-form.text>
                </div>
                <x-form.text placeholder="Born where" wire:model="bornWhere" id="bornWhere"></x-form.text>
            </div>

            <hr>
            <div class="mb-6 text-center">
                <h1 class="text-xl font-bold">Death</h1>
                <x-form.checkbox id="died_circa" wire:model="diedCirca">
                    Approximate date
                </x-form.checkbox>
                <div class="grid grid-cols-3">
                    <x-form.text placeholder="Died year" wire:model="diedYear" id="diedYear"></x-form.text>
                    <x-form.text placeholder="Died month" wire:model="diedMonth" id="diedMonth"></x-form.text>
                    <x-form.text placeholder="Died day" wire:model="diedDay" id="diedDay"></x-form.text>
                </div>
                <x-form.text placeholder="Died where" wire:model="diedWhere" id="diedWhere"></x-form.text>
            </div>
            

            <x-form.select id="father" wire:model='fatherId' label="Father">
                <option value="0">No one</option>
                @foreach($males as $item)
                <option value="{{ $item->id }}">{{ sprintf('%d %s %s %s', $item->id, $item->first, $item->middle_names, $item->last); }}</option>                    
                @endforeach
            </x-form.select>
            <x-form.select id="mother" wire:model='motherId' label="Mother">
                <option value="0">No one</option>
                @foreach($females as $item)
                <option value="{{ $item->id }}">{{ sprintf('%d %s %s %s', $item->id, $item->first, $item->middle_names, $item->last); }}</option>                    
                @endforeach
            </x-form.select>
            <x-form.textarea id="notes" wire:model='notes' label="Notes"></x-form.textarea>


            <button wire:click.prevent='save()' type="submit" class="
            w-full
            px-6
            py-2.5
            bg-blue-600
            text-white
            font-medium
            text-xs
            leading-tight
            uppercase
            rounded
            shadow-md
            hover:bg-blue-700 hover:shadow-lg
            focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
            active:bg-blue-800 active:shadow-lg
            transition
            duration-150
            ease-in-out">Save</button>
        </form>
    </div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
</div>
