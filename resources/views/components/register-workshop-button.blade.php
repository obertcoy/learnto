<x-button class="{{ $class }}" variant="{{$eligible ? 'default' : 'muted' }}">
    @if ($eligible)
        <a href={{ route('workshops.payment', $workshop) }}>
            Register Now
        </a>
    @else
        <span>
            Already Joined
        </span>
    @endif
</x-button>
