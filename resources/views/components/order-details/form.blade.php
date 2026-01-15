@props(['furnitures' => [], 'details' => [], 'furniturePrices' => []])

<div x-data="orderDetails()" x-cloak class="order-details">
    <template x-for="(item, index) in items" :key="index">
        <div class="card mb-2 border">
            <div class="card-body">
                <div class="row g-2 align-items-end">

                    <div class="col-md-4">
                        <label class="form-label">Furniture</label>
                        <select class="form-control" x-bind:name="`order_details[${index}][furniture_id]`"
                            x-model="items[index].furniture_id" @change="updatePrice(index)">
                            <option value="">Pilih Furniture</option>
                            @foreach ($furnitures as $id => $label)
                                <option value="{{ $id }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Qty</label>
                        <input class="form-control" type="number" x-bind:name="`order_details[${index}][quantity]`"
                            x-model.number="items[index].quantity" min="1" @input="updatePrice(index)" />
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Price</label>
                        <input class="form-control" type="number" step="0.01"
                            x-bind:name="`order_details[${index}][price]`" x-model.number="items[index].price"
                            readonly />
                    </div>

                    <div class="col-md-2 d-flex">
                        <button type="button" class="btn btn-danger mt-auto" @click="remove(index)">
                            <i class="mdi mdi-trash-can"></i>
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </template>

    <div class="mt-2">
        <button type="button" class="btn btn-primary" @click="add()"><i class="mdi mdi-plus"></i> Add Item</button>
    </div>

    <script>
        function orderDetails() {
            return {
                items: <?php echo json_encode($details ?? [['furniture_id' => '', 'quantity' => 1, 'price' => 0]]); ?>,
                furniturePrices: <?php echo json_encode($furniturePrices ?? []); ?>,
                init() {
                    if (this._initialized) return;
                    this._initialized = true;

                    // normalize items and remove accidental duplicates
                    if (!Array.isArray(this.items)) this.items = [];
                    const seen = new Set();
                    this.items = this.items.filter(it => {
                        const key = JSON.stringify(it);
                        if (seen.has(key)) return false;
                        seen.add(key);
                        return true;
                    });

                    this.items.forEach((it, idx) => this.updatePrice(idx));
                },
                add() {
                    this.items.push({
                        furniture_id: '',
                        quantity: 1,
                        price: 0
                    });
                },
                remove(i) {
                    this.items.splice(i, 1);
                },
                updatePrice(index) {
                    const it = this.items[index];
                    const fid = it.furniture_id;
                    const qty = parseFloat(it.quantity) || 0;
                    const base = parseFloat(this.furniturePrices[fid] ?? 0) || 0;
                    this.items[index].price = (base * qty).toFixed(2);
                }
            }
        }
    </script>
</div>

<!-- Load Alpine.js if not present (kept local loader because layout doesn't include bundled app.js) -->
<script>
    (function() {
        if (typeof Alpine === 'undefined') {
            var s = document.createElement('script');
            s.src = 'https://unpkg.com/alpinejs@3.15.2/dist/cdn.min.js';
            s.defer = true;
            s.onload = function() {
                try {
                    if (window.Alpine && typeof window.Alpine.start === 'function') {
                        window.Alpine.start();
                    }
                } catch (e) {
                    console.warn('Alpine load error', e);
                }
            };
            document.head.appendChild(s);
        }
    })();
</script>
