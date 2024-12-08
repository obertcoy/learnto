<x-app-layout>

    <section>

        <h1 class="text-4xl font-bold !text-4xl !font-bold mb-4">Explore Workshops</h1>
        <form method="GET" action={{ route('workshops.explore') }} class="flex flex-row gap-3 items-center">
            <x-custom-input id="explore-search-input" name="search" placeholder="Search workshops..."
                value="{{ request('search') }}" />
            <x-button>
                Search
            </x-button>
            <input type="hidden" name="duration" value="{{ request('duration', 'any') }}">
            <input type="hidden" name="topics[]" value="{{ implode(',', request('topics', [])) }}">
        </form>
    </section>


    <section class="flex flex-col md:flex-row gap-6 relative">
        <aside class="md:w-52 sticky top-6 h-fit">
            <div class="space-y-6">
                <div>
                    <h2 class="text-lg font-semibold mb-2">Topics</h2>
                    <form id="explore-topic-form" method="GET" action={{ route('workshops.explore') }}
                        class="space-y-2">
                        @foreach ($topTopics as $topic)
                            <div class="flex items-center">
                                <input type="checkbox" id="topic-{{ $topic->id }}" name="topics[]"
                                    value="{{ $topic->id }}" class="explore-topic-checkbox"
                                    {{ in_array($topic->id, request('topics', [])) ? 'checked' : '' }} />
                                <label for="topic-{{ $topic->id }}" class="ml-2">{{ $topic->topic }}</label>
                            </div>
                        @endforeach
                        <input type="hidden" name="search" value="{{ request('search') }}">
                        <input type="hidden" name="duration" value="{{ request('duration', 'any') }}">
                    </form>
                </div>

                <div class="w-full">
                    <h2 class="text-lg font-semibold mb-2">Duration</h2>
                    <form method="GET" action="{{ route('workshops.explore') }}" id="explore-duration-form">
                        <select name="duration" class="w-full border border-input rounded-md"
                            id="explore-duration-select">
                            <option class="explore-duration-option" value="any"
                                {{ request('duration', 'any') == 'any' ? 'selected' : '' }}>Any</option>
                            <option class="explore-duration-option" value="short"
                                {{ request('duration') == 'short' ? 'selected' : '' }}>0-2 hours</option>
                            <option class="explore-duration-option" value="medium"
                                {{ request('duration') == 'medium' ? 'selected' : '' }}>2-4 hours</option>
                            <option class="explore-duration-option" value="long"
                                {{ request('duration') == 'long' ? 'selected' : '' }}>4+ hours</option>

                            <input type="hidden" name="search" value="{{ request('search') }}">
                            <input type="hidden" name="topics[]" value="{{ implode(',', request('topics', [])) }}">
                        </select>
                    </form>
                </div>

            </div>

        </aside>

        <div class="w-fit">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                @foreach ($workshops as $workshop)
                    <div class="explore-workshop-card">
                        <x-cards.workshop-card :workshop="$workshop" />
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <div class="container mt-auto py-4 mx-auto">

        {{ $workshops->links() }}
    </div>
</x-app-layout>

<script>
    document.querySelectorAll('.explore-topic-checkbox').forEach((element) => {
        element.addEventListener('change', function() {
            document.getElementById('explore-topic-form').submit();
        });
    });

    document.getElementById('explore-duration-select').addEventListener('change', function() {
        document.getElementById('explore-duration-form').submit();
    })
</script>
