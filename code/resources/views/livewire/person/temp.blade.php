<div>
    <x-slot name="header">
        <header class="flex justify-between">
            <h2 class="leading-tight text-gray-800 ">
                <span class="text-xl font-semibold">Twink<span>
            </h2>
            <div>
                <button class="btn" wire:click='toggle'>Go</button>
            </div>
        </header>
    </x-slot>
    @if ( $show )
    <div>{{ $temp }}</div>
    @endif
    
    <div class="">
        <button class="btn" wire:click='toggle'>Go</button>
    </div>
</div>
