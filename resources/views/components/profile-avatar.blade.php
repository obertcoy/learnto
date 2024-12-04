@props([
    'src' => null,
    'alt' => '',
    'size' => 'h-10 w-10', // Default size: 10 (40px)
    'fallback' => '',
])

<a href="{{ $redirect ? route('users.show', $user) : 'javascript:void(0)' }}"
   class="{{ $redirect ? '' : 'cursor-default' }}">
    <div {{ $attributes->merge(['class' => "relative flex items-center justify-center rounded-full bg-gray-200 text-gray-600 $size"]) }}>
        @if ($src)
        <img src="{{ $src }}" alt="{{ $alt }}" class="object-cover rounded-full {{ $size }}" />
        @else
        <span class="uppercase font-medium">
            {{ $fallback }}
        </span>
        @endif
    </div>
</a>
