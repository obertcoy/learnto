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
                <x-profile-avatar :src="$workshop->instructor->profile_picture_url" :alt="$workshop->instructor->name"
                    fallback="{{ collect(explode(' ', $workshop->instructor->name))->map(fn($n) => strtoupper($n[0]))->join('') }}"
                    size="h-10 w-10" />
                <div>
                    <p class="text-sm font-medium">{{ $workshop->instructor->name }}</p>
                    <div class="flex items-center">
                        @if ($workshop->instructor->ratings_count > 0)
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path
                                    d="M12 .587l3.668 7.564 8.332 1.151-6.064 5.874 1.515 8.277L12 18.813l-7.451 4.64 1.515-8.277-6.064-5.874 8.332-1.151z" />
                            </svg>
                            <span
                                class="text-sm text-gray-600 ml-1">{{ number_format($workshop->instructor->average_rating, 1) ?? 'N/A' }}
                                from {{ $workshop->instructor->ratings_count }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="space-y-2">
                <div class="flex items-center gap-2">
                    {{-- <x-bi-calendar class="h-4 w-4" /> --}}
                    <span class="text-sm">
                        {{ $workshop->date->format('M d, Y') }} at {{ $workshop->date->format('h:i A') }}
                    </span>
                </div>
                <div class="flex items-center gap-2">
                    {{-- <x-bi-clock class="h-4 w-4"  /> --}}
                    <span class="text-sm">{{ $workshop->duration }} minutes</span>
                </div>
                <div class="flex items-center gap-2">
                    {{-- <x-gmdi-attach-money-o class="h-4 w-4" /> --}}
                    <span class="text-sm">${{ number_format($workshop->price / 100, 2) }}</span>
                </div>
            </div>
        </div>
    </x-card-content>

    <div
        class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-black/0 flex items-end justify-center translate-y-full opacity-0 transition-all duration-500 group-hover:opacity-100 group-hover:translate-y-0">
        <a href="{{ route('workshops.show', $workshop) }}" class="text-white text-xl font-bold drop-shadow-xl mx-auto mb-16">
            Learn More
        </a>
    </div>
</x-card>
