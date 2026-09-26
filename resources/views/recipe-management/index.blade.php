<x-app-layout>
    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            {{-- Page heading --}}
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800">
                    Recipe Management
                </h1>
                <p class="mt-1 text-sm text-gray-600">
                    Assign inventory items and quantities required to prepare each menu item.
                </p>
            </div>

            {{-- Success message --}}
            @if (session('success'))
            <div class="mb-4 rounded-lg bg-green-100 p-3 text-green-800">
                {{ session('success') }}
            </div>
            @endif

            {{-- Validation errors --}}
            @if ($errors->any())
            <div class="mb-4 rounded-lg bg-red-100 p-3 text-red-800">
                <p class="font-semibold">Please check the form:</p>
                <ul class="mt-2 list-inside list-disc text-sm">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            {{-- Scrollable menu item list --}}
            <div class="max-h-[80vh] space-y-5 overflow-y-auto pr-2">

                @forelse ($menuItems as $menuItem)
                <section class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">

                    {{-- Menu item heading and recipe status --}}
                    <div class="flex flex-wrap items-center justify-between gap-2 border-b border-gray-100 px-5 py-4">
                        <div>
                            <h2 class="font-semibold text-gray-800">
                                {{ $menuItem->name }}
                            </h2>

                            <p class="text-sm text-gray-500">
                                Base price: ₱{{ number_format($menuItem->base_price, 2) }}
                            </p>
                        </div>

                        @if ($menuItem->recipeItems->isEmpty())
                        <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-medium text-amber-800">
                            Stock Not Set
                        </span>
                        @else
                        <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-medium text-green-800">
                            Recipe Set
                        </span>
                        @endif
                    </div>

                    {{-- Existing recipe ingredients --}}
                    <div class="overflow-x-auto px-5 py-4">
                        @if ($menuItem->recipeItems->isNotEmpty())
                        <table class="w-full text-left text-sm">
                            <thead class="text-xs uppercase text-gray-500">
                                <tr>
                                    <th class="pb-2 pr-4">Inventory item</th>
                                    <th class="pb-2 pr-4">Quantity required</th>
                                    <th class="pb-2">Unit</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-100">
                                @foreach ($menuItem->recipeItems as $recipeItem)
                                <tr>
                                    <td class="py-2 pr-4 text-gray-800">
                                        {{ $recipeItem->inventoryItem?->name ?? 'Inventory item unavailable' }}
                                    </td>

                                    <td class="py-2 pr-4 text-gray-700">
                                        {{ $recipeItem->quantity_required }}
                                    </td>

                                    <td class="py-2 text-gray-700">
                                        {{ $recipeItem->inventoryItem?->unit?->abbreviation ?? '—' }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <p class="text-sm text-gray-500">
                            No recipe ingredients have been assigned yet.
                        </p>
                        @endif
                    </div>

                    {{-- Recipe editor form for this menu item --}}
                    <form action="{{ route('recipe-management.store') }}"
                        method="POST"
                        class="border-t border-gray-100 px-5 py-4">
                        @csrf

                        <input type="hidden"
                            name="menu_item_id"
                            value="{{ $menuItem->id }}">

                        <h3 class="mb-3 text-sm font-semibold text-gray-700">
                            Assign Recipe Ingredients
                        </h3>

                        {{-- Ingredient rows --}}
                        <div class="recipe-ingredients space-y-3"
                            id="ingredients-{{ $menuItem->id }}">

                            @forelse ($menuItem->recipeItems as $index => $recipeItem)
                            <div class="ingredient-row flex flex-wrap items-end gap-3">

                                <div class="min-w-[200px] flex-1">
                                    <label class="mb-1 block text-xs font-medium text-gray-600">
                                        Inventory Item
                                    </label>

                                    <select name="ingredients[{{ $index }}][inventory_item_id]"
                                        required
                                        class="w-full rounded-lg border-gray-300 text-sm">
                                        <option value="">
                                            Select inventory item
                                        </option>

                                        @foreach ($inventoryItems as $inventoryItem)
                                        <option value="{{ $inventoryItem->id }}"
                                            @selected($recipeItem->inventory_item_id == $inventoryItem->id)>
                                            {{ $inventoryItem->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="w-36">
                                    <label class="mb-1 block text-xs font-medium text-gray-600">
                                        Quantity Required
                                    </label>

                                    <input type="number"
                                        name="ingredients[{{ $index }}][quantity_required]"
                                        value="{{ $recipeItem->quantity_required }}"
                                        min="0.001"
                                        step="0.001"
                                        required
                                        class="w-full rounded-lg border-gray-300 text-sm">
                                </div>

                                <button type="button"
                                    class="remove-ingredient rounded-lg border border-red-300 px-3 py-2 text-sm text-red-700 hover:bg-red-50">
                                    Remove
                                </button>
                            </div>
                            @empty
                            <div class="ingredient-row flex flex-wrap items-end gap-3">

                                <div class="min-w-[200px] flex-1">
                                    <label class="mb-1 block text-xs font-medium text-gray-600">
                                        Inventory Item
                                    </label>

                                    <select name="ingredients[0][inventory_item_id]"
                                        required
                                        class="w-full rounded-lg border-gray-300 text-sm">
                                        <option value="">
                                            Select inventory item
                                        </option>

                                        @foreach ($inventoryItems as $inventoryItem)
                                        <option value="{{ $inventoryItem->id }}">
                                            {{ $inventoryItem->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="w-36">
                                    <label class="mb-1 block text-xs font-medium text-gray-600">
                                        Quantity Required
                                    </label>

                                    <input type="number"
                                        name="ingredients[0][quantity_required]"
                                        min="0.001"
                                        step="0.001"
                                        required
                                        class="w-full rounded-lg border-gray-300 text-sm">
                                </div>

                                <button type="button"
                                    class="remove-ingredient rounded-lg border border-red-300 px-3 py-2 text-sm text-red-700 hover:bg-red-50">
                                    Remove
                                </button>
                            </div>
                            @endforelse
                        </div>

                        {{-- Form actions --}}
                        <div class="mt-4 flex flex-wrap gap-2">
                            <button type="button"
                                class="add-ingredient rounded-lg border border-amber-800 px-3 py-2 text-sm font-medium text-amber-900 hover:bg-amber-50">
                                + Add Ingredient
                            </button>

                            <button type="submit"
                                class="rounded-lg bg-amber-800 px-4 py-2 text-sm font-semibold text-white hover:bg-amber-900">
                                Save Recipe
                            </button>
                        </div>
                    </form>
                </section>
                @empty
                <div class="rounded-xl border border-gray-200 bg-white p-6 text-center text-gray-500">
                    No menu items found.
                </div>
                @endforelse

            </div>
        </div>
    </div>

    {{-- Add/remove ingredient row behavior --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.recipe-ingredients').forEach(function(container) {
                const form = container.closest('form');
                const addButton = form.querySelector('.add-ingredient');

                function updateNames() {
                    container.querySelectorAll('.ingredient-row').forEach(function(row, index) {
                        row.querySelectorAll('select, input').forEach(function(field) {
                            const fieldType = field.name.includes('inventory_item_id') ?
                                'inventory_item_id' :
                                'quantity_required';

                            field.name = `ingredients[${index}][${fieldType}]`;
                        });
                    });
                }

                addButton.addEventListener('click', function() {
                    const firstRow = container.querySelector('.ingredient-row');

                    if (!firstRow) {
                        return;
                    }

                    const newRow = firstRow.cloneNode(true);

                    newRow.querySelectorAll('select').forEach(function(field) {
                        field.selectedIndex = 0;
                    });

                    newRow.querySelectorAll('input').forEach(function(field) {
                        field.value = '';
                    });

                    container.appendChild(newRow);
                    updateNames();
                });

                container.addEventListener('click', function(event) {
                    if (!event.target.classList.contains('remove-ingredient')) {
                        return;
                    }

                    const rows = container.querySelectorAll('.ingredient-row');

                    if (rows.length > 1) {
                        event.target.closest('.ingredient-row').remove();
                        updateNames();
                    } else {
                        alert('A recipe must have at least one ingredient row.');
                    }
                });

                updateNames();
            });
        });
    </script>
</x-app-layout>