<x-card class="w-full xl:w-[400px] flex flex-col">

    {{-- {{ dd($workshop->topics) }} --}}
    <x-card-header>
        <div class="flex justify-between items-start">
            <div>
                <x-card-title class="text-xl font-bold workshop-card-title">{{ $workshop->name }}</x-card-title>
                <x-card-description class="mt-1 flex items-center gap-1">
                    {{-- <x-bi-tag class="h-4 w-4" /> --}}
                    <span>
                        {{ $workshop->topics->pluck('topic')->implode(', ') }}
                    </span>
                </x-card-description>
            </div>
            <x-badge :variant="$workshop->status === 'Upcoming' ? 'default' : 'secondary'">
                {{ $workshop->status }}
            </x-badge>
        </div>
        <x-card-description>{{ $workshop->date->diffForHumans() }}</x-card-description>
    </x-card-header>
    <x-card-content class="flex-grow">
        <div class="space-y-4">
            <div class="flex items-center space-x-4">
                <x-profile-avatar :user="$workshop->instructor" size="h-10 w-10" />
                <div>
                    <p class="text-sm font-medium">{{ $workshop->instructor->name }}</p>
                    <x-custom-label>
                        @if ($workshop->instructor->ratings_count > 0)
                            <x-custom-icon icon="star" />

                            <span
                                class="text-sm text-gray-600 ml-1">{{ number_format($workshop->instructor->average_rating, 1) ?? 'N/A' }}
                                from {{ $workshop->instructor->ratings_count }}</span>
                        @endif
                    </x-custom-label>
                </div>
            </div>
            <div class="space-y-2">
                <x-custom-label>
                    <x-custom-icon icon="calendar" />

                    <span class="text-sm">
                        {{ $workshop->date->format('M d, Y') }} at {{ $workshop->date->format('h:i A') }}
                    </span>
                </x-custom-label>
                <x-custom-label>
                    <x-custom-icon icon="clock" />

                    <span class="text-sm">{{ $workshop->duration }} minutes</span>
                </x-custom-label>
                <x-custom-label>
                    <x-custom-icon icon="money" />

                    <span class="text-sm">Rp {{$workshop->price}}</span>
                </x-custom-label>
                @if ($workshop->status === 'Upcoming')
                    @if ($hasJoined)
                        <div class="flex items-center gap-2">
                            <a href="{{ $workshop->vc_link }}" class="text-sm text-blue-600 hover:underline">
                                Join video call
                            </a>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </x-card-content>
    <x-card-footer class="flex justify-between">
        <a href="{{ route('workshops.show', $workshop) }}">
            <x-button variant="outline">
                View Details
            </x-button>
        </a>
        @if ($workshop->status === 'Upcoming')
            @if ($hasJoined)
                <span class="text-sm text-foreground">Already Joined</span>
            @else
                <x-button>
                    <a href={{ route('workshops.payment', $workshop) }}>
                        Register Now
                    </a>
                </x-button>
            @endif
        @endif
    </x-card-footer>
</x-card>
