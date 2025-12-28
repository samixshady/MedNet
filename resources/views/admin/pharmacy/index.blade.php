@extends('layouts.admin')

@section('title', 'Manage Pharmacies')

@section('content')
<style>
    .pharmacy-container {
        padding: 40px 20px;
        max-width: 1600px;
        margin: 0 auto;
        background: #f5f7fa;
        min-height: 100vh;
    }
    
    .dark .pharmacy-container {
        background: #111827;
    }

    .pharmacy-header {
        margin-bottom: 40px;
    }

    .pharmacy-header h1 {
        font-size: 32px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 10px;
    }
    
    .dark .pharmacy-header h1 {
        color: #f3f4f6;
    }

    .pharmacy-header p {
        font-size: 14px;
        color: #6B7280;
    }
    
    .dark .pharmacy-header p {
        color: #9ca3af;
    }

    .filters-wrapper {
        background: white;
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 24px;
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        align-items: center;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    
    .dark .filters-wrapper {
        background: #1f2937;
        box-shadow: 0 1px 3px rgba(0,0,0,0.3);
    }

    .filter-btn {
        padding: 10px 20px;
        border-radius: 8px;
        border: 2px solid #e5e7eb;
        background: white;
        color: #374151;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .dark .filter-btn {
        background: #374151;
        border-color: #4b5563;
        color: #d1d5db;
    }

    .filter-btn.active {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-color: #667eea;
    }

    .table-wrapper {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }
    
    .dark .table-wrapper {
        background: #1f2937;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
    }

    .pharmacy-table {
        width: 100%;
        border-collapse: collapse;
    }

    .pharmacy-table thead {
        background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
    }
    
    .dark .pharmacy-table thead {
        background: linear-gradient(135deg, #374151 0%, #4b5563 100%);
    }

    .pharmacy-table th {
        padding: 16px;
        text-align: left;
        font-weight: 700;
        font-size: 13px;
        color: #374151;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e5e7eb;
    }
    
    .dark .pharmacy-table th {
        color: #d1d5db;
        border-bottom-color: #4b5563;
    }

    .pharmacy-table td {
        padding: 16px;
        color: #1f2937;
        font-size: 14px;
        border-bottom: 1px solid #e5e7eb;
    }
    
    .dark .pharmacy-table td {
        color: #d1d5db;
        border-bottom-color: #374151;
    }

    .pharmacy-table tbody tr:hover {
        background: #f9fafb;
    }
    
    .dark .pharmacy-table tbody tr:hover {
        background: #374151;
    }

    .status-badge {
        display: inline-flex;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        text-transform: capitalize;
    }

    .status-badge.approved {
        background: #d4edda;
        color: #155724;
    }

    .status-badge.pending {
        background: #fff3cd;
        color: #856404;
    }

    .status-badge.rejected {
        background: #f8d7da;
        color: #721c24;
    }

    .status-badge.banned {
        background: #000;
        color: #fff;
    }

    .license-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 600;
    }

    .license-status.valid {
        background: #d4edda;
        color: #155724;
    }

    .license-status.expired {
        background: #f8d7da;
        color: #721c24;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .btn-action {
        padding: 8px 16px;
        border-radius: 6px;
        border: none;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-approve {
        background: #10b981;
        color: white;
    }

    .btn-approve:hover {
        background: #059669;
        transform: translateY(-1px);
    }

    .btn-reject {
        background: #f59e0b;
        color: white;
    }

    .btn-reject:hover {
        background: #d97706;
        transform: translateY(-1px);
    }

    .btn-ban {
        background: #ef4444;
        color: white;
    }

    .btn-ban:hover {
        background: #dc2626;
        transform: translateY(-1px);
    }

    .btn-unban {
        background: #3b82f6;
        color: white;
    }

    .btn-unban:hover {
        background: #2563eb;
        transform: translateY(-1px);
    }

    .btn-delete {
        background: #6b7280;
        color: white;
    }

    .btn-delete:hover {
        background: #4b5563;
        transform: translateY(-1px);
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
        animation: fadeIn 0.3s;
    }

    .modal.show {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .modal-content {
        background: white;
        padding: 32px;
        border-radius: 12px;
        max-width: 500px;
        width: 90%;
        box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1);
    }
    
    .dark .modal-content {
        background: #1f2937;
    }

    .modal-header {
        font-size: 20px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 16px;
    }
    
    .dark .modal-header {
        color: #f3f4f6;
    }

    .modal-body {
        font-size: 14px;
        color: #6b7280;
        margin-bottom: 24px;
    }
    
    .dark .modal-body {
        color: #9ca3af;
    }

    .modal-footer {
        display: flex;
        gap: 12px;
        justify-content: flex-end;
    }

    textarea {
        width: 100%;
        padding: 12px;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        font-size: 14px;
        font-family: inherit;
        margin-top: 12px;
    }
    
    .dark textarea {
        background: #374151;
        border-color: #4b5563;
        color: #f3f4f6;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
</style>

<div class="pharmacy-container">
    <div class="pharmacy-header">
        <h1>Pharmacy Management</h1>
        <p>Manage registered pharmacies and approve new registrations</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success" style="background: #d4edda; color: #155724; padding: 16px; border-radius: 8px; margin-bottom: 24px;">
            {{ session('success') }}
        </div>
    @endif

    <!-- Filters -->
    <div class="filters-wrapper">
        <button class="filter-btn active" onclick="filterPharmacies('all')">All ({{ $pharmacies->count() }})</button>
        <button class="filter-btn" onclick="filterPharmacies('pending')">Pending ({{ $pharmacies->where('status', 'pending')->count() }})</button>
        <button class="filter-btn" onclick="filterPharmacies('approved')">Approved ({{ $pharmacies->where('status', 'approved')->count() }})</button>
        <button class="filter-btn" onclick="filterPharmacies('rejected')">Rejected ({{ $pharmacies->where('status', 'rejected')->count() }})</button>
        <button class="filter-btn" onclick="filterPharmacies('banned')">Banned ({{ $pharmacies->where('status', 'banned')->count() }})</button>
    </div>

    <!-- Table -->
    <div class="table-wrapper">
        <table class="pharmacy-table">
            <thead>
                <tr>
                    <th>Shop Name</th>
                    <th>Owner Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Trade License</th>
                    <th>License Date</th>
                    <th>Validity</th>
                    <th>Registration Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pharmacies as $pharmacy)
                <tr class="pharmacy-row" data-status="{{ $pharmacy->status }}">
                    <td><strong>{{ $pharmacy->shop_name }}</strong></td>
                    <td>{{ $pharmacy->owner_name }}</td>
                    <td>{{ $pharmacy->email }}</td>
                    <td>{{ $pharmacy->phone }}</td>
                    <td>{{ $pharmacy->trade_license_number }}</td>
                    <td>{{ $pharmacy->trade_license_date->format('M d, Y') }}</td>
                    <td>
                        @if($pharmacy->license_expiry_date)
                            @if($pharmacy->isLicenseExpired())
                                <span class="license-status expired">
                                    <i class='bx bx-x-circle'></i> Expired
                                </span>
                            @else
                                <span class="license-status valid">
                                    <i class='bx bx-check-circle'></i> Valid until {{ $pharmacy->license_expiry_date->format('M d, Y') }}
                                </span>
                            @endif
                        @else
                            <span style="color: #9ca3af;">N/A</span>
                        @endif
                    </td>
                    <td>{{ $pharmacy->created_at->format('M d, Y') }}</td>
                    <td>
                        <span class="status-badge {{ $pharmacy->status }}">{{ $pharmacy->status }}</span>
                    </td>
                    <td>
                        <div class="action-buttons">
                            @if($pharmacy->status === 'pending')
                                <form action="{{ route('admin.pharmacy.approve', $pharmacy->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn-action btn-approve" onclick="return confirm('Approve this pharmacy?')">
                                        <i class='bx bx-check'></i> Approve
                                    </button>
                                </form>
                                <button class="btn-action btn-reject" onclick="showRejectModal({{ $pharmacy->id }})">
                                    <i class='bx bx-x'></i> Reject
                                </button>
                            @endif

                            @if($pharmacy->status === 'approved')
                                <form action="{{ route('admin.pharmacy.ban', $pharmacy->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn-action btn-ban" onclick="return confirm('Ban this pharmacy?')">
                                        <i class='bx bx-block'></i> Ban
                                    </button>
                                </form>
                            @endif

                            @if($pharmacy->status === 'banned')
                                <form action="{{ route('admin.pharmacy.unban', $pharmacy->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn-action btn-unban" onclick="return confirm('Unban this pharmacy?')">
                                        <i class='bx bx-check-circle'></i> Unban
                                    </button>
                                </form>
                            @endif

                            <form action="{{ route('admin.pharmacy.destroy', $pharmacy->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-delete" onclick="return confirm('Permanently delete this pharmacy?')">
                                    <i class='bx bx-trash'></i> Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" style="text-align: center; padding: 40px; color: #9ca3af;">
                        No pharmacies registered yet.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Reject Modal -->
<div class="modal" id="rejectModal">
    <div class="modal-content">
        <div class="modal-header">Reject Pharmacy Registration</div>
        <div class="modal-body">
            <p>Please provide a reason for rejection:</p>
            <form id="rejectForm" method="POST">
                @csrf
                <textarea name="rejection_reason" rows="4" placeholder="Enter rejection reason..." required></textarea>
                <div class="modal-footer">
                    <button type="button" class="btn-action btn-delete" onclick="closeRejectModal()">Cancel</button>
                    <button type="submit" class="btn-action btn-reject">Reject</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function filterPharmacies(status) {
        const rows = document.querySelectorAll('.pharmacy-row');
        const buttons = document.querySelectorAll('.filter-btn');
        
        buttons.forEach(btn => btn.classList.remove('active'));
        event.target.classList.add('active');
        
        rows.forEach(row => {
            if (status === 'all' || row.dataset.status === status) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    function showRejectModal(pharmacyId) {
        const modal = document.getElementById('rejectModal');
        const form = document.getElementById('rejectForm');
        form.action = `/admin/pharmacy/${pharmacyId}/reject`;
        modal.classList.add('show');
    }

    function closeRejectModal() {
        const modal = document.getElementById('rejectModal');
        modal.classList.remove('show');
    }

    // Close modal on outside click
    window.onclick = function(event) {
        const modal = document.getElementById('rejectModal');
        if (event.target === modal) {
            closeRejectModal();
        }
    }
</script>
@endsection
