<div
    class="inline-flex items-center justify-center whitespace-nowrap rounded-sm px-3 py-1.5 text-sm font-medium 
        {{ $currentValue == $value ? 'bg-background text-foreground shadow-sm' : 'bg-muted text-muted-foreground' }}">

    <a href="{{ $user ? route($route, ['user' => $user, 'tab' => $value]) : route($route, ['tab' => $value]) }}">
        {{ $value }}
    </a>
</div>
