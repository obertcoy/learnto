<x-card class="w-full xl:w-[400px] flex flex-col group relative overflow-hidden cursor-pointer">

    <x-card-header>
        <div class="flex justify-between items-start">
            <div>
                <x-card-title class="text-xl font-bold">{{ $workshop->name }}</x-card-title>
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

                    <span class="text-sm">Rp {{ number_format($workshop->price, 2) }}</span>
                </x-custom-label>
            </div>
        </div>
    </x-card-content>

    <a href="{{ route('workshops.show', $workshop) }}">
        <div
            class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-black/0 flex items-end justify-center translate-y-full opacity-0 transition-all duration-500 group-hover:opacity-100 group-hover:translate-y-0">
            <span class="text-white text-xl font-bold drop-shadow-xl mx-auto mb-16">
                Learn More
            </span>
        </div>
    </a>
</x-card>
