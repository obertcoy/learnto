<x-app-layout>

    <section class="grid md:grid-cols-3 gap-6">

        <div class="sticky top-12 h-fit flex flex-col gap-6">

            <x-card>

                <x-card-header class="relative">

                    <div class="flex items-center gap-6">

                        <x-profile-avatar :user="$user" size="h-24 w-24" redirect="{{ false }}" />


                        <div class="flex flex-col justify-center">
                            <h2 class="text-2xl font-semibold !text-2xl !font-semibold">{{ $user->name }}</h2>
                            <x-card-description>{{ $user->email }}</x-card-description>

                        </div>
                    </div>

                </x-card-header>

                <x-card-content>

                    @if (auth()->user() == $user)
                        <form action="{{ route('users.update', $user) }}" method="post" class="flex flex-col gap-6">
                            @csrf
                            @method('PATCH')
                            <x-custom-textarea id="profile-bio-input" name="biography" label="Bio"
                                placeholder="Tell us about yourself..." value="{{ $user->biography }}" />

                            <x-button variant="default">
                                Update Profile
                            </x-button>

                        </form>
                    @else
                        <span>{{ $user->biography }}</span>
                    @endif

                </x-card-content>


            </x-card>

            <x-card>


                @if (!$user->is_instructor)
                    @if (auth()->user() == $user)
                        <x-card-header class="flex flex-col items-center text-center gap-3">

                            <div>
                                <h2 class="text-xl font-semibold">Become an Instructor</h2>
                                <x-card-description class="text-lg">Share your knowledge by creating
                                    workshops</x-card-description>
                            </div>

                            <form action="{{ route('users.update', $user) }}" method="post"
                                class="flex flex-col w-full gap-2">
                                @csrf
                                @method('PATCH')

                                <x-button variant="default">
                                    Become an Instructor
                                </x-button>

                                <span class="text-sm text-yellow-600">Please fill out your bio (at least 50 characters)
                                    to
                                    become an instructor.</span>
                            </form>

                        </x-card-header>
                    @else
                        <x-card-description class="m-auto">
                            User is not an instructor
                        </x-card-description>
                    @endif
                @else
                    <x-card-header>
                        <div class="flex flex-row justify-between">
                            <h2 class="text-lg font-semibold">Instructor Profile</h2>
                            <x-badge :variant="$user->is_insturctor ? 'default' : 'secondary'">

                                @if ($user->is_insturctor)
                                    Instructor
                                @else
                                    Not an Instructor
                                @endif
                            </x-badge>
                        </div>
                    </x-card-header>

                    <x-card-content class="flex flex-col gap-1 font-medium">

                        <x-custom-label>
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5 text-yellow-400" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path
                                    d="M12 .587l3.668 7.564 8.332 1.151-6.064 5.874 1.515 8.277L12 18.813l-7.451 4.64 1.515-8.277-6.064-5.874 8.332-1.151z" />
                            </svg>
                            {{ number_format($averageRating, 1) }} Average Rating
                        </x-custom-label>
                        <x-custom-label>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                            </svg>

                            {{ $totalStudents }} Total Students
                        </x-custom-label>
                        <x-custom-label>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                            </svg>


                            {{ $createdWorkshops }} Workshops Created
                        </x-custom-label>

                    </x-card-content>
                    
                @endif






            </x-card>

        </div>

        <div class="md:col-span-2 gap-6 flex flex-col">

            <div class="p-1 bg-muted w-fit shadow-sm rounded-sm">
                @foreach ($tabs as $tab)
                    <x-tabs-header :currentValue="$activeTab" :value="$tab" :user="$user" route="users.show" />
                @endforeach
            </div>

            {{-- @dd($data) --}}

            @if (count($data) > 0)

                @foreach ($data as $item)
                    <x-cards.simple-workshop-card :workshop="$item" />
                @endforeach
            @else
                @if ($activeTab == 'Created Workshops' && !$user->instructor)
                    <span class="text-muted-foreground text-sm font-medium m-auto">User is not an instructor.</span>
                @endif

                <span class="text-muted-foreground text-sm font-medium m-auto">No data found.</span>

            @endif


        </div>


    </section>


</x-app-layout>
