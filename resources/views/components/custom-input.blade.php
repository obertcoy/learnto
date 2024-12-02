<div class="relative">
    <input 
        name="{{ $name }}" 
        placeholder="{{ $placeholder }}" 
        type="{{ $type }}"
        class="relative flex h-10 w-full rounded-md border border-input bg-background px-12 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm">

    @if ($icon)
        <x-dynamic-component :component="$icon" class="absolute inset-0 left-3 top-1/2 transform -translate-y-1/2 z-10" />
    @endif
</div>