<x-app-layout>

    <h2 class="text-4xl font-bold">Create a New Workshop</h2>
    <section>

        <x-card>
            <x-card-header>
                <h2 class="text-2xl font-semibold">Workshop Details</h2>
                <x-card-description>Fill in the details for your new workshop</x-card-description>

            </x-card-header>

            <x-card-content class="flex flex-col gap-3 mt-3">

                <x-custom-input name="create-title-input" label="Workshop Title" placeholder="Enter the title of your workshop"/>

                <x-custom-textarea name="create-description-input" label="Description" placeholder="Describe your workshop"/>

                <div class="flex flex-row w-full gap-3">
                    

                </div>


            </x-card-content>

        </x-card>

    </section>

</x-app-layout>