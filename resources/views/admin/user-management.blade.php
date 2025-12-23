@extends('layouts.admin')

@section('content')
<style>
    .user-management-container {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: calc(100vh - 64px);
        padding: 2rem;
    }
    .user-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
    }
    .user-table {
        width: 100%;
        border-collapse: collapse;
    }
    .user-table thead th {
        background: #f8f9fa;
        padding: 1rem;
        text-align: left;
        font-weight: 600;
        color: #333;
        border-bottom: 2px solid #e9ecef;
    }
    .user-table tbody tr {
        border-bottom: 1px solid #e9ecef;
        transition: background-color 0.2s;
    }
    .user-table tbody tr:hover {
        background-color: #f8f9fa;
    }
    .user-table td {
        padding: 1rem;
        color: #333;
    }
    .avatar {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        font-weight: bold;
        margin-right: 0.75rem;
    }
    .badge-green {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        background: #d4edda;
        color: #155724;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 600;
    }
    .badge-purple {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        background: #e2d5f3;
        color: #5e1ba9;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 600;
    }
    .btn-yellow {
        background: #ffc107;
        color: #000;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 600;
        transition: background 0.2s;
        margin-right: 0.5rem;
    }
    .btn-yellow:hover {
        background: #e0a800;
    }
    .btn-red {
        background: #dc3545;
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 600;
        transition: background 0.2s;
    }
    .btn-red:hover {
        background: #c82333;
    }
    .search-box {
        display: flex;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }
    .search-box input {
        flex: 1;
        padding: 0.75rem;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 1rem;
    }
    .search-box button {
        padding: 0.75rem 1.5rem;
        background: #007bff;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 600;
        transition: background 0.2s;
    }
    .search-box button:hover {
        background: #0056b3;
    }
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
    }
    .modal.show {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .modal-content {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        max-width: 500px;
        width: 90%;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    }
    .modal-header {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: #333;
    }
    .modal-body {
        font-size: 1rem;
        color: #666;
        margin-bottom: 1.5rem;
        line-height: 1.5;
    }
    .modal-textarea {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 1rem;
        font-family: Arial, sans-serif;
        margin-bottom: 1rem;
        box-sizing: border-box;
    }
    .modal-footer {
        display: flex;
        gap: 0.75rem;
        justify-content: flex-end;
    }
    .btn-cancel {
        background: #6c757d;
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 600;
        transition: background 0.2s;
    }
    .btn-cancel:hover {
        background: #5a6268;
    }
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-top: 2rem;
    }
    .stat-card {
        background: white;
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
    }
    .stat-card .icon {
        font-size: 2rem;
        margin-bottom: 0.5rem;
    }
    .stat-card .label {
        color: #666;
        font-size: 0.875rem;
        margin-bottom: 0.5rem;
    }
    .stat-card .number {
        font-size: 2rem;
        font-weight: 700;
        color: #333;
    }
    .alert {
        padding: 1rem;
        border-radius: 6px;
        margin-bottom: 1.5rem;
    }
    .alert-success {
        background: #d4edda;
        border: 1px solid #c3e6cb;
        color: #155724;
    }
    .alert-error {
        background: #f8d7da;
        border: 1px solid #f5c6cb;
        color: #721c24;
    }
    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
        color: #666;
    }
</style>

