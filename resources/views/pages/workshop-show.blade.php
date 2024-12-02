<x-app-layout>

    <section class="flex flex-col gap-12">
        <div class="grid md:grid-cols-3 gap-6">

            <div class="flex flex-col md:col-span-2 gap-6">

                <div class="flex flex-col gap-3">

                    <h1 class="text-4xl font-bold">{{ $workshop->name }}</h1>

                    <div class="inline-flex items-center gap-1">

                        @foreach ($workshop->topics as $topic)
                            <x-badge variant='default'>
                                {{ $topic->topic }}
                            </x-badge>
                        @endforeach
                    </div>
                </div>

                <p class="text-lg">{{ $workshop->description }}</p>

            </div>

            <div>
                <x-card>
                    <x-card-header>
                        <x-card-title>Workshop Details</x-card-title>
                        <x-card-description>Key information about the workshop</x-card-description>
                    </x-card-header>
                    <x-card-content>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                {{-- <CalendarDays class="mr-2 h-4 w-4" /> --}}
                                <span>{{ $workshop->date->format('M d, Y') }} at
                                    {{ $workshop->date->format('h:i A') }}</span>
                            </div>
                            <div class="flex items-center">
                                {{-- <Clock class="mr-2 h-4 w-4" /> --}}
                                <span>{{ $workshop->duration }} minutes</span>
                            </div>
                            <div class="flex items-center">
                                {{-- <DollarSign class="mr-2 h-4 w-4" /> --}}
                                <span>${{ number_format($workshop->price / 100, 2) }}</span>
                            </div>
                            <div class="flex items-center">
                                {{-- <User class="mr-2 h-4 w-4" /> --}}
                                <span>{{ $workshop->instructor->name }}</span>
                            </div>
                            <div class="flex items-center">
                                @if ($workshop->instructor->ratings_count > 0)
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400"
                                        viewBox="0 0 24 24" fill="currentColor">
                                        <path
                                            d="M12 .587l3.668 7.564 8.332 1.151-6.064 5.874 1.515 8.277L12 18.813l-7.451 4.64 1.515-8.277-6.064-5.874 8.332-1.151z" />
                                    </svg>
                                    <span
                                        class="text-sm text-gray-600 ml-1">{{ number_format($workshop->instructor->average_rating, 1) ?? 'N/A' }}
                                        from {{ $workshop->instructor->ratings_count }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mt-6">
                            <x-button class="w-full">Register Now</x-button>
                        </div>
                    </x-card-content>
                </x-card>

            </div>
        </div>

        <div>

            <h2 class="text-2xl font-semibold mb-4 !text-2xl !font-semibold">About the Instructor</h2>

            @foreach (json_decode($workshop->what_you_will_learn) as $learningPoint)
                <li>{{ $learningPoint }}</li>
            @endforeach
        </div>

        <div>
            <h2 class="text-2xl font-semibold mb-4 !text-2xl !font-semibold">About the Instructor</h2>
            <div class="flex items-center space-x-4">
                <x-profile-avatar :src="$workshop->instructor->profile_picture_url" :alt="$workshop->instructor->name"
                    fallback="{{ collect(explode(' ', $workshop->instructor->name))->map(fn($n) => strtoupper($n[0]))->join('') }}"
                    size="h-16 w-16" />
                <div>
                    <h3 class="text-xl font-semibold">{{ $workshop->instructor->name }}</h3>
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
            <p class="mt-4">
                {{ $workshop->instructor->biography }}
            </p>
        </div>
    </section>

</x-app-layout>
