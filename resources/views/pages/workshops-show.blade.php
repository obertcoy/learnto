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

                            @auth

                                @if ($workshop->users->contains(auth()->user()) && $workshop->status == 'Upcoming')
                                    <div class="flex items-center">
                                        <a href="{{ $workshop->vc_link }}" class=" text-blue-600 hover:underline">
                                            Join video call
                                        </a>
                                    </div>
                                @endif

                            @endauth

                        </div>
                        <div class="mt-6">

                            @auth

                                @if (auth()->user()->is_admin)
                                    <form action="{{ route('workshops.destroy', $workshop) }}" method="POST"
                                        class="flex flex-col w-full gap-2">
                                        @csrf
                                        @method('DELETE')

                                        <input type="hidden" name="complete_workshop"
                                            value="{{ $workshop->date >= now() ? true : false }}">
                                        <x-button variant="destructive">
                                            Delete Workshop
                                        </x-button>

                                    </form>
                                @else
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

                                @endif
                            @endauth

                            @guest

                                <x-register-workshop-button :workshop="$workshop" class="w-full" />

                            @endguest

                        </div>

                    </x-card-content>
                </x-card>

            </div>
        </div>


        @auth

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
                            <div class="flex items-center gap-0.5">

                                @if ($averageRating > 0)
                                    <x-custom-icon icon="star" />

                                    <span
                                        class="text-sm text-gray-600 ml-1"><b>{{ number_format($averageRating, 1) ?? 'N/A' }}</b>
                                        from <b>{{ $totalStudents }} students</b></span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <p class="mt-4">
                        {{ $workshop->instructor->biography }}
                    </p>
                </div>
            @endif

        @endauth


    </section>

    @section('modal')
        @auth
            @if ($showCongratulationsModal)
                <x-modal-overlay id="congratulations-modal">


                    <x-card class="min-w-[240px] w-1/3 py-3 relative">

                        <button onclick="hideModal()" class="absolute top-6 right-6">
                            <x-custom-icon icon='close' />
                        </button>

                        <x-card-header class="flex flex-col items-center">

                            <x-card-title>
                                <h2>Congratulations!!!</h2>
                            </x-card-title>

                            <x-card-description class='font-light'>You have finished the workshop</x-card-description>

                        </x-card-header>


                        <x-card-content>

                            <form action="{{ route('workshops.update', $workshop) }}" method="post"
                                class="flex flex-col gap-6">
                                @csrf
                                @method('PATCH')

                                <div class="flex flex-col items-center gap-3">
                                    <div x-data="{ rating: 0 }" class="flex flex-col items-center">
                                        <div class="flex flex-row gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 cursor-pointer"
                                                :class="{ 'text-yellow-400': rating >= 1, 'text-gray-400': rating < 1 }"
                                                @click="rating = 1" fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M12 .587l3.668 7.564 8.332 1.151-6.064 5.874 1.515 8.277L12 18.813l-7.451 4.64 1.515-8.277-6.064-5.874 8.332-1.151z" />
                                            </svg>

                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 cursor-pointer"
                                                :class="{ 'text-yellow-400': rating >= 2, 'text-gray-400': rating < 2 }"
                                                @click="rating = 2" fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M12 .587l3.668 7.564 8.332 1.151-6.064 5.874 1.515 8.277L12 18.813l-7.451 4.64 1.515-8.277-6.064-5.874 8.332-1.151z" />
                                            </svg>

                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 cursor-pointer"
                                                :class="{ 'text-yellow-400': rating >= 3, 'text-gray-400': rating < 3 }"
                                                @click="rating = 3" fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M12 .587l3.668 7.564 8.332 1.151-6.064 5.874 1.515 8.277L12 18.813l-7.451 4.64 1.515-8.277-6.064-5.874 8.332-1.151z" />
                                            </svg>

                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 cursor-pointer"
                                                :class="{ 'text-yellow-400': rating >= 4, 'text-gray-400': rating < 4 }"
                                                @click="rating = 4" fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M12 .587l3.668 7.564 8.332 1.151-6.064 5.874 1.515 8.277L12 18.813l-7.451 4.64 1.515-8.277-6.064-5.874 8.332-1.151z" />
                                            </svg>

                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 cursor-pointer"
                                                :class="{ 'text-yellow-400': rating >= 5, 'text-gray-400': rating < 5 }"
                                                @click="rating = 5" fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M12 .587l3.668 7.564 8.332 1.151-6.064 5.874 1.515 8.277L12 18.813l-7.451 4.64 1.515-8.277-6.064-5.874 8.332-1.151z" />
                                            </svg>
                                        </div>


                                        <input type="hidden" id="workshop-rating" name="rating" :value="rating">
                                    </div>


                                    <x-card-description>Rate the workshop</x-card-description>
                                </div>


                                <hr>

                                <div class="flex flex-col">

                                    <x-custom-text-area id="workshop-review" name="review" label="Review:"
                                        placeholder="It's great, courses are very straightforward" value="" />

                                </div>


                                <x-button variant="default">
                                    Submit
                                </x-button>

                            </form>
                        </x-card-content>

                    </x-card>

                </x-modal-overlay>
            @endif
        @endauth
    @endsection
</x-app-layout>

<script>
    function hideModal() {
        const modal = document.getElementById('congratulations-modal');
        if (modal) {
            modal.style.display = 'none';
        }
    }
</script>
