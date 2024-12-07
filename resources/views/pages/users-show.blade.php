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

                @if (auth()->user() == $user && !$user->is_instructor)
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

                            <input type="hidden" name="become_instructor" value="true">
                            <x-button variant="default">
                                Become an Instructor
                            </x-button>

                            <span class="text-sm text-yellow-600">Please fill out your bio (at least 50 characters) to
                                become an instructor.</span>
                        </form>
                    </x-card-header>
                @elseif (auth()->user() == $user || $user->is_instructor)
                    <x-card-header>
                        <div class="flex flex-row justify-between">
                            <h2 class="text-lg font-semibold">Instructor Profile</h2>
                            <x-badge :variant="$user->is_instructor ? 'default' : 'secondary'">
                                {{ $user->is_instructor ? 'Instructor' : 'Not an Instructor' }}
                            </x-badge>
                        </div>
                    </x-card-header>

                    <x-card-content class="flex flex-col gap-1 font-medium">
                        @if ($user->is_instructor)
                            <x-custom-label>
                                <x-custom-icon icon="star" />

                                {{ number_format($averageRating, 1) }} Average Rating
                            </x-custom-label>
                            <x-custom-label>
                                <x-custom-icon icon="users" />

                                {{ $totalStudents }} Total Students
                            </x-custom-label>
                            <x-custom-label>
                                <x-custom-icon icon="workshop" />
                                {{ $createdWorkshops }} Workshops Created
                            </x-custom-label>
                        @else
                            <x-card-description class="w-full h-full flex items-center justify-center p-0">
                                User is not an instructor
                            </x-card-description>
                        @endif
                    </x-card-content>
                @else
                    <x-card-header>
                        <div class="flex flex-row justify-between">
                            <h2 class="text-lg font-semibold">Instructor Profile</h2>
                            <x-badge :variant="$user->is_instructor ? 'default' : 'secondary'">
                                {{ $user->is_instructor ? 'Instructor' : 'Not an Instructor' }}
                            </x-badge>
                        </div>
                    </x-card-header>

                    <x-card-content class="border border-border rounded-md m-3 p-0 pt-3 pb-3">
                        <x-card-description class="w-full h-full flex items-center justify-center p-0">
                            User is not an instructor
                        </x-card-description>
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
    {{-- @dd(session('success')) --}}

    @if (session('success'))
        <x-toast type="success" text="{{ session('success') }}" />
    @elseif(session('failed'))
        <x-toast type="failed" text="{{ session('failed') }}" />
    @endif

</x-app-layout>