<div class="user-management-container">
    <div style="max-width: 1200px; margin: 0 auto;">
        <div style="margin-bottom: 2rem;">
            <h1 style="font-size: 2rem; font-weight: 700; color: #333; margin-bottom: 0.5rem;">User Management</h1>
            <p style="color: #666; font-size: 0.95rem;">Manage all users, view their details, and take administrative actions.</p>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        <div class="user-card" style="padding: 1.5rem;">
            <form action="{{ route('admin.users.index') }}" method="GET" class="search-box">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name or email...">
                <button type="submit">Search</button>
                @if (request('search'))
                    <a href="{{ route('admin.users.index') }}" style="padding: 0.75rem 1.5rem; background: #6c757d; color: white; text-decoration: none; border-radius: 6px; display: inline-flex; align-items: center;">Clear</a>
                @endif
            </form>
        </div>

        <div class="user-card" style="overflow-x: auto;">
            @if ($users->count() > 0)
                <table class="user-table">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Email</th>
                            <th>Registration Date</th>
                            <th>Status</th>
                            <th style="text-align: right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    <div style="display: flex; align-items: center;">
                                        <div class="avatar">{{ substr($user->name, 0, 1) }}</div>
                                        <div>
                                            <div style="font-weight: 600; color: #333;">{{ $user->name }}</div>
                                            @if ($user->is_admin)
                                                <div class="badge-purple">Admin</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <div>{{ $user->created_at->format('M d, Y') }}</div>
                                    <div style="font-size: 0.85rem; color: #999;">{{ $user->created_at->format('h:i A') }}</div>
                                </td>
                                <td><span class="badge-green">✓ Active</span></td>
                                <td style="text-align: right;">
                                    @if (!$user->is_admin)
                                        <button class="btn-yellow" onclick="openBanModal({{ $user->id }}, '{{ $user->email }}')">Ban</button>
                                    @endif
                                    <button class="btn-red" onclick="openDeleteModal({{ $user->id }}, '{{ $user->email }}')">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div style="padding: 1rem; text-align: center; border-top: 1px solid #e9ecef;">
                    {{ $users->links() }}
                </div>
            @else
                <div class="empty-state">
                    <p style="font-size: 1.1rem; margin-bottom: 0.5rem;">No users found</p>
                    <p>@if (request('search')) Try adjusting your search criteria. @else No users available in the system. @endif</p>
                </div>
            @endif
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="icon">👥</div>
                <div class="label">Total Users</div>
                <div class="number">{{ $users->total() }}</div>
            </div>
            <div class="stat-card">
                <div class="icon">✓</div>
                <div class="label">Active Users</div>
                <div class="number">{{ $users->count() }}</div>
            </div>
            <div class="stat-card">
                <div class="icon">🔑</div>
                <div class="label">Admin Users</div>
                <div class="number">{{ \App\Models\User::where('is_admin', true)->count() }}</div>
            </div>
            <div class="stat-card">
                <div class="icon">🚫</div>
                <div class="label">Banned Emails</div>
                <div class="number">{{ \App\Models\BannedEmail::count() }}</div>
            </div>
        </div>
    </div>
</div>

<div id="banModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">Ban User</div>
        <form id="banForm" method="POST" style="margin: 0;">
            @csrf
            <div class="modal-body">Are you sure you want to ban <strong id="banEmail"></strong>? Their account will be deleted and they won't be able to log in or re-register.</div>
            <div style="margin-bottom: 1rem;">
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333;">Ban Reason (Optional)</label>
                <textarea name="reason" class="modal-textarea" rows="3" placeholder="e.g., Violation of terms of service"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeBanModal()">Cancel</button>
                <button type="submit" class="btn-yellow" style="background: #ffc107; color: #000;">Ban User</button>
            </div>
        </form>
    </div>
</div>

<div id="deleteModal" class="modal">
    <div class="modal-content">
        <div class="modal-header" style="color: #dc3545;">Delete User</div>
        <form id="deleteForm" method="POST" style="margin: 0;">
            @csrf
            @method('DELETE')
            <div class="modal-body"><strong>⚠️ Permanent Deletion</strong><br>Permanently delete <strong id="deleteEmail"></strong>? This action cannot be undone. The user's account and all related data will be removed.</div>
            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeDeleteModal()">Cancel</button>
                <button type="submit" class="btn-red">Delete Permanently</button>
            </div>
        </form>
    </div>
</div>

<script>
function openBanModal(userId, email) {
    document.getElementById('banEmail').textContent = email;
    document.getElementById('banForm').action = '/admin/users/' + userId + '/ban';
    document.getElementById('banModal').classList.add('show');
}

function closeBanModal() {
    document.getElementById('banModal').classList.remove('show');
}

function openDeleteModal(userId, email) {
    document.getElementById('deleteEmail').textContent = email;
    document.getElementById('deleteForm').action = '/admin/users/' + userId;
    document.getElementById('deleteModal').classList.add('show');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.remove('show');
}

window.onclick = function(event) {
    let banModal = document.getElementById('banModal');
    let deleteModal = document.getElementById('deleteModal');
    if (event.target == banModal) banModal.classList.remove('show');
    if (event.target == deleteModal) deleteModal.classList.remove('show');
}

setTimeout(function() {
    let alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        alert.style.display = 'none';
    });
}, 5000);
</script>
@endsection
