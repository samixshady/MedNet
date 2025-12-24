@extends('layouts.admin')

@section('title', 'Prescription Approvals')

@section('content')
<style>
    .prescription-container {
        padding: 24px;
        background: #f8f9fa;
        min-height: 100vh;
    }

    .prescription-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 32px;
        flex-wrap: wrap;
        gap: 16px;
    }

    .prescription-header h1 {
        font-size: 28px;
        font-weight: 700;
        color: #1a202c;
        margin: 0;
    }

    .alert-banner {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 16px 20px;
        background: linear-gradient(135deg, #fef3c7, #fde68a);
        border-left: 4px solid #f59e0b;
        border-radius: 12px;
        margin-bottom: 24px;
        box-shadow: 0 2px 8px rgba(245, 158, 11, 0.15);
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.95; }
    }

    .alert-icon {
        font-size: 24px;
        color: #f59e0b;
    }

    .alert-text {
        flex: 1;
        font-size: 15px;
        font-weight: 600;
        color: #92400e;
    }

    .alert-badge {
        background: #f59e0b;
        color: white;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 700;
    }

    .tabs-container {
        background: white;
        border-radius: 12px;
        padding: 8px;
        margin-bottom: 24px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .tab-button {
        flex: 1;
        min-width: 150px;
        padding: 12px 24px;
        border: none;
        background: transparent;
        color: #718096;
        font-weight: 600;
        font-size: 14px;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .tab-button:hover {
        background: #f7fafc;
        color: #2d3748;
    }

    .tab-button.active {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    .tab-badge {
        background: rgba(255, 255, 255, 0.3);
        padding: 2px 8px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 700;
    }

    .tab-button.active .tab-badge {
        background: rgba(255, 255, 255, 0.25);
    }

    .tab-content {
        display: none;
    }

    .tab-content.active {
        display: block;
        animation: fadeIn 0.4s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Filters Section */
    .filters-container {
        background: white;
        border-radius: 16px;
        padding: 24px;
        margin-bottom: 24px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        border: 1px solid #e2e8f0;
    }

    .filters-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
    }

    .filter-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .filter-label {
        font-size: 13px;
        font-weight: 600;
        color: #475569;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .filter-label i {
        font-size: 16px;
        color: #3b82f6;
    }

    .filter-select {
        padding: 10px 14px;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 500;
        color: #1e293b;
        background: white;
        cursor: pointer;
        transition: all 0.2s ease;
        outline: none;
    }

    .filter-select:hover {
        border-color: #cbd5e1;
    }

    .filter-select:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .filter-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid #e2e8f0;
        flex-wrap: wrap;
        gap: 12px;
    }

    .clear-filters-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        background: #ef4444;
        color: white;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .clear-filters-btn:hover {
        background: #dc2626;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }

    .clear-filters-btn i {
        font-size: 16px;
    }

    .active-filters-text {
        font-size: 13px;
        color: #64748b;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .active-filters-text i {
        color: #3b82f6;
        font-size: 16px;
    }

    @media (max-width: 768px) {
        .filters-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .filter-actions {
            flex-direction: column;
            align-items: stretch;
        }

        .clear-filters-btn {
            width: 100%;
            justify-content: center;
        }
    }
        to { opacity: 1; transform: translateY(0); }
    }

    .orders-grid {
        display: grid;
        gap: 20px;
    }

    .order-card {
        background: white;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        border-left: 4px solid transparent;
    }

    .order-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    }

    .order-card.pending {
        border-left-color: #f59e0b;
        background: linear-gradient(to right, #fffbeb 0%, white 20%);
    }

    .order-card.approved {
        border-left-color: #10b981;
    }

    .order-card.rejected {
        border-left-color: #ef4444;
    }

    .order-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 12px;
    }

    .order-id {
        font-size: 18px;
        font-weight: 700;
        color: #1a202c;
        margin-bottom: 4px;
    }

    .order-date {
        font-size: 13px;
        color: #718096;
    }

    .status-badge {
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
        text-transform: capitalize;
    }

    .status-badge.pending {
        background: #fef3c7;
        color: #92400e;
    }

    .status-badge.approved {
        background: #d1fae5;
        color: #065f46;
    }

    .status-badge.rejected {
        background: #fee2e2;
        color: #991b1b;
    }

    .order-body {
        margin-bottom: 20px;
    }

    .customer-info {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 16px;
        padding: 12px;
        background: #f7fafc;
        border-radius: 8px;
    }

    .customer-avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea, #764ba2);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 18px;
    }

    .customer-details {
        flex: 1;
    }

    .customer-name {
        font-weight: 600;
        color: #1a202c;
        font-size: 15px;
        margin-bottom: 2px;
    }

    .customer-email {
        font-size: 13px;
        color: #718096;
    }

    .order-items {
        margin-bottom: 16px;
    }

    .order-items-title {
        font-size: 14px;
        font-weight: 600;
        color: #4a5568;
        margin-bottom: 12px;
    }

    .item-row {
        display: flex;
        justify-content: space-between;
        padding: 10px 12px;
        background: #f7fafc;
        border-radius: 6px;
        margin-bottom: 8px;
        font-size: 14px;
    }

    .item-name {
        color: #2d3748;
        font-weight: 500;
    }

    .item-qty {
        color: #718096;
    }

    .prescription-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 10px;
        background: #fef3c7;
        color: #92400e;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
        margin-left: 8px;
    }

    .order-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .btn {
        flex: 1;
        min-width: 140px;
        padding: 12px 24px;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-approve {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    .btn-approve:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(16, 185, 129, 0.4);
    }

    .btn-reject {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: white;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }

    .btn-reject:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(239, 68, 68, 0.4);
    }

    .btn-view {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: white;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }

    .btn-view:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(59, 130, 246, 0.4);
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .empty-icon {
        font-size: 64px;
        color: #cbd5e0;
        margin-bottom: 16px;
    }

    .empty-title {
        font-size: 20px;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 8px;
    }

    .empty-text {
        font-size: 14px;
        color: #718096;
    }

    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        z-index: 9999;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .modal.active {
        display: flex;
        animation: fadeIn 0.3s ease;
    }

    .modal-content {
        background: white;
        border-radius: 16px;
        padding: 32px;
        max-width: 500px;
        width: 100%;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        animation: slideUp 0.3s ease;
    }

    @keyframes slideUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .modal-header {
        margin-bottom: 24px;
    }

    .modal-title {
        font-size: 22px;
        font-weight: 700;
        color: #1a202c;
        margin-bottom: 8px;
    }

    .modal-subtitle {
        font-size: 14px;
        color: #718096;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 8px;
    }

    .form-control {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.3s ease;
        font-family: inherit;
    }

    .form-control:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .modal-actions {
        display: flex;
        gap: 12px;
        margin-top: 24px;
        flex-wrap: wrap;
    }

    .btn-cancel {
        flex: 1;
        min-width: 120px;
        padding: 12px 24px;
        border: 2px solid #e2e8f0;
        background: white;
        color: #4a5568;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-cancel:hover {
        background: #f7fafc;
        border-color: #cbd5e0;
    }

    .btn-submit {
        flex: 1;
        min-width: 120px;
        padding: 12px 24px;
        border: none;
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: white;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }

    /* Prescription Image Viewer Modal - Grid Layout */
    .image-viewer-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.95);
        z-index: 10000;
        align-items: center;
        justify-content: center;
        padding: 20px;
        backdrop-filter: blur(10px);
    }

    .image-viewer-modal.active {
        display: flex;
        animation: fadeIn 0.25s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .image-viewer-content {
        background: white;
        border-radius: 20px;
        width: 95vw;
        max-width: 1400px;
        max-height: 90vh;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        box-shadow: 0 25px 100px rgba(0, 0, 0, 0.4);
        animation: slideUp 0.3s ease;
    }

    @keyframes slideUp {
        from {
            transform: translateY(30px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .image-viewer-header {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        padding: 24px 28px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .image-viewer-title {
        color: white;
        font-size: 20px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 12px;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .image-viewer-title i {
        font-size: 26px;
    }

    .image-viewer-close {
        background: rgba(255, 255, 255, 0.2);
        border: none;
        color: white;
        font-size: 22px;
        cursor: pointer;
        width: 42px;
        height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        transition: all 0.2s ease;
        backdrop-filter: blur(10px);
    }

    .image-viewer-close:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: rotate(90deg);
    }

    .image-viewer-close:active {
        transform: scale(0.9) rotate(90deg);
    }

    .image-viewer-body {
        flex: 1;
        overflow-y: auto;
        overflow-x: hidden;
        background: #f8fafc;
        padding: 28px;
    }

    .image-viewer-body::-webkit-scrollbar {
        width: 8px;
    }

    .image-viewer-body::-webkit-scrollbar-track {
        background: #e2e8f0;
    }

    .image-viewer-body::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }

    .image-viewer-body::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    /* Grid Layout for Prescription Items */
    .prescription-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    .prescription-item-box {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        border: 2px solid transparent;
        cursor: pointer;
    }

    .prescription-item-box:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        border-color: #3b82f6;
    }

    .prescription-item-header {
        background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
        padding: 16px;
        border-bottom: 2px solid #e2e8f0;
    }

    .prescription-item-title {
        font-size: 14px;
        font-weight: 700;
        color: #1e293b;
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 6px;
    }

    .prescription-item-title i {
        color: #3b82f6;
        font-size: 18px;
    }

    .prescription-item-subtitle {
        font-size: 12px;
        color: #64748b;
        font-weight: 500;
    }

    .prescription-item-body {
        padding: 16px;
        min-height: 240px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #ffffff;
        position: relative;
    }

    .prescription-item-body img {
        width: 100%;
        height: 220px;
        object-fit: cover;
        border-radius: 8px;
        transition: transform 0.3s ease;
    }

    .prescription-item-box:hover .prescription-item-body img {
        transform: scale(1.05);
    }

    .prescription-item-body iframe {
        width: 100%;
        height: 220px;
        border: none;
        border-radius: 8px;
        background: white;
    }

    .prescription-item-footer {
        background: #f8fafc;
        padding: 12px 16px;
        border-top: 1px solid #e2e8f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .view-fullscreen-btn {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s ease;
        width: 100%;
        justify-content: center;
    }

    .view-fullscreen-btn:hover {
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
    }

    .view-fullscreen-btn i {
        font-size: 14px;
    }

    .viewer-loading {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 12px;
        color: #64748b;
        font-size: 14px;
    }

    .viewer-loading i {
        font-size: 40px;
        color: #3b82f6;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    .viewer-error {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
        color: #ef4444;
        text-align: center;
        padding: 20px;
    }

    .viewer-error i {
        font-size: 48px;
        opacity: 0.5;
    }

    .viewer-error-title {
        font-weight: 600;
        font-size: 14px;
    }

    .viewer-error-text {
        font-size: 12px;
        color: #94a3b8;
    }

    /* Mobile Responsive */
    @media (max-width: 1024px) {
        .prescription-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }
    }

    @media (max-width: 768px) {
        .image-viewer-modal {
            padding: 12px;
        }

        .image-viewer-content {
            width: 100%;
            max-height: 95vh;
            border-radius: 16px;
        }

        .image-viewer-header {
            padding: 18px 20px;
        }

        .image-viewer-title {
            font-size: 16px;
        }

        .image-viewer-title i {
            font-size: 20px;
        }

        .image-viewer-close {
            width: 38px;
            height: 38px;
            font-size: 20px;
        }

        .image-viewer-body {
            padding: 16px;
        }

        .prescription-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .prescription-item-body {
            min-height: 200px;
        }

        .prescription-item-body img,
        .prescription-item-body iframe {
            height: 180px;
        }
    }

    .reviewed-info {
        margin-top: 16px;
        padding: 12px;
        background: #f7fafc;
        border-radius: 8px;
        font-size: 13px;
        color: #4a5568;
    }

    .reviewed-info strong {
        color: #2d3748;
    }

    .rejection-reason {
        margin-top: 12px;
        padding: 12px;
        background: #fef2f2;
        border-left: 3px solid #ef4444;
        border-radius: 6px;
        font-size: 13px;
        color: #991b1b;
    }

    @media (max-width: 768px) {
        .prescription-container {
            padding: 16px;
        }

        .prescription-header h1 {
            font-size: 22px;
        }

        .order-actions {
            flex-direction: column;
        }

        .btn {
            width: 100%;
        }

        .tabs-container {
            flex-direction: column;
        }

        .tab-button {
            width: 100%;
        }
    }
</style>

<div class="prescription-container">
    <!-- Header -->
    <div class="prescription-header">
        <h1>📋 Prescription Approvals</h1>
    </div>

    <!-- Alert Banner -->
    @if($pendingCount > 0)
    <div class="alert-banner">
        <i class='bx bx-error-circle alert-icon'></i>
        <div class="alert-text">
            @if($pendingCount === 1)
                ⚠️ 1 order requires your attention
            @else
                ⚠️ {{ $pendingCount }} orders require your attention
            @endif
        </div>
        <span class="alert-badge">{{ $pendingCount }}</span>
    </div>
    @endif

    <!-- Success/Error Messages -->
    @if(session('success'))
    <div style="padding: 16px; background: #d1fae5; border-left: 4px solid #10b981; border-radius: 8px; margin-bottom: 24px; color: #065f46; font-weight: 600;">
        <i class='bx bx-check-circle' style="margin-right: 8px;"></i>
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div style="padding: 16px; background: #fee2e2; border-left: 4px solid #ef4444; border-radius: 8px; margin-bottom: 24px; color: #991b1b; font-weight: 600;">
        <i class='bx bx-x-circle' style="margin-right: 8px;"></i>
        {{ session('error') }}
    </div>
    @endif

    <!-- Tabs -->
    <div class="tabs-container">
        <button class="tab-button active" data-tab="pending">
            <i class='bx bx-time-five'></i>
            Pending
            <span class="tab-badge">{{ $pendingCount }}</span>
        </button>
        <button class="tab-button" data-tab="approved">
            <i class='bx bx-check-circle'></i>
            Approved
            <span class="tab-badge">{{ $approvedOrders->count() }}</span>
        </button>
        <button class="tab-button" data-tab="rejected">
            <i class='bx bx-x-circle'></i>
            Rejected
            <span class="tab-badge">{{ $rejectedOrders->count() }}</span>
        </button>
    </div>

    <!-- Filters Section -->
    <div class="filters-container">
        <form method="GET" action="{{ route('admin.prescriptions.index') }}" id="filtersForm">
            <div class="filters-grid">
                <div class="filter-group">
                    <label class="filter-label">
                        <i class='bx bx-sort-alt-2'></i>
                        Sort By
                    </label>
                    <select name="sort_by" class="filter-select" onchange="this.form.submit()">
                        <option value="newest" {{ $sortBy === 'newest' ? 'selected' : '' }}>Newest First</option>
                        <option value="oldest" {{ $sortBy === 'oldest' ? 'selected' : '' }}>Oldest First</option>
                        <option value="urgent" {{ $sortBy === 'urgent' ? 'selected' : '' }}>Most Urgent</option>
                        <option value="amount_high" {{ $sortBy === 'amount_high' ? 'selected' : '' }}>Amount: High to Low</option>
                        <option value="amount_low" {{ $sortBy === 'amount_low' ? 'selected' : '' }}>Amount: Low to High</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label class="filter-label">
                        <i class='bx bx-package'></i>
                        Delivery Type
                    </label>
                    <select name="delivery_filter" class="filter-select" onchange="this.form.submit()">
                        <option value="all" {{ $deliveryFilter === 'all' ? 'selected' : '' }}>All Deliveries</option>
                        <option value="overnight" {{ $deliveryFilter === 'overnight' ? 'selected' : '' }}>🔴 Overnight (Urgent)</option>
                        <option value="express" {{ $deliveryFilter === 'express' ? 'selected' : '' }}>🟡 Express</option>
                        <option value="standard" {{ $deliveryFilter === 'standard' ? 'selected' : '' }}>Standard</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label class="filter-label">
                        <i class='bx bx-file-blank'></i>
                        Prescription Status
                    </label>
                    <select name="prescription_filter" class="filter-select" onchange="this.form.submit()">
                        <option value="all" {{ $prescriptionFilter === 'all' ? 'selected' : '' }}>All Orders</option>
                        <option value="with_prescription" {{ $prescriptionFilter === 'with_prescription' ? 'selected' : '' }}>✅ With Prescription</option>
                        <option value="missing_prescription" {{ $prescriptionFilter === 'missing_prescription' ? 'selected' : '' }}>⚠️ Missing Prescription</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label class="filter-label">
                        <i class='bx bx-calendar'></i>
                        Date Range
                    </label>
                    <select name="date_filter" class="filter-select" onchange="this.form.submit()">
                        <option value="all" {{ $dateFilter === 'all' ? 'selected' : '' }}>All Time</option>
                        <option value="today" {{ $dateFilter === 'today' ? 'selected' : '' }}>Today</option>
                        <option value="yesterday" {{ $dateFilter === 'yesterday' ? 'selected' : '' }}>Yesterday</option>
                        <option value="week" {{ $dateFilter === 'week' ? 'selected' : '' }}>Last 7 Days</option>
                        <option value="month" {{ $dateFilter === 'month' ? 'selected' : '' }}>Last 30 Days</option>
                    </select>
                </div>
            </div>

            @if($sortBy !== 'newest' || $deliveryFilter !== 'all' || $prescriptionFilter !== 'all' || $dateFilter !== 'all')
            <div class="filter-actions">
                <a href="{{ route('admin.prescriptions.index') }}" class="clear-filters-btn">
                    <i class='bx bx-x'></i>
                    Clear All Filters
                </a>
                <div class="active-filters-text">
                    <i class='bx bx-filter-alt'></i>
                    {{ $pendingOrders->count() }} order(s) match your filters
                </div>
            </div>
            @endif
        </form>
    </div>

    <!-- Pending Orders Tab -->
    <div class="tab-content active" id="pending">
        <div class="orders-grid">
            @forelse($pendingOrders as $order)
            <div class="order-card pending">
                <div class="order-header">
                    <div>
                        <div class="order-id">
                            Order #{{ $order->id }}
                            @if($order->delivery_option === 'overnight')
                                <span style="display: inline-flex; align-items: center; gap: 4px; background: #fee2e2; color: #991b1b; padding: 4px 10px; border-radius: 12px; font-size: 11px; font-weight: 700; margin-left: 8px;">
                                    <i class='bx bx-bolt-circle' style="font-size: 14px;"></i>
                                    OVERNIGHT
                                </span>
                            @elseif($order->delivery_option === 'express')
                                <span style="display: inline-flex; align-items: center; gap: 4px; background: #fef3c7; color: #92400e; padding: 4px 10px; border-radius: 12px; font-size: 11px; font-weight: 700; margin-left: 8px;">
                                    <i class='bx bx-tachometer' style="font-size: 14px;"></i>
                                    EXPRESS
                                </span>
                            @endif
                        </div>
                        <div class="order-date">{{ $order->created_at->format('M d, Y • h:i A') }}</div>
                    </div>
                    <span class="status-badge pending">Pending Review</span>
                </div>

                <div class="order-body">
                    <div class="customer-info">
                        <div class="customer-avatar">
                            {{ strtoupper(substr($order->user->name ?? 'U', 0, 1)) }}
                        </div>
                        <div class="customer-details">
                            <div class="customer-name">{{ $order->user->name ?? 'Unknown' }}</div>
                            <div class="customer-email">{{ $order->user->email ?? 'N/A' }}</div>
                        </div>
                    </div>

                    <div class="order-items">
                        <div class="order-items-title">Order Items:</div>
                        @foreach($order->items as $item)
                        <div class="item-row">
                            <span class="item-name">
                                {{ $item->product->name ?? 'Product' }}
                                @if($item->product && $item->product->prescription_required)
                                <span class="prescription-badge">
                                    <i class='bx bx-file-blank'></i> Rx Required
                                </span>
                                @endif
                            </span>
                            <span class="item-qty">Qty: {{ $item->quantity }}</span>
                        </div>
                        @endforeach
                    </div>

                    <div style="padding: 12px; background: #fef3c7; border-radius: 8px; margin-bottom: 16px;">
                        <strong style="color: #92400e; font-size: 14px;">
                            <i class='bx bx-info-circle'></i> Total Amount: ₱{{ number_format($order->total_amount, 2) }}
                        </strong>
                    </div>
                </div>

                <div class="order-actions">
                    @php
                        $hasPrescriptions = $order->items()->whereNotNull('prescription_file_path')->count() > 0;
                    @endphp
                    
                    @if($hasPrescriptions)
                        @foreach($order->items()->whereNotNull('prescription_file_path')->get() as $item)
                        <button class="btn btn-view" onclick="viewPrescription('{{ route('admin.prescriptions.view', $item->id) }}', '{{ $item->product->name ?? 'Prescription' }}')">
                            <i class='bx bx-image'></i> View Prescription
                        </button>
                        @endforeach
                    @else
                        <div style="padding: 14px; background: #fff3cd; border-radius: 8px; border-left: 4px solid #ffc107; margin-bottom: 12px;">
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <i class='bx bx-error-circle' style="font-size: 20px; color: #856404;"></i>
                                <span style="color: #856404; font-weight: 600; font-size: 14px;">Prescription Missing</span>
                            </div>
                        </div>
                    @endif
                    
                    <button class="btn btn-approve" onclick="approveOrder({{ $order->id }})">
                        <i class='bx bx-check-circle'></i> Approve
                    </button>
                    <button class="btn btn-reject" onclick="openRejectModal({{ $order->id }})">
                        <i class='bx bx-x-circle'></i> Reject
                    </button>
                </div>
            </div>
            @empty
            <div class="empty-state">
                <div class="empty-icon">
                    <i class='bx bx-check-double'></i>
                </div>
                <div class="empty-title">All Clear!</div>
                <div class="empty-text">No pending prescription approvals at the moment.</div>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Approved Orders Tab -->
    <div class="tab-content" id="approved">
        <div class="orders-grid">
            @forelse($approvedOrders as $order)
            <div class="order-card approved">
                <div class="order-header">
                    <div>
                        <div class="order-id">Order #{{ $order->id }}</div>
                        <div class="order-date">{{ $order->created_at->format('M d, Y • h:i A') }}</div>
                    </div>
                    <span class="status-badge approved">Approved</span>
                </div>

                <div class="order-body">
                    <div class="customer-info">
                        <div class="customer-avatar">
                            {{ strtoupper(substr($order->user->name ?? 'U', 0, 1)) }}
                        </div>
                        <div class="customer-details">
                            <div class="customer-name">{{ $order->user->name ?? 'Unknown' }}</div>
                            <div class="customer-email">{{ $order->user->email ?? 'N/A' }}</div>
                        </div>
                    </div>

                    <div class="order-items">
                        <div class="order-items-title">Order Items:</div>
                        @foreach($order->items as $item)
                        <div class="item-row">
                            <span class="item-name">{{ $item->product->name ?? 'Product' }}</span>
                            <span class="item-qty">Qty: {{ $item->quantity }}</span>
                        </div>
                        @endforeach
                    </div>

                    @if($order->prescription_reviewed_at)
                    <div class="reviewed-info">
                        <strong>Approved:</strong> {{ $order->prescription_reviewed_at->format('M d, Y • h:i A') }}
                    </div>
                    @endif
                </div>
            </div>
            @empty
            <div class="empty-state">
                <div class="empty-icon">
                    <i class='bx bx-package'></i>
                </div>
                <div class="empty-title">No Approved Orders</div>
                <div class="empty-text">Approved prescription orders will appear here.</div>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Rejected Orders Tab -->
    <div class="tab-content" id="rejected">
        <div class="orders-grid">
            @forelse($rejectedOrders as $order)
            <div class="order-card rejected">
                <div class="order-header">
                    <div>
                        <div class="order-id">Order #{{ $order->id }}</div>
                        <div class="order-date">{{ $order->created_at->format('M d, Y • h:i A') }}</div>
                    </div>
                    <span class="status-badge rejected">Rejected</span>
                </div>

                <div class="order-body">
                    <div class="customer-info">
                        <div class="customer-avatar">
                            {{ strtoupper(substr($order->user->name ?? 'U', 0, 1)) }}
                        </div>
                        <div class="customer-details">
                            <div class="customer-name">{{ $order->user->name ?? 'Unknown' }}</div>
                            <div class="customer-email">{{ $order->user->email ?? 'N/A' }}</div>
                        </div>
                    </div>

                    <div class="order-items">
                        <div class="order-items-title">Order Items:</div>
                        @foreach($order->items as $item)
                        <div class="item-row">
                            <span class="item-name">{{ $item->product->name ?? 'Product' }}</span>
                            <span class="item-qty">Qty: {{ $item->quantity }}</span>
                        </div>
                        @endforeach
                    </div>

                    @if($order->prescription_rejection_reason)
                    <div class="rejection-reason">
                        <strong>Rejection Reason:</strong><br>
                        {{ $order->prescription_rejection_reason }}
                    </div>
                    @endif

                    @if($order->prescription_reviewed_at)
                    <div class="reviewed-info">
                        <strong>Rejected:</strong> {{ $order->prescription_reviewed_at->format('M d, Y • h:i A') }}
                    </div>
                    @endif
                </div>
            </div>
            @empty
            <div class="empty-state">
                <div class="empty-icon">
                    <i class='bx bx-block'></i>
                </div>
                <div class="empty-title">No Rejected Orders</div>
                <div class="empty-text">Rejected prescription orders will appear here.</div>
            </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Prescription Image Viewer Modal -->
<div class="image-viewer-modal" id="imageViewerModal">
    <div class="image-viewer-content">
        <div class="image-viewer-header">
            <div class="image-viewer-title" id="imageViewerTitle">
                <i class='bx bx-file-blank'></i> Prescription Files
            </div>
            <button class="image-viewer-close" onclick="closeImageViewer()">
                <i class='bx bx-x'></i>
            </button>
        </div>
        <div class="image-viewer-body" id="imageViewerBody">
            <!-- Prescription grid will be loaded here -->
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div class="modal" id="rejectModal">
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title">Reject Prescription</div>
            <div class="modal-subtitle">Please provide a reason for rejecting this order</div>
        </div>
        <form id="rejectForm" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label" for="reason">Rejection Reason *</label>
                <textarea 
                    class="form-control" 
                    id="reason" 
                    name="reason" 
                    rows="4" 
                    placeholder="e.g., Prescription is unclear, expired, or doesn't match the ordered items..."
                    required
                ></textarea>
            </div>
            <div class="modal-actions">
                <button type="button" class="btn-cancel" onclick="closeRejectModal()">Cancel</button>
                <button type="submit" class="btn-submit">
                    <i class='bx bx-x-circle'></i> Reject Order
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Tab switching
    document.querySelectorAll('.tab-button').forEach(button => {
        button.addEventListener('click', () => {
            const tabName = button.dataset.tab;
            
            // Update active states
            document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
            
            button.classList.add('active');
            document.getElementById(tabName).classList.add('active');
        });
    });

    // Approve order
    function approveOrder(orderId) {
        if (confirm('Are you sure you want to approve this prescription order?')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/prescriptions/${orderId}/approve`;
            
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = csrfToken;
            
            form.appendChild(csrfInput);
            document.body.appendChild(form);
            form.submit();
        }
    }

    // Open reject modal
    function openRejectModal(orderId) {
        const modal = document.getElementById('rejectModal');
        const form = document.getElementById('rejectForm');
        form.action = `/admin/prescriptions/${orderId}/reject`;
        modal.classList.add('active');
    }

    // Close reject modal
    function closeRejectModal() {
        const modal = document.getElementById('rejectModal');
        modal.classList.remove('active');
        document.getElementById('reason').value = '';
    }

    // Close modal on outside click
    document.getElementById('rejectModal').addEventListener('click', (e) => {
        if (e.target.id === 'rejectModal') {
            closeRejectModal();
        }
    });

    // Prescription viewer with grid layout
    function viewPrescription(url, title) {
        const modal = document.getElementById('imageViewerModal');
        const body = document.getElementById('imageViewerBody');
        
        // Show loading
        body.innerHTML = `
            <div class="viewer-loading">
                <i class='bx bx-loader-alt'></i>
                <span>Loading prescriptions...</span>
            </div>
        `;
        
        modal.classList.add('active');
        
        // Create grid layout
        setTimeout(() => {
            const isPDF = url.toLowerCase().includes('.pdf');
            const fileType = isPDF ? 'PDF Document' : 'Image';
            
            body.innerHTML = `
                <div class="prescription-grid">
                    <div class="prescription-item-box">
                        <div class="prescription-item-header">
                            <div class="prescription-item-title">
                                <i class='bx ${isPDF ? 'bxs-file-pdf' : 'bxs-image'}'></i>
                                ${title}
                            </div>
                            <div class="prescription-item-subtitle">${fileType}</div>
                        </div>
                        <div class="prescription-item-body" id="prescription-content-1">
                            <div class="viewer-loading">
                                <i class='bx bx-loader-alt'></i>
                                <span>Loading...</span>
                            </div>
                        </div>
                        <div class="prescription-item-footer">
                            <button class="view-fullscreen-btn" onclick="viewFullscreen('${url}')">
                                <i class='bx bx-fullscreen'></i>
                                View Fullscreen
                            </button>
                        </div>
                    </div>
                </div>
            `;
            
            // Load the actual content
            const contentDiv = document.getElementById('prescription-content-1');
            
            if (isPDF) {
                contentDiv.innerHTML = `<iframe src="${url}" type="application/pdf"></iframe>`;
            } else {
                const img = new Image();
                img.onload = function() {
                    contentDiv.innerHTML = `<img src="${url}" alt="Prescription" />`;
                };
                img.onerror = function() {
                    contentDiv.innerHTML = `
                        <div class="viewer-error">
                            <i class='bx bx-error-circle'></i>
                            <div class="viewer-error-title">Failed to load</div>
                            <div class="viewer-error-text">File may be missing or corrupted</div>
                        </div>
                    `;
                };
                img.src = url;
            }
        }, 200);
    }
    
    // View prescription in fullscreen
    function viewFullscreen(url) {
        window.open(url, '_blank');
    }

    function closeImageViewer() {
        const modal = document.getElementById('imageViewerModal');
        modal.classList.remove('active');
        document.getElementById('imageViewerBody').innerHTML = '';
    }

    // Close image viewer on escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeImageViewer();
            closeRejectModal();
        }
    });

    // Close image viewer on outside click
    document.getElementById('imageViewerModal').addEventListener('click', (e) => {
        if (e.target.id === 'imageViewerModal') {
            closeImageViewer();
        }
    });
</script>
@endsection
