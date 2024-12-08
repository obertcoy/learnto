<x-app-layout>

    <h2 class="text-4xl font-bold">Confirm Your Payment</h2>
    <section class="grid md:grid-cols-3 gap-6">

        <div class="md:col-span-2">

            <x-card>
                <x-card-header>

                    <h2 class="text-2xl font-semibold">Payment Details</h2>
                    <x-card-description><span>Please review your workshop details and enter your payment
                            information</span></x-card-description>

                </x-card-header>

                <x-card-content class="flex flex-col gap-3">

                    <h2 class="text-xl font-semibold">Workshop Information</h2>

                    <x-custom-label>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                        </svg>
                        <span>
                            {{ $workshop->date->format('M d, Y') }} at {{ $workshop->date->format('h:i A') }}
                        </span>
                    </x-custom-label>

                    <x-custom-label>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <span>Duration: {{ $workshop->duration }} minutes</span>
                    </x-custom-label>

                    <x-custom-label>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                        </svg>
                        <span>Price: Rp {{ $workshop->price }}</span>
                    </x-custom-label>


                </x-card-content>

                <x-card-footer>

                    <form action="{{ route('users.joinWorkshop', $workshop) }}" method="POST" class="w-full">
                        @csrf

                        <x-button class="w-full">
                            <a href="">Confirm Payment</a>
                        </x-button>

                    </form>
                </x-card-footer>


            </x-card>

        </div>

        <div class="h-full">

            <x-card class="h-full">
                <x-card-header>

                    <h2 class="text-2xl font-semibold">Order Summary</h2>

                </x-card-header>

                <x-card-content class="flex flex-col gap-3">

                    <div class="flex flex-row justify-between">
                        <span>Workshop Price</span>
                        <span>Rp {{ $workshop->price }}</span>
                    </div>

                    <div class="flex flex-row justify-between">
                        <span>Taxes (6%)</span>
                        <span>Rp {{ $taxes }}</span>
                    </div>

                    <hr>

                    <div class="flex flex-row justify-between text-lg font-bold">
                        <span>Total</span>
                        <span>Rp {{ $total }}</span>
                    </div>


                </x-card-content>

                <x-card-footer>

                    <x-card-description>
                        <span>
                            By confirming your payment, you agree to our Terms of Service and Privacy Policy.

                        </span>
                    </x-card-description>

                </x-card-footer>


            </x-card>

        </div>


    </section>


</x-app-layout>
