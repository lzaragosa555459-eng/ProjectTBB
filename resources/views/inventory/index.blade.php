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
                <strong>{{ $items->count() }}</strong>
            </div>

            <div class="inventory-summary-card">
                <span class="summary-label">Low Stock Records</span>
                <strong>
                    {{ $items->sum(fn ($item) => $item->inventoryStocks->filter(fn ($stock) => $stock->current_quantity <= $stock->reorder_level)->count()) }}
                </strong>
            </div>
        </div>

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
                            <th>Status</th>
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
                        </tr>
                        @empty
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->inventory_type }}</td>
                            <td>{{ $item->unit?->abbreviation ?? '—' }}</td>
                            <td colspan="4">No stock record yet</td>
                        </tr>
                        @endforelse
                        @empty
                        <tr>
                            <td colspan="7" class="empty-state">
                                No active inventory items found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    <style>
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