@props(['items' => null])

<!-- QUOTATION ITEMS SECTION -->
<div class="mt-4">
    <h5 class="mb-3">Quotation Items</h5>
    <div class="table-responsive" style="overflow-x: auto;">
        <table class="table table-bordered table-hover" id="itemsTable" style="min-width: 1200px;">
            <thead class="table-light">
                <tr>
                    <th style="min-width: 150px;">Item</th>
                    <th style="min-width: 100px;">Qty</th>
                    <th style="min-width: 100px;">Satuan</th>
                    <th style="min-width: 150px;">Purchase Price</th>
                    <th style="min-width: 150px;">Total Price</th>
                    <th style="min-width: 120px;">UP+</th>
                    <th style="min-width: 120px;">price+</th>
                    <th style="min-width: 150px;">Selling Price</th>
                    <th style="min-width: 150px;">Total Price</th>
                    <th style="min-width: 80px; text-align: center;">
                        <button type="button" class="btn btn-sm btn-success" id="addItemBtn" title="Add Item">
                            <i class="mdi mdi-plus"></i>
                        </button>
                    </th>
                </tr>
            </thead>
            <tbody id="itemsBody">
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
<script>
    let itemCount = 0;

    function addItemRow(data = {}) {
        itemCount++;
        const rowHtml = `
            <tr class="item-row">
                <td>
                    <input type="text" name="items[${itemCount}][item]" class="form-control form-control-sm" value="${data.item || ''}" placeholder="Item name" style="min-width: 140px;">
                </td>
                <td>
                    <input type="number" name="items[${itemCount}][qty]" class="form-control form-control-sm item-qty" value="${data.qty || ''}" placeholder="0" step="0.01" style="min-width: 90px;">
                </td>
                <td>
                    <input type="number" name="items[${itemCount}][satuan]" class="form-control form-control-sm item-satuan" value="${data.satuan || ''}" placeholder="0" step="0.01" style="min-width: 90px;">
                </td>
                <td>
                    <input type="number" name="items[${itemCount}][purchase_price]" class="form-control form-control-sm item-purchase-price" value="${data.purchase_price || ''}" placeholder="0" step="0.01" style="min-width: 140px;">
                </td>
                <td>
                    <input type="number" name="items[${itemCount}][total_price]" class="form-control form-control-sm item-total-price" value="${data.total_price || ''}" placeholder="0" step="0.01" readonly style="min-width: 140px; background-color: #f8f9fa;">
                </td>
                <td>
                    <input type="number" name="items[${itemCount}][up_price]" class="form-control form-control-sm item-up-price" value="${data.up_price || ''}" placeholder="0" step="0.01" style="min-width: 110px;">
                </td>
                <td>
                    <input type="number" name="items[${itemCount}][price_plus]" class="form-control form-control-sm item-price-plus" value="${data.price_plus || ''}" placeholder="0" step="0.01" style="min-width: 110px;">
                </td>
                <td>
                    <input type="number" name="items[${itemCount}][selling_price]" class="form-control form-control-sm item-selling-price" value="${data.selling_price || ''}" placeholder="0" step="0.01" style="min-width: 140px;">
                </td>
                <td>
                    <input type="number" name="items[${itemCount}][total_selling_price]" class="form-control form-control-sm item-total-selling-price" value="${data.total_selling_price || ''}" placeholder="0" step="0.01" readonly style="min-width: 140px; background-color: #f8f9fa;">
                </td>
                <td style="text-align: center;">
                    <button type="button" class="btn btn-sm btn-danger delete-item-btn" title="Delete">
                        <i class="mdi mdi-trash-can"></i>
                    </button>
                </td>
            </tr>
        `;
        
        document.getElementById('itemsBody').insertAdjacentHTML('beforeend', rowHtml);
        attachItemEventListeners();
    }

    function attachItemEventListeners() {
        document.querySelectorAll('.delete-item-btn').forEach(btn => {
            btn.removeEventListener('click', deleteItem);
            btn.addEventListener('click', deleteItem);
        });

        document.querySelectorAll('.item-satuan, .item-purchase-price').forEach(input => {
            input.removeEventListener('input', calculatePurchaseTotals);
            input.addEventListener('input', calculatePurchaseTotals);
        });

        document.querySelectorAll('.item-qty, .item-selling-price').forEach(input => {
            input.removeEventListener('input', calculateSellingTotals);
            input.addEventListener('input', calculateSellingTotals);
        });
    }

    function deleteItem(e) {
        e.preventDefault();
        e.target.closest('tr').remove();
    }

    function calculatePurchaseTotals(e) {
        const row = e.target.closest('tr');
        const satuan = parseFloat(row.querySelector('.item-satuan').value) || 0;
        const purchasePrice = parseFloat(row.querySelector('.item-purchase-price').value) || 0;
        const totalPrice = satuan * purchasePrice;
        
        row.querySelector('.item-total-price').value = totalPrice.toFixed(2);
    }

    function calculateSellingTotals(e) {
        const row = e.target.closest('tr');
        const qty = parseFloat(row.querySelector('.item-qty').value) || 0;
        const sellingPrice = parseFloat(row.querySelector('.item-selling-price').value) || 0;
        const totalSellingPrice = qty * sellingPrice;
        
        row.querySelector('.item-total-selling-price').value = totalSellingPrice.toFixed(2);
    }

    document.getElementById('addItemBtn').addEventListener('click', function(e) {
        e.preventDefault();
        addItemRow();
    });

    // Initialize items
    const existingItems = @json($items ?? []);
    if (existingItems && existingItems.length > 0) {
        existingItems.forEach(item => {
            addItemRow(item);
        });
    } else {
        addItemRow();
    }
</script>
@endpush
