<x-app-layout>
    <div class="inventory-page">
        <div class="inventory-header">
            <div>
                <h1>Inventory Management</h1>
                <p>View and monitor stock across your inventory locations.</p>
            </div>
        </div>

        <div class="inventory-summary">
            <div class="inventory-summary-card">
                <span class="summary-label">Active Items</span>
                <strong>{{ $activeItemCount }}</strong>
            </div>

            <div class="inventory-summary-card">
                <span class="summary-label">Low Stock Records</span>
                <strong>{{ $lowStockCount }}</strong>
            </div>
        </div>
        @if (session('success'))
        <div class="inventory-alert">
            {{ session('success') }}
        </div>
        @endif
        <section class="inventory-section">
            <div class="section-heading">
                <h2>Inventory Items</h2>
                <span>{{ $items->count() }} item(s)</span>
            </div>

            <div class="inventory-table-wrapper">
                <table class="inventory-table">
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Type</th>
                            <th>Unit</th>
                            <th>Location</th>
                            <th>Current Stock</th>
                            <th>Reorder Level</th>
                            <th>Stock Status</th>
                            <th>Item Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($items as $item)
                        @forelse ($item->inventoryStocks as $stock)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->inventory_type }}</td>
                            <td>{{ $item->unit?->abbreviation ?? '—' }}</td>
                            <td>{{ $stock->location?->name ?? '—' }}</td>
                            <td>{{ number_format((float) $stock->current_quantity, 3) }}</td>
                            <td>{{ number_format((float) $stock->reorder_level, 3) }}</td>
                            <td>
                                @if ($stock->current_quantity <= $stock->reorder_level)
                                    <span class="stock-status low">Low Stock</span>
                                    @else
                                    <span class="stock-status okay">In Stock</span>
                                    @endif
                            </td>

                            @if ($loop->first)
                            <td rowspan="{{ $item->inventoryStocks->count() }}">
                                @if ($item->is_active)
                                <span class="item-status active">Active</span>
                                @else
                                <span class="item-status inactive">Inactive</span>
                                @endif
                            </td>

                            <td rowspan="{{ $item->inventoryStocks->count() }}">
                                <form
                                    method="POST"
                                    action="{{ route('inventory.toggle-active', $item) }}"
                                    onsubmit="return confirm('Are you sure you want to {{ $item->is_active ? 'deactivate' : 'activate' }} this inventory item?');">
                                    @csrf

                                    <button
                                        type="submit"
                                        class="toggle-button {{ $item->is_active ? 'deactivate' : 'activate' }}">
                                        {{ $item->is_active ? 'Deactivate' : 'Activate' }}
                                    </button>
                                </form>
                            </td>
                            @endif
                        </tr>
                        @empty
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->inventory_type }}</td>
                            <td>{{ $item->unit?->abbreviation ?? '—' }}</td>
                            <td colspan="4">No stock record yet</td>
                            <td>
                                @if ($item->is_active)
                                <span class="item-status active">Active</span>
                                @else
                                <span class="item-status inactive">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <form
                                    method="POST"
                                    action="{{ route('inventory.toggle-active', $item) }}"
                                    onsubmit="return confirm('Are you sure you want to {{ $item->is_active ? 'deactivate' : 'activate' }} this inventory item?');">
                                    @csrf

                                    <button
                                        type="submit"
                                        class="toggle-button {{ $item->is_active ? 'deactivate' : 'activate' }}">
                                        {{ $item->is_active ? 'Deactivate' : 'Activate' }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforelse
                        @empty
                        <tr>
                            <td colspan="9" class="empty-state">
                                No inventory items found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="inventory-pagination">
                {{ $items->links() }}
            </div>
        </section>
    </div>

    <style>
        .inventory-alert {
            margin-bottom: 18px;
            padding: 12px 16px;
            border: 1px solid #b8dfc2;
            border-radius: 8px;
            background: #eaf5ed;
            color: #287344;
            font-size: 14px;
        }

        .item-status {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .item-status.active {
            background: #eaf5ed;
            color: #287344;
        }

        .item-status.inactive {
            background: #f1eeec;
            color: #75645a;
        }

        .toggle-button {
            padding: 7px 11px;
            border: 0;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
        }

        .toggle-button.deactivate {
            background: #fff0e8;
            color: #a84718;
        }

        .toggle-button.activate {
            background: #eaf5ed;
            color: #287344;
        }

        .inventory-pagination {
            margin-top: 18px;
        }

        .inventory-page {
            padding: 28px;
            color: #3f3028;
        }

        .inventory-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .inventory-header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
        }

        .inventory-header p {
            margin: 6px 0 0;
            color: #817168;
        }

        .inventory-summary {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }

        .inventory-summary-card,
        .inventory-section {
            background: #fff;
            border: 1px solid #eee5df;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(60, 40, 25, 0.04);
        }

        .inventory-summary-card {
            padding: 18px 20px;
        }

        .summary-label {
            display: block;
            margin-bottom: 8px;
            color: #817168;
            font-size: 13px;
        }

        .inventory-summary-card strong {
            font-size: 26px;
        }

        .inventory-section {
            padding: 20px;
        }

        .section-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
        }

        .section-heading h2 {
            margin: 0;
            font-size: 18px;
            font-weight: 700;
        }

        .section-heading span {
            color: #817168;
            font-size: 13px;
        }

        .inventory-table-wrapper {
            overflow-x: auto;
        }

        .inventory-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        .inventory-table th,
        .inventory-table td {
            padding: 13px 12px;
            border-bottom: 1px solid #f0eae5;
            white-space: nowrap;
        }

        .inventory-table th {
            background: #faf7f4;
            color: #75645a;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .inventory-table td {
            font-size: 14px;
        }

        .stock-status {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .stock-status.low {
            background: #fff0e8;
            color: #a84718;
        }

        .stock-status.okay {
            background: #eaf5ed;
            color: #287344;
        }

        .empty-state {
            padding: 28px !important;
            color: #817168;
            text-align: center;
        }

        @media (max-width: 640px) {
            .inventory-page {
                padding: 16px;
            }

            .inventory-section {
                padding: 14px;
            }
        }
    </style>
</x-app-layout>