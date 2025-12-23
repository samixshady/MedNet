<div class="bg-white rounded-xl shadow-lg overflow-hidden quick-buy-container">
    <!-- Header with Edit Button -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-6 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-white">⚡ QuickBuy</h2>
            <p class="text-blue-100 text-sm mt-1">Your most-used products for fast checkout</p>
        </div>
        <a href="{{ route('quick-buy.manage') }}" class="px-6 py-3 bg-white text-blue-600 hover:bg-blue-50 font-bold rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl active:scale-95">
            ✏️ Edit
        </a>
    </div>

    <!-- QuickBuy Items -->
    <div class="p-6">
        <div id="quickbuy-dashboard-items">
            <!-- Table will load here -->
            <div class="col-span-full flex justify-center items-center py-12">
                <div class="text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m0 0l8 4m-8-4v10l8 4m0-10l8-4m-8 4v10l8-4m-8-4l8 4"></path>
                    </svg>
                    <p class="text-gray-600 font-medium">No QuickBuy items yet</p>
                    <a href="{{ route('quick-buy.manage') }}" class="text-blue-600 hover:text-blue-700 font-bold mt-2">Add some now →</a>
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
                        <table class="w-full border-collapse">
                            <thead>
                                <tr class="border-b-2 border-gray-300 bg-gray-50">
                                    <th class="px-4 py-3 text-left font-bold text-gray-900">Name</th>
                                    <th class="px-4 py-3 text-center font-bold text-gray-900">Quantity</th>
                                    <th class="px-4 py-3 text-right font-bold text-gray-900">Price (৳)</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${items.map(item => `
                                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                                        <td class="px-4 py-3 text-gray-900 font-medium">${item.name}</td>
                                        <td class="px-4 py-3 text-center text-gray-900 font-bold">${item.quantity || 1}</td>
                                        <td class="px-4 py-3 text-right text-green-600 font-bold">${item.price.toFixed(2)}</td>
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
