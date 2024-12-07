<div class="group">
    <input id="{{ $id }}" name="{{ $name }}" placeholder="{{ $placeholder }}" type="{{ $type }}"
        class="relative flex h-10 w-full rounded-md border border-input bg-background 
    px-3 py-2 text-base ring-offset-background 
    file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground 
    placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 
    focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed 
    disabled:opacity-50 md:text-sm"
        oninput="filterList()" autocomplete="off">

    <div id="dropdown" class="hidden group-focus-within:block w-32 max-h-64 overflow-auto rounded-md border border-border shadow">
        @foreach ($data as $item)
            <div class="dropdown-item px-3 py-2 cursor-pointer border-b border-border" data-key="{{ $item->$id ?? $item->$key }}"
                onclick="selectValue(event)">
                {{ $item->$key }}
            </div>
        @endforeach
    </div>

</div>


<script>
    function filterList() {
        let input = document.getElementById('{{ $id }}');
        let filter = input.value.toLowerCase();
        let items = document.querySelectorAll('.dropdown-item');

        items.forEach(item => {

            let text = item.textContent || item.innerText;
            if (text.toLowerCase().includes(filter)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });

        let dropdown = document.getElementById('dropdown');
        if (filter.length > 0 && Array.from(items).some(item => item.style.display !== 'none')) {
            dropdown.classList.remove('hidden');
        } else {
            dropdown.classList.add('hidden');
        }
    }

    function selectValue(e) {
        let input = document.getElementById('{{ $id }}');
        let dropdown = document.getElementById('dropdown');
        let selectedKey = e.target.getAttribute('data-key');

        input.value = selectedKey;

        dropdown.classList.add('hidden');
    }
</script>
