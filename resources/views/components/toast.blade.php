<div id="toast"
    class="fixed flex items-center  bottom-6 right-3 w-80 min-h-16 p-4 border border-border bg-background rounded-md shadow opacity-0 transform translate-y-10 transition duration-300 ease-out">
    <x-custom-label :gap="3">
        @if ($type == 'success')
            <x-custom-icon icon="check" />
        @else
            <x-custom-icon icon="exclamation" />
        @endif
        <h2 class="text-left font-semibold text-sm">{{ $text }}</h2>
    </x-custom-label>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const toast = document.getElementById('toast');

        if (toast) {
            toast.classList.remove('opacity-0', 'translate-y-10');
            toast.classList.add('opacity-100', 'translate-y-0');

            setTimeout(() => {
                toast.classList.remove('opacity-100', 'translate-y-0');
                toast.classList.add('opacity-0', 'translate-y-10');

                setTimeout(() => {
                    toast.remove();
                }, 500);
            }, 3000);
        }

    });
</script>
