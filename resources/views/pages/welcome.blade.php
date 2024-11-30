<x-app-layout>

    {{-- <x-navigations.welcome-navigation /> --}}

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 text-foreground mt-12">
        <section class="text-center mb-16">
            <h1 class="text-4xl font-bold mb-4">Learn and Teach on
                <span class="bg-primary text-background py-2 px-2 ms-2">LearnTo</span>
            </h1>
            <p class="text-xl text-gray-600 mb-8">Discover amazing online workshops or share your expertise
                with the world</p>
            <div class="flex justify-center space-x-4">
                <x-button size="lg">Explore Workshops</x-button>
                <x-button size="lg" variant="outline">Become an Instructor</x-button>
            </div>
        </section>

        <section class="mb-16 w-fit mx-auto">
            <h2 class="text-2xl font-semibold mb-6">Featured Workshops</h2>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mx-auto">
                @foreach ($featureds as $workshop)
                    <x-cards.workshop-card :workshop="$workshop" />
                @endforeach
            </div>
        </section>

        <section class="text-center">
            <h2 class="text-2xl font-semibold mb-4">Ready to start learning?</h2>
            <x-button size="lg">Browse All Workshops</x-button>
        </section>
    </div>
</x-app-layout>
