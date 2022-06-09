@php
    $cls = $attributes->get('class');
    $bgColor = 'bg-gray-200';
    // If the incoming class specifies a background don't give a default.
    if ( strpos($cls, 'bg-') !== false ) {
        $bgColor = '';
    }
    $textColor = 'text-black';
    if ( preg_match('/(text-[a-z]+-[0-9]+)|(text-white)|(text-black)/', $cls) ) {
        $textColor = '';
    }
@endphp
<div {{ $attributes->merge(['class' => "inline-block px-1 rounded {$bgColor} {$textColor}" ]) }}>
{{ $slot }}
</div>