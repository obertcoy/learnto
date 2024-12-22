<x-app-layout>

    <section class="flex flex-col gap-12">

        <h2 class="text-4xl font-bold">{{ $workshop->name }}'s Reviews ({{ $workshop->reviewsCount() }})</h2>

        <div class="grid grid-cols-3 gap-3">

            @foreach ($workshop->reviews as $review)
                <x-card>

                    <x-card-header>
                        <div class="flex items-center space-x-4">
                            <x-profile-avatar :user="$review->user" size="h-12 w-12" />
                            <h4 class="text-xl font-semibold">{{ $review->user->name }}</h4>

                        </div>
                    </x-card-header>

                    <x-card-content>

                        <span class="text-foreground">{{$review->content}}</span>

                    </x-card-content>

                    <x-card-footer>
                        <span class="text-sm ms-auto">
                            {{ $review->created_at->format('M d, Y') }} at {{ $review->created_at->format('h:i A') }}
                        </span>
                    </x-card-footer>

                </x-card>
            @endforeach
        </div>

    </section>

</x-app-layout>
