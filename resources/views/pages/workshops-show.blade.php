<x-app-layout>

    <section class="flex flex-col gap-12">
        <div class="grid md:grid-cols-3 gap-12 ">

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

                <div>

                    <h2 class="text-2xl font-semibold mb-4 !text-2xl !font-semibold">What you'll learn</h2>

                    @foreach (json_decode($workshop->objectives) as $objective)
                        <li>{{ $objective }}</li>
                    @endforeach
                </div>

            </div>

            <div>
                <x-card>
                    <x-card-header>
                        <x-card-title>Workshop Details</x-card-title>
                        <x-card-description>Key information about the workshop</x-card-description>
                    </x-card-header>
                    <x-card-content>
                        <div class="space-y-4">
                            <x-custom-label>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                </svg>
                                <span>{{ $workshop->date->format('M d, Y') }} at
                                    {{ $workshop->date->format('h:i A') }}</span>
                            </x-custom-label>
                            <x-custom-label>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                <span>{{ $workshop->duration }} minutes</span>
                            </x-custom-label>
                            <x-custom-label>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                                </svg>

                                <span>${{ number_format($workshop->price / 100, 2) }}</span>
                            </x-custom-label>
                            <x-custom-label>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>

                                <span>{{ $workshop->instructor->name }}</span>
                            </x-custom-label>
                            <x-custom-label>
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
                            </x-custom-label>
                        </div>
                        <div class="mt-6">
                            <x-button class="w-full">
                                <a href={{ route('workshops.payment', $workshop) }}>
                                    Register Now
                                </a>
                            </x-button>
                        </div>
                    </x-card-content>
                </x-card>

            </div>
        </div>



        <div class="">
            <h2 class="text-2xl font-semibold mb-4 !text-2xl !font-semibold">About the Instructor</h2>
            <div class="flex items-center space-x-4">
                <x-profile-avatar :user="$workshop->instructor" size="h-16 w-16" />
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
