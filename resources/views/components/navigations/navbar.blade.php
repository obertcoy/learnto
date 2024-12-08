<header className="bg-white shadow-sm">
    <nav class="max-w-7xl mx-auto flex w-full px-4 sm:px-6 lg:px-8 h-18 items-center justify-between">

        <a href="/" class="text-2xl font-medium text-foreground">
            LearnTo
        </a>


        <ul class="flex py-6 px-8 gap-x-4 text-base text-foreground items-center font-medium">
            @guest
                <li>
                    <a href={{ route('login') }}>
                        <x-button variant="outline">
                            Sign In
                        </x-button>
                    </a>
                </li>
                <li>
                    <a href={{ route('register') }}>

                        <x-button variant="default">
                            Register
                        </x-button>
                    </a>
                </li>
            @endguest
            @auth
                <li class="hover:text-muted-foreground transition-all">
                    <a href={{ route('workshops.explore') }}>
                        Explore
                    </a>
                </li>

                @if (auth()->user()->is_instructor)
                    <li class="hover:text-muted-foreground transition-all">
                        <a href={{ route('workshops.create') }}>
                            Create Workshop
                        </a>
                    </li>
                @endif

                <li class="ms-3">

                    <div class="group relative cursor-pointer !cursor-pointer">
                        <x-profile-avatar :user="auth()->user()" :redirect="false" />

                        <div
                            class="hidden group-focus-within:block absolute -bottom-3 left-0 -translate-x-1/2 translate-y-full w-64 h-fit z-10">

                            <x-card class="flex flex-col">

                                <x-card-header class="p-0 hover:bg-muted transition-colors relative">
                                    <x-custom-label :gap="3" class="flex items-center gap-3 z-10">
                                        <x-profile-avatar :user="auth()->user()" :redirect="false" />
                                        <h2 class="text-lg font-medium truncate">{{ auth()->user()->name }}</h2>
                                    </x-custom-label>
                                    <a href="{{ route('users.show', auth()->user()) }}" class="absolute inset-0 z-0"></a>
                                </x-card-header>


                                <hr>

                                <x-card-content class="w-full p-1 !p-1 flex flex-col gap-2">

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-button variant="default" class="w-full">
                                            Logout
                                        </x-button>
                                    </form>
                                </x-card-content>

                            </x-card>
                        </div>
                    </div>

                </li>

            @endauth
        </ul>



    </nav>
</header>
