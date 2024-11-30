<x-card class="w-full xl:w-[400px] flex flex-col">

    {{-- {{ dd($workshop->topics) }} --}}
    <x-card-header>
        <div class="flex justify-between items-start">
            <div>
                <x-card-title class="text-xl font-bold">{{ $workshop->name }}</x-card-title>
                <CardDescription className="mt-1">
                    <span className="inline-flex items-center">
                        {{-- <Tag className="w-4 h-4 mr-1" /> --}}
                        {{ $workshop->topics->pluck('topic')->implode(', ') }}
                    </span>
                </CardDescription>
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
                <x-avatar :src="$workshop->instructor->profile_picture_url" :alt="$workshop->instructor->name"
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
                <div class="flex items-center">
                    <span class="text-sm">
                        {{ $workshop->date->format('M d, Y') }} at {{ $workshop->date->format('h:i A') }}
                    </span>
                </div>
                <div class="flex items-center">
                    <span class="text-sm">{{ $workshop->duration }} minutes</span>
                </div>
                <div class="flex items-center">
                    <span class="text-sm">${{ number_format($workshop->price / 100, 2) }}</span>
                </div>
                @if ($workshop->status === 'Upcoming')
                    <div class="flex items-center">
                        <a href="{{ $workshop->vc_link }}" class="text-sm text-blue-600 hover:underline">
                            Join video call
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </x-card-content>
    <x-card-footer class="flex justify-between">
        <a href="/workshops/{{ $workshop->id }}"
            class="px-4 py-2 text-gray-700 border border-gray-300 rounded hover:bg-gray-100">
            Learn More
        </a>
        @if ($workshop->status === 'Upcoming')
            <button class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                Register Now
            </button>
        @endif
    </x-card-footer>
</x-card>
