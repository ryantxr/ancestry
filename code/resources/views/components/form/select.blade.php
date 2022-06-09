<div class="flex">
    @if ( $attributes->has('label') )
        <div class="">{{ $attributes->get('label') }}</div>
    @endif
    <select {{ $attributes->merge(['class' => 'border border-gray-300 rounded-md text-gray-600 h-10 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none sm:text-sm sm:leading-5' ]) }}>

    {{ $slot }}

  </select>

</div>
