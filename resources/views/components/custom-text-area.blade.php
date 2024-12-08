<div class="relative">

    @if ($label)
        <p class= "text-base font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 mb-2">
            {{ $label }}</p>
    @endif
    <textarea id="{{ $id }}" name="{{ $name }}" placeholder="{{ $placeholder }}" rows="4"
    class="relative flex w-full rounded-md border border-input bg-background
    {{ $icon ? 'px-12' : 'px-3' }} py-2 text-base ring-offset-background
    file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground
    placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2
    focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed
    disabled:opacity-50 md:text-sm resize-none whitespace-pre-line">{{ old($name, $value ?? '') }}</textarea>

    @if ($icon)
        <x-dynamic-component :component="$icon" class="absolute inset-0 left-3 top-1/2 transform -translate-y-1/2 z-10" />
    @endif
</div>
