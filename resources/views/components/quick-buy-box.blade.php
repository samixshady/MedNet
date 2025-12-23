<div class="bg-white rounded-xl shadow-lg overflow-hidden quick-buy-container" style="width: 550px; height: 320px; display: flex; flex-direction: column; position: absolute; left: 300px; top: 300px; z-index: 50;">
    <!-- Header with Edit Button -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-4 py-3 flex justify-between items-center flex-shrink-0">
        <div>
            <h2 class="text-lg font-bold text-white">⚡ QuickBuy</h2>
        </div>
        <a href="{{ route('quick-buy.manage') }}" class="px-4 py-2 text-sm bg-white text-blue-600 hover:bg-blue-50 font-bold rounded transition-all duration-200 shadow hover:shadow-md active:scale-95">
            ✏️ Edit
        </a>
    </div>

    <!-- QuickBuy Items -->
    <div class="flex-1 overflow-y-auto" style="font-size: 0.95rem;">
        <div id="quickbuy-dashboard-items">
            <!-- Table will load here -->
            <div class="flex justify-center items-center py-6">
                <div class="text-center">
                    <p class="text-gray-600 text-xs font-medium">No items yet</p>
                    <a href="{{ route('quick-buy.manage') }}" class="text-blue-600 hover:text-blue-700 font-bold text-xs mt-1">Add now →</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sonner@latest/dist/index.js"></script>
<link href="https://cdn.jsdelivr.net/npm/sonner@latest/dist/styles.css" rel="stylesheet" />

<script>
    document.addEventListener('DOMContentLoaded', function() {
        loadQuickBuyDashboard();
    });

    function loadQuickBuyDashboard() {
        fetch('/quick-buy/items')
            .then(response => response.json())
            .then(items => {
                const container = document.getElementById('quickbuy-dashboard-items');
                
                if (items.length === 0) {
                    container.innerHTML = `
                        <div class="flex justify-center items-center py-12">
                            <div class="text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m0 0l8 4m-8-4v10l8 4m0-10l8-4m-8 4v10l8-4m-8-4l8 4"></path>
                                </svg>
                                <p class="text-gray-600 font-medium">No QuickBuy items yet</p>
                                <a href="/quick-buy/manage" class="text-blue-600 hover:text-blue-700 font-bold mt-2">Add some now →</a>
                            </div>
                        </div>
                    `;
                } else {
                    container.innerHTML = `
                        <table class="w-full border-collapse text-base" style="font-size: 1.1rem;">
                            <thead>
                                <tr class="border-b-2 border-gray-300 bg-gray-100">
                                    <th class="px-4 py-3 text-left font-bold text-gray-800" style="font-size: 1.05rem;">Name</th>
                                    <th class="px-4 py-3 text-center font-bold text-gray-800" style="width: 80px; font-size: 1.05rem;">Qty</th>
                                    <th class="px-4 py-3 text-right font-bold text-gray-800" style="width: 100px; font-size: 1.05rem;">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${items.map(item => `
                                    <tr class="border-b border-gray-200 hover:bg-blue-50">
                                        <td class="px-4 py-3 text-gray-900 font-semibold truncate" style="font-size: 1rem;">${item.name}</td>
                                        <td class="px-4 py-3 text-center text-gray-900 font-bold" style="font-size: 1.1rem;">${item.quantity || 1}</td>
                                        <td class="px-4 py-3 text-right text-green-600 font-bold" style="font-size: 1rem;">৳${item.price.toFixed(0)}</td>
                                    </tr>
                                `).join('')}
                            </tbody>
                        </table>
                    `;
                }
            })
            .catch(error => console.error('Error loading QuickBuy dashboard:', error));
    }

    function addToCartFromQuickBuy(productId, quickBuyId) {
        const quantity = parseInt(document.getElementById(`qty-${productId}`).value) || 1;
        
        // Update QuickBuy quantity in database
        fetch(`/quick-buy/${quickBuyId}/quantity`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify({
                quantity: quantity
            })
        })
        .then(response => response.json())
        .then(data => {
            // Then add to cart
            fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: quantity
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    sonner.success(data.message);
                    // Update cart count if available
                    if (window.updateCartCount) {
                        window.updateCartCount(data.cartCount);
                    }
                } else {
                    sonner.error(data.message);
                }
            })
            .catch(error => {
                console.error('Error adding to cart:', error);
                sonner.error('Failed to add to cart');
            });
        })
        .catch(error => {
            console.error('Error updating quantity:', error);
            sonner.error('Failed to update quantity');
        });
    }
</script>
