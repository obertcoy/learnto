<x-button class="{{ $class }}" variant="{{ $eligible ? 'default' : 'muted' }}">

    @if (Auth::guest())
        <a href={{ route('login', $workshop) }}>
            Login to Register
        </a>
    @else
        @if ($eligible)
            <a href={{ route('workshops.payment', $workshop) }}>
                Register Now
            </a>
        @else
            <span>
                Already Joined
            </span>
        @endif

    @endif
</x-button>
