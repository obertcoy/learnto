<x-app-layout>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 text-foreground mt-12 flex flex-col gap-6">
        <section>

            <h1 class="text-4xl font-bold !text-4xl !font-bold mb-4">Explore Workshops</h1>
            <x-custom-input name="search" placeholder="Search workshops..." icon="bi-search" />
        </section>


        <section class="flex flex-col md:flex-row gap-6 relative">
            <aside class="flex-1 md:w-64 sticky top-12 h-fit">
                <div class="space-y-6">
                    <div>
                        <h2 class="text-lg font-semibold mb-2">Topics</h2>
                        <div class="space-y-2">
                            @foreach ($topTopics as $topic)
                                <div class="flex items-center">
                                    <input type="checkbox" id="topic-{{ $topic->id }}" name="topics[]"
                                        value="{{ $topic->id }}" class="checkbox" />
                                    <label for="topic-{{ $topic->id }}" class="ml-2">{{ $topic->topic }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="w-full">
                        <h2 class="text-lg font-semibold mb-2">Duration</h2>
                        <select name="duration" class="w-full border border-input rounded-md">
                            <option value="any" {{ old('duration', 'any') == 'any' ? 'selected' : '' }}>Any</option>
                            <option value="short" {{ old('duration') == 'short' ? 'selected' : '' }}>0-2 hours</option>
                            <option value="medium" {{ old('duration') == 'medium' ? 'selected' : '' }}>2-4 hours
                            </option>
                            <option value="long" {{ old('duration') == 'long' ? 'selected' : '' }}>4+ hours</option>
                        </select>
                    </div>

                </div>

            </aside>

            <div class="w-fit">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    @foreach ($workshops as $workshop)
                        <x-cards.workshop-card :workshop="$workshop" />
                    @endforeach
                </div>
            </div>
        </section>


        <div>

            {{ $workshops->links() }}
        </div>

    </div>
</x-app-layout>
