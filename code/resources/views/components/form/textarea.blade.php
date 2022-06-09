<div class="">
    @if ( $attributes->has('label'))
        <h2 class="font-bold">{{ $attributes->get('label') }}</h2>
    @endif
    <textarea {{ $attributes }} rows="3" class="block w-full transition duration-150 ease-in-out form-textarea sm:text-sm sm:leading-5"></textarea>
</div>