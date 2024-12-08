<div class="group w-full relative">

    @if ($label)
        <p class= "text-base font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 mb-3">
            {{ $label }}</p>
    @endif
    <input id="{{ $id }}-display" name="{{ $name }}-display" placeholder="{{ $placeholder }}"
        class="flex relative h-10 w-full rounded-md border border-input bg-background
    px-3 py-2 text-base ring-offset-background
    file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground
    placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2
    focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed
    disabled:opacity-50 md:text-sm"
        oninput="filterList('{{ $id }}')" onfocus="showDropdown('{{ $id }}')" autocomplete="off" />

    <input type="hidden" id="{{ $id }}" name="{{ $name }}">

    <div id="{{ $id }}-dropdown"
        class="z-20 absolute left-0 -bottom-3 translate-y-full hidden w-full max-h-[calc(5*48px)] overflow-auto rounded-md border border-border shadow">
        @foreach ($data as $item)
            @if ($valueKey)
                <div class="{{ $id }}-dropdown-item px-3 h-12 cursor-pointer border-b border-border bg-background hover:bg-muted transition-colors flex items-center"
                    data-key="{{ $item->id ?? $item->$valueKey }}" data-value="{{ $item->$valueKey }}"
                    onclick="selectValue('{{ $id }}', event)">
                    <span class="my-auto">{{ $item->$valueKey }}</span>
                </div>
            @else
                <div class="{{ $id }}-dropdown-item px-3 h-12 cursor-pointer border-b border-border bg-background hover:bg-muted transition-colors flex items-center"
                    data-key="{{ $item }}" data-value="{{ $item }}"
                    onclick="selectValue('{{ $id }}', event)">
                    <span class="my-auto">{{ $item }}</span>
                </div>
            @endif
        @endforeach
    </div>

</div>


<script>
    function showDropdown(id) {
        const dropdown = document.getElementById(`${id}-dropdown`);
        dropdown.classList.remove('hidden');
    }

    function filterList(id) {
        const inputDisplay = document.getElementById(`${id}-display`);
        const filter = inputDisplay.value.toLowerCase();
        const items = document.querySelectorAll(`.${id}-dropdown-item`);

        items.forEach(item => {
            const text = item.getAttribute('data-value');
            item.style.display = text.toLowerCase().includes(filter) ? 'block' : 'none';
        });
    }

    function selectValue(id, event) {
        const input = document.getElementById(`${id}`);
        const inputDisplay = document.getElementById(`${id}-display`);

        const dropdown = document.getElementById(`${id}-dropdown`);
        const selectedItem = event.target;
        const selectedKey = selectedItem.getAttribute('data-key');
        const selectedValue = selectedItem.getAttribute('data-value');

        input.value = selectedKey;
        inputDisplay.value = selectedValue;

        dropdown.classList.add('hidden');
    }

    document.addEventListener('click', function(event) {
        const dropdowns = document.querySelectorAll('[id$="-dropdown"]');
        const inputs = document.querySelectorAll('[id$="-display"]');

        dropdowns.forEach((dropdown) => {
            const inputId = dropdown.id.replace('-dropdown', '-display');
            const input = document.getElementById(inputId);

            if (!input.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });
    });
</script>
