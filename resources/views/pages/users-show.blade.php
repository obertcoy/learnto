<x-app-layout>

    <section class="grid md:grid-cols-3 gap-6 relative">

        <div class="sticky top-12 h-fit">

            <x-card>

                <x-card-header>

                    <div class="flex items-center gap-6">

                        <x-profile-avatar :user="$user" size="h-24 w-24" redirect="{{ false }}" />

                        <div class="flex flex-col justify-center">
                            <h2 class="text-2xl font-semibold !text-2xl !font-semibold">{{ $user->name }}</h2>
                            <x-card-description>{{ $user->email }}</x-card-description>
                        </div>
                    </div>
                </x-card-header>

                <x-card-content>

                    <x-custom-input name="Bio" label="Bio" placeholder="Tell us about yourself..." />


                </x-card-content>


            </x-card>

        </div>

        <div class="md:col-span-2 gap-6 flex flex-col">

            <div class="p-1 bg-muted w-fit shadow-sm rounded-sm">
                @foreach ($tabs as $tab)
                    <x-tabs-header :currentValue="$activeTab" :value="$tab" :user="$user" route="users.show" />
                @endforeach
            </div>

            {{-- @dd($data) --}}

            @if(count($data) > 0)

                @foreach ($data as $item)

                    <x-cards.simple-workshop-card :workshop="$item" />
                    
                @endforeach

            @else

                @if($activeTab == 'Created Workshops' && !$user->instructor)
                    <span class="text-muted-foreground text-sm font-medium m-auto">User is not an instructor.</span>
                @endif
                
                <span class="text-muted-foreground text-sm font-medium m-auto">No data found.</span>

            @endif
            

        </div>


    </section>


</x-app-layout>
