@extends('layouts.admin')

@section('title', 'Analytics Dashboard')

@section('content')
<style>
    .analytics-container {
        padding: 24px;
        background: #f8f9fa;
        min-height: 100vh;
    }
    
    .dark .analytics-container {
        background: #111827;
    }
    
    .analytics-header {
        margin-bottom: 32px;
    }
    
    .analytics-header h1 {
        font-size: 28px;
        font-weight: 700;
        color: #1a202c;
        margin: 0 0 8px 0;
    }
    
    .dark .analytics-header h1 {
        color: #f3f4f6;
    }
    
    .analytics-header p {
        color: #718096;
        font-size: 14px;
    }
    
    .dark .analytics-header p {
        color: #9ca3af;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
        margin-bottom: 32px;
    }
    
    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .dark .stat-card {
        background: #1f2937;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
    }
    
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(180deg, var(--accent-color), var(--accent-color-light));
    }
    
    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    }
    
    .stat-card.blue { --accent-color: #3b82f6; --accent-color-light: #60a5fa; }
    .stat-card.green { --accent-color: #10b981; --accent-color-light: #34d399; }
    .stat-card.purple { --accent-color: #8b5cf6; --accent-color-light: #a78bfa; }
    .stat-card.orange { --accent-color: #f59e0b; --accent-color-light: #fbbf24; }
    .stat-card.red { --accent-color: #ef4444; --accent-color-light: #f87171; }
    .stat-card.indigo { --accent-color: #6366f1; --accent-color-light: #818cf8; }
    
    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin-bottom: 16px;
        background: linear-gradient(135deg, var(--accent-color), var(--accent-color-light));
        color: white;
    }
    
    .stat-label {
        font-size: 13px;
        color: #718096;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }
    
    .dark .stat-label {
        color: #9ca3af;
    }
    
    .stat-value {
        font-size: 32px;
        font-weight: 700;
        color: #1a202c;
        margin-bottom: 4px;
    }
    
    .dark .stat-value {
        color: #f3f4f6;
    }
    
    .stat-change {
        font-size: 13px;
        font-weight: 600;
    }
    
    .stat-change.positive {
        color: #10b981;
    }
    
    .stat-change.negative {
        color: #ef4444;
    }
    
    .chart-section {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
        gap: 24px;
        margin-bottom: 32px;
    }
    
    .chart-card {
        background: white;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }
    
    .dark .chart-card {
        background: #1f2937;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
    }
    
    .chart-header {
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 2px solid #f1f5f9;
    }
    
    .chart-title {
        font-size: 18px;
        font-weight: 600;
        color: #1a202c;
        margin: 0;
    }
    
    .dark .chart-title {
        color: #f3f4f6;
    }
    
    .chart-subtitle {
        font-size: 13px;
        color: #718096;
        margin-top: 4px;
    }
    
    .dark .chart-subtitle {
        color: #9ca3af;
    }
    
    .alert-card {
        background: white;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        margin-bottom: 24px;
    }
    
    .dark .alert-card {
        background: #1f2937;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
    }
    
    .alert-card.warning {
        border-left: 4px solid #f59e0b;
    }
    
    .alert-card.danger {
        border-left: 4px solid #ef4444;
    }
    
    .alert-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 16px;
    }
    
    .alert-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }
    
    .alert-icon.warning {
        background: #fef3c7;
        color: #f59e0b;
    }
    
    .alert-icon.danger {
        background: #fee2e2;
        color: #ef4444;
    }
    
    .alert-title {
        font-size: 16px;
        font-weight: 600;
        color: #1a202c;
    }
    
    .product-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .product-item {
        display: flex;
        justify-content: space-between;
        padding: 12px;
        border-radius: 8px;
        margin-bottom: 8px;
        background: #f8f9fa;
        transition: all 0.2s ease;
    }
    
    .product-item:hover {
        background: #e9ecef;
        transform: translateX(4px);
    }
    
    .product-name {
        font-weight: 500;
        color: #1a202c;
        font-size: 14px;
    }
    
    .product-stock {
        font-weight: 600;
        font-size: 14px;
    }
    
    .product-stock.low {
        color: #f59e0b;
    }
    
    .product-stock.out {
        color: #ef4444;
    }
    
    .recent-activity {
        background: white;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }
    
    .activity-item {
        display: flex;
        align-items: center;
        padding: 16px;
        border-bottom: 1px solid #f1f5f9;
        transition: all 0.2s ease;
    }
    
    .activity-item:last-child {
        border-bottom: none;
    }
    
    .activity-item:hover {
        background: #f8f9fa;
    }
    
    .activity-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea, #764ba2);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        margin-right: 16px;
        flex-shrink: 0;
    }
    
    .activity-details {
        flex: 1;
    }
    
    .activity-text {
        font-size: 14px;
        color: #1a202c;
        margin-bottom: 4px;
    }
    
    .activity-time {
        font-size: 12px;
        color: #718096;
    }
    
    .activity-amount {
        font-weight: 600;
        color: #10b981;
        font-size: 15px;
    }
    
    .status-badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 600;
        text-transform: capitalize;
    }
    
    .status-badge.pending {
        background: #fef3c7;
        color: #f59e0b;
    }
    
    .status-badge.delivered {
        background: #d1fae5;
        color: #10b981;
    }
    
    .status-badge.cancelled {
        background: #fee2e2;
        color: #ef4444;
    }
    
    @media (max-width: 768px) {
        .analytics-container {
            padding: 16px;
        }
        
        .stats-grid {
            grid-template-columns: 1fr;
        }
        
        .chart-section {
            grid-template-columns: 1fr;
        }
        
        .stat-value {
            font-size: 24px;
        }
        
        .analytics-header h1 {
            font-size: 24px;
        }
    }
</style>

<div class="analytics-container">
    <!-- Header -->
    <div class="analytics-header">
        <h1>📊 Analytics Dashboard</h1>
        <p>Real-time insights and performance metrics</p>
    </div>

    <!-- Stats Grid -->
    <div class="stats-grid">
        <!-- Total Revenue -->
        <div class="stat-card blue">
            <div class="stat-icon">
                <i class='bx bx-dollar-circle'></i>
            </div>
            <div class="stat-label">Total Revenue</div>
            <div class="stat-value">৳{{ number_format($totalRevenue, 2) }}</div>
            <div class="stat-change positive">
                <i class='bx bx-trending-up'></i> From {{ $totalSales }} paid orders
            </div>
        </div>

        <!-- Total Sales -->
        <div class="stat-card green">
            <div class="stat-icon">
                <i class='bx bx-shopping-bag'></i>
            </div>
            <div class="stat-label">Total Sales</div>
            <div class="stat-value">{{ number_format($totalSales) }}</div>
            <div class="stat-change positive">
                <i class='bx bx-check-circle'></i> Completed transactions
            </div>
        </div>

        <!-- Total Orders -->
        <div class="stat-card purple">
            <div class="stat-icon">
                <i class='bx bx-package'></i>
            </div>
            <div class="stat-label">Total Orders</div>
            <div class="stat-value">{{ number_format($totalOrders) }}</div>
            <div class="stat-change">
                <span class="positive">{{ $completedOrders }} completed</span> • 
                <span style="color: #f59e0b;">{{ $pendingOrders }} pending</span>
            </div>
        </div>

        <!-- Total Users -->
        <div class="stat-card orange">
            <div class="stat-icon">
                <i class='bx bx-user'></i>
            </div>
            <div class="stat-label">Total Users</div>
            <div class="stat-value">{{ number_format($totalUsers) }}</div>
            <div class="stat-change positive">
                <i class='bx bx-user-plus'></i> {{ $newUsersThisMonth }} new this month
            </div>
        </div>

        <!-- Active Customers -->
        <div class="stat-card indigo">
            <div class="stat-icon">
                <i class='bx bx-heart'></i>
            </div>
            <div class="stat-label">Active Customers</div>
            <div class="stat-value">{{ number_format($activeCustomers) }}</div>
            <div class="stat-change">
                {{ number_format(($activeCustomers / max($totalUsers, 1)) * 100, 1) }}% of total users
            </div>
        </div>

        <!-- Total Products -->
        <div class="stat-card green">
            <div class="stat-icon">
                <i class='bx bx-box'></i>
            </div>
            <div class="stat-label">Total Products</div>
            <div class="stat-value">{{ number_format($totalProducts) }}</div>
            <div class="stat-change {{ $outOfStockProducts > 0 ? 'negative' : 'positive' }}">
                @if($outOfStockProducts > 0)
                    <i class='bx bx-error'></i> {{ $outOfStockProducts }} out of stock
                @else
                    <i class='bx bx-check'></i> All in stock
                @endif
            </div>
        </div>

        <!-- Prescription Orders -->
        <div class="stat-card blue">
            <div class="stat-icon">
                <i class='bx bx-file-blank'></i>
            </div>
            <div class="stat-label">Prescription Orders</div>
            <div class="stat-value">{{ number_format($prescriptionOrders) }}</div>
            <div class="stat-change {{ $pendingPrescriptionApprovals > 0 ? 'negative' : 'positive' }}">
                @if($pendingPrescriptionApprovals > 0)
                    <i class='bx bx-time'></i> {{ $pendingPrescriptionApprovals }} pending approval
                @else
                    <i class='bx bx-check'></i> No pending approvals
                @endif
            </div>
        </div>

        <!-- Cancelled Orders -->
        <div class="stat-card red">
            <div class="stat-icon">
                <i class='bx bx-x-circle'></i>
            </div>
            <div class="stat-label">Cancelled Orders</div>
            <div class="stat-value">{{ number_format($cancelledOrders) }}</div>
            <div class="stat-change">
                {{ number_format(($cancelledOrders / max($totalOrders, 1)) * 100, 1) }}% of total orders
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="chart-section">
        <!-- Monthly Revenue Chart -->
        <div class="chart-card" style="grid-column: span 2;">
            <div class="chart-header">
                <h3 class="chart-title">Monthly Revenue Trend</h3>
                <p class="chart-subtitle">Revenue over the last 6 months</p>
            </div>
            <canvas id="revenueChart" height="80"></canvas>
        </div>

        <!-- Orders Trend Chart -->
        <div class="chart-card">
            <div class="chart-header">
                <h3 class="chart-title">Orders Trend</h3>
                <p class="chart-subtitle">Last 7 days</p>
            </div>
            <canvas id="ordersTrendChart"></canvas>
        </div>

        <!-- Best Selling Products -->
        <div class="chart-card">
            <div class="chart-header">
                <h3 class="chart-title">Best Selling Products</h3>
                <p class="chart-subtitle">Top 5 by quantity sold</p>
            </div>
            <canvas id="bestSellingChart"></canvas>
        </div>

        <!-- Customer Distribution -->
        <div class="chart-card">
            <div class="chart-header">
                <h3 class="chart-title">Customer Distribution</h3>
                <p class="chart-subtitle">New vs Returning</p>
            </div>
            <canvas id="customerChart"></canvas>
        </div>

        <!-- Order Status Distribution -->
        <div class="chart-card">
            <div class="chart-header">
                <h3 class="chart-title">Order Status</h3>
                <p class="chart-subtitle">Current distribution</p>
            </div>
            <canvas id="orderStatusChart"></canvas>
        </div>
    </div>

    <!-- Alerts Section -->
    @if($outOfStockProducts > 0 || $lowStockProducts->count() > 0)
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 24px; margin-bottom: 32px;">
        @if($outOfStockProducts > 0)
        <div class="alert-card danger">
            <div class="alert-header">
                <div class="alert-icon danger">
                    <i class='bx bx-error-circle'></i>
                </div>
                <div class="alert-title">Out of Stock Alert</div>
            </div>
            <p style="color: #718096; margin: 0;">
                <strong>{{ $outOfStockProducts }}</strong> product(s) are currently out of stock. Please restock immediately to avoid lost sales.
            </p>
        </div>
        @endif

        @if($lowStockProducts->count() > 0)
        <div class="alert-card warning">
            <div class="alert-header">
                <div class="alert-icon warning">
                    <i class='bx bx-error'></i>
                </div>
                <div class="alert-title">Low Stock Warning</div>
            </div>
            <ul class="product-list">
                @foreach($lowStockProducts as $product)
                <li class="product-item">
                    <span class="product-name">{{ $product->name }}</span>
                    <span class="product-stock low">{{ $product->quantity }} left</span>
                </li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
    @endif

    <!-- Recent Activity -->
    <div class="recent-activity">
        <div class="chart-header">
            <h3 class="chart-title">Recent Orders</h3>
            <p class="chart-subtitle">Latest 10 transactions</p>
        </div>
        @foreach($recentOrders as $order)
        <div class="activity-item">
            <div class="activity-avatar">
                {{ strtoupper(substr($order->user->name ?? 'U', 0, 1)) }}
            </div>
            <div class="activity-details">
                <div class="activity-text">
                    <strong>{{ $order->user->name ?? 'Unknown User' }}</strong> placed an order
                </div>
                <div class="activity-time">
                    {{ $order->created_at->diffForHumans() }} • 
                    <span class="status-badge {{ $order->order_status }}">{{ $order->order_status }}</span>
                </div>
            </div>
            <div class="activity-amount">
                ৳{{ number_format($order->total_amount, 2) }}
            </div>
        </div>
        @endforeach
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    // Chart.js default config
    Chart.defaults.font.family = "'Inter', 'Poppins', sans-serif";
    Chart.defaults.color = '#718096';
    
    // Monthly Revenue Chart
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    new Chart(revenueCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($monthlyRevenue->pluck('month')) !!},
            datasets: [{
                label: 'Revenue (৳)',
                data: {!! json_encode($monthlyRevenue->pluck('revenue')) !!},
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointRadius: 5,
                pointHoverRadius: 7,
                pointBackgroundColor: '#3b82f6',
                pointBorderColor: '#fff',
                pointBorderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: 12,
                    titleFont: { size: 14, weight: 'bold' },
                    bodyFont: { size: 13 },
                    callbacks: {
                        label: function(context) {
                            return '৳' + context.parsed.y.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return '৳' + value.toFixed(0).replace(/\d(?=(\d{3})+$)/g, '$&,');
                        }
                    },
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // Orders Trend Chart
    const ordersTrendCtx = document.getElementById('ordersTrendChart').getContext('2d');
    new Chart(ordersTrendCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($ordersTrend->pluck('date')) !!},
            datasets: [{
                label: 'Orders',
                data: {!! json_encode($ordersTrend->pluck('count')) !!},
                backgroundColor: 'rgba(139, 92, 246, 0.8)',
                borderColor: '#8b5cf6',
                borderWidth: 2,
                borderRadius: 8,
                barThickness: 30
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    },
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // Best Selling Products Chart
    const bestSellingCtx = document.getElementById('bestSellingChart').getContext('2d');
    new Chart(bestSellingCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($bestSellingProducts->pluck('product.name')) !!},
            datasets: [{
                data: {!! json_encode($bestSellingProducts->pluck('total_sold')) !!},
                backgroundColor: [
                    '#3b82f6',
                    '#10b981',
                    '#f59e0b',
                    '#ef4444',
                    '#8b5cf6'
                ],
                borderWidth: 3,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 15,
                        font: {
                            size: 12
                        }
                    }
                }
            }
        }
    });

    // Customer Distribution Chart
    const customerCtx = document.getElementById('customerChart').getContext('2d');
    new Chart(customerCtx, {
        type: 'pie',
        data: {
            labels: ['New Customers', 'Returning Customers'],
            datasets: [{
                data: [{{ $newCustomers }}, {{ $returningCustomers }}],
                backgroundColor: [
                    '#10b981',
                    '#3b82f6'
                ],
                borderWidth: 3,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 15,
                        font: {
                            size: 12
                        }
                    }
                }
            }
        }
    });

    // Order Status Chart
    const orderStatusCtx = document.getElementById('orderStatusChart').getContext('2d');
    new Chart(orderStatusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Completed', 'Pending', 'Cancelled/Failed'],
            datasets: [{
                data: [{{ $completedOrders }}, {{ $pendingOrders }}, {{ $cancelledOrders }}],
                backgroundColor: [
                    '#10b981',
                    '#f59e0b',
                    '#ef4444'
                ],
                borderWidth: 3,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 15,
                        font: {
                            size: 12
                        }
                    }
                }
            }
        }
    });
</script>
@endsection
