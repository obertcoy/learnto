<header className="bg-white shadow-sm">
    <nav class="max-w-7xl mx-auto flex w-full px-4 sm:px-6 lg:px-8 h-16 items-center justify-between">

        <a href="/" class="text-2xl font-medium text-foreground">
            LearnTo
        </a>
        <ul class="flex py-6 px-8 gap-x-4 text-base text-foreground">
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
        </ul>
    </nav>
</header>
