@php
$baseClasses = 'inline-flex items-center justify-center gap-2 rounded-md text-sm font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none';
$variantClasses = [
    'default' => 'bg-primary text-white hover:bg-primary',
    'destructive' => 'bg-red-500 text-white hover:bg-red-600',
    'outline' => 'border border-gray-300 bg-white text-gray-700 hover:bg-gray-100',
    'secondary' => 'bg-gray-200 text-gray-700 hover:bg-gray-300',
    'ghost' => 'hover:bg-gray-100 text-gray-700',
    'link' => 'text-primary underline hover:no-underline',
    'muted' => 'bg-muted text-muted-foreground hover:bg-border outline outline-1 outline-border outline-offset-2 cursor-not-allowed',
];
$sizeClasses = [
    'default' => 'h-10 px-4 py-2',
    'sm' => 'h-9 px-3',
    'lg' => 'h-11 px-8',
    'icon' => 'h-10 w-10',
];
@endphp

<button
    {{ $attributes->merge(['class' => "$baseClasses {$variantClasses[$variant]} {$sizeClasses[$size]}"]) }}
    type="submit"
>
    {{ $slot }}
</button>
