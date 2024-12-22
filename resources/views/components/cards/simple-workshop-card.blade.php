<x-card :key="$workshop->id">
    <x-card-header>
        <div class="flex justify-between items-start">
            <div>
                <h2>{{ $workshop->name }}</h2>
                <x-card-description>
                    <x-custom-label>
                        <x-custom-icon icon="calendar" />

                        {{ $workshop->date->format('M d, Y') }}
                    </x-custom-label>
                </x-card-description>
            </div>
            <x-badge :variant="$workshop->status === 'Upcoming' ? 'default' : 'secondary'">
                {{ $workshop->status }}
            </x-badge>
        </div>
    </x-card-header>
    <x-card-content>
        <div class="flex flex-wrap gap-4">
            <x-custom-label>
                <x-custom-icon icon="clock" />


                <span>{{ $workshop->duration }} minutes</span>
            </x-custom-label>
            <x-custom-label>
                <x-custom-icon icon="users" />


                <span>{{ $workshop->usersCount() }} attendees</span>
            </x-custom-label>
            @if ($workshop->status == 'Completed')
                <x-custom-label>
                    <x-custom-icon icon="star" />

                    <span>{{ number_format($workshop->averageRating(), 1) }} ({{ $workshop->ratingsCount() }}
                        users)</span>
                </x-custom-label>
                <x-custom-label>
                    <x-custom-icon icon="review" />


                    <span>{{ $workshop->reviewsCount() }} reviews</span>
                </x-custom-label>
            @endif
        </div>
        <div class="mt-4 flex space-x-2">
            <a href="{{ route('workshops.show', ['workshop' => $workshop->id]) }}">
                <x-button>
                    View Details
                </x-button>
            </a>
            @if (auth()->user() == $workshop->instructor)

                @if ($workshop->status == 'Completed')
                    <a href="{{ route('workshops.show.reviews', ['workshop' => $workshop->id]) }}">
                        <x-button variant="outline">Check Reviews</x-button>
                    </a>
                @endif
            @endif
        </div>
    </x-card-content>
</x-card>
