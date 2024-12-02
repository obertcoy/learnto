<x-app-layout>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 text-foreground mt-12 flex flex-col gap-6">
        <h1 class="text-4xl font-bold">{{ $workshop->name }}</h1>

        @foreach ($workshop->topics as $topic)
            <x-badge :variant='default'>
                {{ $topic->topic }}
            </x-badge>
        @endforeach
    </div>

</x-app-layout>
