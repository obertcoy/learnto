<x-app-layout>

    <div class="flex flex-col max-w-5xl mx-auto w-full gap-6">

        <h2 class="text-4xl font-bold">Create a New Workshop</h2>
        <section class="w-full">

            <x-card>
                <x-card-header>
                    <h2 class="text-2xl font-semibold">Workshop Details</h2>
                    <x-card-description>Fill in the details for your new workshop</x-card-description>

                </x-card-header>

                <x-card-content>

                    <form method="POST" action="{{ route('workshops.store') }}" class="flex flex-col gap-6 mt-3">
                        @csrf

                        <x-custom-input name="create-name-input" label="Workshop Name"
                            placeholder="Enter the name of your workshop" />

                        <x-custom-textarea name="create-description-input" label="Description"
                            placeholder="Describe your workshop" />

                        <x-custom-textarea name="create-objectives-input"
                            label="Objectives (Enter each objective as a bullet point)"
                            placeholder="- Learn React
                    - Learn Custom Hook" />


                        <x-custom-single-select id="create-topic-select" name="create-topic-select" label="Topic"
                            placeholder="Select the topics of your workshop" :data="$topics" :valueKey="'topic'" />

                        <div class="flex flex-row w-full gap-6">

                            <x-custom-input name="create-date-input" label="Date" type="date"
                                placeholder="Date of your workshop" />

                            <x-custom-single-select id="create-time-select" name="create-time-select" label="Time"
                                placeholder="Pick a time" :data="$times" />
                        </div>

                        <div class="flex flex-row w-full gap-6">

                            <x-custom-input id="create-duration-input" name="create-duration-input"
                                label="Duration (minutes)" type="number" placeholder="e.g. 90" />

                            <x-custom-input id="create-price-input" name="create-price-input" label="Price (Rupiah)"
                                type="number" placeholder="e.g. 10000000" iconText="Rp" />
                        </div>

                        <x-custom-input name="create-link-input" label="Video Conference Link"
                            placeholder="e.g., https://zoom.us/j/1234567890" />


                        <x-button class="w-full">
                            <span>Create Workshop</span>
                        </x-button>

                    </form>

                </x-card-content>

            </x-card>

        </section>

    </div>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <x-toast type="failed" :text="$error" />
        @endforeach
    @endif
</x-app-layout>
