<div class="relative w-full">

    @if ($label)
        <p class= "text-base font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 mb-3">
            {{ $label }}</p>
    @endif
    <input id="{{ $id }}" name="{{ $name }}" placeholder="{{ $placeholder }}" type="{{ $type }}"
        value="{{ $value }}"
        class="relative flex h-10 w-full rounded-md border border-input bg-background
        {{ $icon || $iconText ? 'px-12' : 'px-3' }} py-2 text-base ring-offset-background
        file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground
        placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2
        focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed
        disabled:opacity-50 md:text-sm">
    @if ($icon)
        <x-dynamic-component :component="$icon" class="absolute inset-0 left-3 top-1/2 transform -translate-y-1/2 z-10" />
    @endif
    @if ($iconText)
        <span class="absolute inset-0 h-10 top-1/2 translate-y-0.5 left-3 transform z-10 w-fit pointer-events-none">
            {{ $iconText }}
        </span>
    @endif
</div>
