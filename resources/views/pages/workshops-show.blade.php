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

                    @foreach ($workshop->objectives as $objective)
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
                                <x-custom-icon icon="calendar" />

                                <span>{{ $workshop->date->format('M d, Y') }} at
                                    {{ $workshop->date->format('h:i A') }}</span>
                            </x-custom-label>

                            <x-custom-label>
                                <x-custom-icon icon="clock" />

                                <span>{{ $workshop->duration }} minutes</span>
                            </x-custom-label>

                            <x-custom-label>
                                <x-custom-icon icon="money" />


                                <span>Rp {{ $workshop->price }}</span>
                            </x-custom-label>

                            <x-custom-label>
                                <x-custom-icon icon="user" />

                                <span>{{ $workshop->instructor->name }}</span>
                            </x-custom-label>

                            @if ($workshop->users->contains(auth()->user()) && $workshop->status == 'Upcoming')
                                <div class="flex items-center">
                                    <a href="{{ $workshop->vc_link }}" class=" text-blue-600 hover:underline">
                                        Join video call
                                    </a>
                                </div>
                            @endif
                        </div>
                        <div class="mt-6">
                            @if ($workshop->status == 'Upcoming')
                                @if (auth()->user()->id === $workshop->instructor_id)
                                    <form action="{{ route('workshops.update', $workshop) }}" method="POST"
                                        class="flex flex-col w-full gap-2">
                                        @csrf
                                        @method('PATCH')

                                        <input type="hidden" name="complete_workshop"
                                            value="{{ $workshop->date >= now() ? true : false }}">
                                        <x-button variant="{{ $workshop->date->isPast() ? 'default' : 'muted' }}">
                                            Complete Workshop
                                        </x-button>

                                        <span class="text-sm text-yellow-600 mx-auto">Workshop can only be completed
                                            after the
                                            planned date.</span>
                                    </form>
                                @else
                                    <x-register-workshop-button :workshop="$workshop" class="w-full" />
                                @endif
                            @else
                                <x-button variant="muted" class="w-full">
                                    Completed
                                </x-button>
                            @endif

                        </div>
                    </x-card-content>
                </x-card>

            </div>
        </div>


        @if (auth()->user()->id === $workshop->instructor_id)

            <div class="flex flex-col gap-3">

                <h2 class="text-2xl font-semibold mb-4 !text-2xl !font-semibold">Attendees
                    ({{ $workshop->usersCount() }})</h2>
                <div class="grid grid-cols-3 gap-6">
                    @foreach ($attendees as $attendant)
                        <div class="flex flex-row gap-3 items-center">
                            <x-profile-avatar :user="$attendant" size="h-16 w-16" />
                            <span>{{ $attendant->name }}</span>
                        </div>
                    @endforeach
                </div>

            </div>
            {{ $attendees->links() }}
        @else
            <div>
                <h2 class="text-2xl font-semibold mb-4 !text-2xl !font-semibold">About the Instructor</h2>
                <div class="flex items-center space-x-4">
                    <x-profile-avatar :user="$workshop->instructor" size="h-16 w-16" />
                    <div>
                        <h3 class="text-xl font-semibold">{{ $workshop->instructor->name }}</h3>
                        <div class="flex items-center">
                            @if ($workshop->instructor->ratings_count > 0)
                                <x-custom-icon icon="star" />

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
        @endif
    </section>

</x-app-layout>
