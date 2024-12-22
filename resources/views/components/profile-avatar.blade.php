<a href="{{ $redirect ? route('users.show', $user) : 'javascript:void(0)' }}"
   class="{{ $redirect ? '' : 'cursor-default' }}">
    <div {{ $attributes->merge(['class' => "relative flex items-center justify-center rounded-full bg-gray-200 text-gray-600 $size"]) }}>
        @if ($src || !empty($id))
        <img id="{{ $id }}" src="{{ $src }}" alt="{{ $alt }}" class="object-cover rounded-full {{ $size }}" style="visibility: hidden;" onload="this.style.visibility='visible';"/>
        @else
        <span class="uppercase font-medium">
            {{ $fallback }}
        </span>
        @endif
    </div>
</a>
