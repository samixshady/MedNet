<x-app-layout>
    <x-slot name="header">
        <style>
            * {
                --primary-color: #3b82f6;
                --primary-dark: #1e40af;
                --success-color: #10b981;
                --warning-color: #f59e0b;
                --danger-color: #ef4444;
                --dark-bg: #0f172a;
                --dark-card: #1e293b;
                --dark-border: #334155;
            }

            html.dark * {
                --primary-color: #60a5fa;
                --primary-dark: #3b82f6;
            }

            .prescription-container {
                min-height: 100vh;
                background: #f9fafb;
            }

            html.dark .prescription-container {
                background: #0f172a;
            }

            .prescription-grid {
                display: grid;
                gap: 1.5rem;
            }

            @media (min-width: 1024px) {
                .prescription-grid {
                    grid-template-columns: 350px 1fr;
                }
            }

            .prescription-sidebar {
                background: white;
                border-radius: 12px;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
                padding: 1.5rem;
                height: fit-content;
            }

            html.dark .prescription-sidebar {
                background: var(--dark-card);
                border: 1px solid var(--dark-border);
            }

            .prescription-main {
                background: white;
                border-radius: 12px;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
                padding: 1.5rem;
            }

            html.dark .prescription-main {
                background: var(--dark-card);
                border: 1px solid var(--dark-border);
            }

            .btn-add-prescription {
                width: 100%;
                padding: 0.75rem 1rem;
                background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
                color: white;
                border: none;
                border-radius: 8px;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s ease;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 0.5rem;
                font-size: 0.95rem;
            }

            .btn-add-prescription:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
            }

            @media (max-width: 1023px) {
                .btn-add-prescription {
                    position: fixed;
                    bottom: 1.5rem;
                    right: 1.5rem;
                    width: auto;
                    padding: 1rem;
                    border-radius: 50%;
                    z-index: 40;
                }

                .btn-add-prescription span {
                    display: none;
                }
            }

            .filter-section {
                margin-bottom: 1.5rem;
            }

            .filter-section h3 {
                font-size: 0.875rem;
                font-weight: 700;
                color: #6b7280;
                text-transform: uppercase;
                letter-spacing: 0.05em;
                margin-bottom: 0.75rem;
            }

            html.dark .filter-section h3 {
                color: #cbd5e1;
            }

            .search-box {
                width: 100%;
                padding: 0.75rem;
                border: 1px solid #e5e7eb;
                border-radius: 8px;
                font-size: 0.875rem;
                background: white;
                color: #111;
                transition: all 0.3s ease;
            }

            .search-box:focus {
                outline: none;
                border-color: var(--primary-color);
                box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            }

            html.dark .search-box {
                background: var(--dark-bg);
                border-color: var(--dark-border);
                color: #f1f5f9;
            }

            html.dark .search-box:focus {
                border-color: #60a5fa;
                box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.1);
            }

            .tag-filter {
                display: flex;
                flex-wrap: wrap;
                gap: 0.5rem;
            }

            .tag-chip {
                padding: 0.5rem 0.75rem;
                border-radius: 6px;
                font-size: 0.8rem;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s ease;
                border: 2px solid;
            }

            .tag-chip.active {
                background-color: var(--primary-color);
                color: white;
                border-color: var(--primary-color);
            }

            .tag-chip:not(.active) {
                background-color: #f3f4f6;
                color: #6b7280;
                border-color: #e5e7eb;
            }

            html.dark .tag-chip:not(.active) {
                background-color: rgba(51, 65, 85, 0.5);
                color: #cbd5e1;
                border-color: var(--dark-border);
            }

            .sort-select {
                width: 100%;
                padding: 0.75rem;
                border: 1px solid #e5e7eb;
                border-radius: 8px;
                font-size: 0.875rem;
                background: white;
                color: #111;
                cursor: pointer;
            }

            html.dark .sort-select {
                background: var(--dark-bg);
                border-color: var(--dark-border);
                color: #f1f5f9;
            }

            .prescription-list {
                display: flex;
                flex-direction: column;
                gap: 1rem;
            }

            .prescription-card {
                background: white;
                border: 1px solid #e5e7eb;
                border-radius: 8px;
                padding: 1rem;
                cursor: pointer;
                transition: all 0.3s ease;
            }

            .prescription-card:hover {
                border-color: var(--primary-color);
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                transform: translateY(-2px);
            }

            .prescription-card.active {
                border-color: var(--primary-color);
                background: rgba(59, 130, 246, 0.05);
            }

            html.dark .prescription-card {
                background: rgba(30, 41, 59, 0.5);
                border-color: var(--dark-border);
            }

            html.dark .prescription-card:hover {
                border-color: #60a5fa;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            }

            html.dark .prescription-card.active {
                border-color: #60a5fa;
                background: rgba(96, 165, 250, 0.1);
            }

            .prescription-card-title {
                font-weight: 700;
                color: #111;
                margin-bottom: 0.5rem;
                font-size: 0.95rem;
            }

            html.dark .prescription-card-title {
                color: #f1f5f9;
            }

            .prescription-card-meta {
                font-size: 0.8rem;
                color: #6b7280;
                display: flex;
                gap: 1rem;
                margin-bottom: 0.5rem;
            }

            html.dark .prescription-card-meta {
                color: #94a3b8;
            }

            .prescription-card-tags {
                display: flex;
                flex-wrap: wrap;
                gap: 0.5rem;
            }

            .prescription-card-tag {
                display: inline-block;
                padding: 0.25rem 0.5rem;
                border-radius: 4px;
                font-size: 0.75rem;
                font-weight: 600;
                color: white;
            }

            .empty-state {
                text-align: center;
                padding: 3rem 1rem;
                color: #6b7280;
            }

            html.dark .empty-state {
                color: #94a3b8;
            }

            .empty-state-icon {
                font-size: 3rem;
                margin-bottom: 1rem;
                opacity: 0.5;
            }

            .empty-state-title {
                font-size: 1.125rem;
                font-weight: 700;
                margin-bottom: 0.5rem;
                color: #111;
            }

            html.dark .empty-state-title {
                color: #f1f5f9;
            }

            .prescription-detail {
                display: none;
            }

            .prescription-detail.active {
                display: block;
                animation: fadeIn 0.3s ease;
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(10px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .prescription-detail-header {
                display: flex;
                justify-content: space-between;
                align-items: start;
                margin-bottom: 1.5rem;
                padding-bottom: 1.5rem;
                border-bottom: 1px solid #e5e7eb;
            }

            html.dark .prescription-detail-header {
                border-color: var(--dark-border);
            }

            .prescription-detail-title {
                font-size: 1.5rem;
                font-weight: 700;
                color: #111;
            }

            html.dark .prescription-detail-title {
                color: #f1f5f9;
            }

            .btn-group {
                display: flex;
                gap: 0.5rem;
            }

            .btn-small {
                padding: 0.5rem 0.75rem;
                border: 1px solid;
                border-radius: 6px;
                font-size: 0.8rem;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s ease;
            }

            .btn-primary-small {
                background: var(--primary-color);
                color: white;
                border-color: var(--primary-color);
            }

            .btn-primary-small:hover {
                background: var(--primary-dark);
                border-color: var(--primary-dark);
            }

            .btn-danger-small {
                background: transparent;
                color: var(--danger-color);
                border-color: var(--danger-color);
            }

            .btn-danger-small:hover {
                background: var(--danger-color);
                color: white;
            }

            .detail-section {
                margin-bottom: 1.5rem;
            }

            .detail-label {
                font-size: 0.8rem;
                font-weight: 700;
                color: #6b7280;
                text-transform: uppercase;
                letter-spacing: 0.05em;
                margin-bottom: 0.5rem;
            }

            html.dark .detail-label {
                color: #94a3b8;
            }

            .detail-value {
                font-size: 0.95rem;
                color: #111;
            }

            html.dark .detail-value {
                color: #e2e8f0;
            }

            .file-preview {
                display: flex;
                gap: 1rem;
                flex-wrap: wrap;
                margin-top: 0.75rem;
            }

            .file-item {
                display: flex;
                align-items: center;
                gap: 0.5rem;
                padding: 0.75rem;
                background: #f3f4f6;
                border-radius: 6px;
                font-size: 0.8rem;
            }

            html.dark .file-item {
                background: rgba(51, 65, 85, 0.5);
            }

            .file-icon {
                font-size: 1.25rem;
            }

            .upcoming-reminder {
                background: #fef3c7;
                border-left: 4px solid var(--warning-color);
                padding: 1rem;
                border-radius: 6px;
                margin-bottom: 1rem;
            }

            html.dark .upcoming-reminder {
                background: rgba(245, 158, 11, 0.1);
            }

            .reminder-text {
                color: #92400e;
                font-size: 0.9rem;
            }

            html.dark .reminder-text {
                color: #fbbf24;
            }

            .skeleton {
                background: linear-gradient(90deg, #e5e7eb 25%, #f3f4f6 50%, #e5e7eb 75%);
                background-size: 200% 100%;
                animation: loading 1.5s infinite;
                border-radius: 6px;
            }

            @keyframes loading {
                0% { background-position: 200% 0; }
                100% { background-position: -200% 0; }
            }

            @media (max-width: 767px) {
                .prescription-grid {
                    grid-template-columns: 1fr;
                }

                .prescription-sidebar {
                    position: fixed;
                    left: -350px;
                    top: 0;
                    width: 300px;
                    height: 100vh;
                    overflow-y: auto;
                    z-index: 30;
                    transition: left 0.3s ease;
                    border-radius: 0;
                }

                .prescription-sidebar.open {
                    left: 0;
                }

                .prescription-detail {
                    display: none;
                }

                .prescription-detail.active {
                    display: block;
                    position: fixed;
                    inset: 0;
                    z-index: 35;
                    overflow-y: auto;
                    background: white;
                    border-radius: 0;
                    padding: 1rem;
                }

                html.dark .prescription-detail.active {
                    background: var(--dark-card);
                }

                .btn-back {
                    display: flex;
                    align-items: center;
                    gap: 0.5rem;
                    padding: 0.5rem;
                    margin-bottom: 1rem;
                    color: var(--primary-color);
                    background: none;
                    border: none;
                    cursor: pointer;
                    font-weight: 600;
                }
            }

            @media (max-width: 639px) {
                .prescription-container {
                    padding: 1rem;
                }

                .prescription-main {
                    padding: 1rem;
                }
            }
        </style>
    </x-slot>

    @include('layouts.sidebar')

    <div class="prescription-container">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <!-- Header -->
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 flex items-center gap-3">
                        <i class='bx bx-file'></i> My Prescriptions
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400 mt-1">Organize and manage your medical prescriptions</p>
                </div>
                <button class="btn-add-prescription" onclick="openAddModal()">
                    <i class='bx bx-plus'></i>
                    <span>New Prescription</span>
                </button>
            </div>

            <!-- Main Grid -->
            <div class="prescription-grid">
                <!-- Sidebar / Filters -->
                <aside class="prescription-sidebar">
                    <!-- Search -->
                    <div class="filter-section">
                        <input 
                            type="text" 
                            id="searchInput" 
                            class="search-box" 
                            placeholder="Search prescriptions..."
                            onkeyup="filterPrescriptions()"
                        >
                    </div>

                    <!-- Tags Filter -->
                    @if($tags->count() > 0)
                    <div class="filter-section">
                        <h3><i class='bx bx-tag'></i> Tags</h3>
                        <div class="tag-filter">
                            @foreach($tags as $tag)
                            <button 
                                class="tag-chip" 
                                onclick="filterByTag({{ $tag->id }}, this)"
                                style="background-color: {{ $tag->color }}20; color: {{ $tag->color }}; border-color: {{ $tag->color }}"
                                data-tag-id="{{ $tag->id }}"
                            >
                                {{ $tag->name }}
                            </button>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Sort -->
                    <div class="filter-section">
                        <h3><i class='bx bx-sort'></i> Sort By</h3>
                        <select class="sort-select" onchange="sortPrescriptions(this.value)">
                            <option value="newest">Newest First</option>
                            <option value="oldest">Oldest First</option>
                            <option value="upcoming">Upcoming Visit</option>
                        </select>
                    </div>

                    <!-- Upcoming Reminders -->
                    @if($upcomingReminders > 0)
                    <div class="filter-section">
                        <div class="upcoming-reminder">
                            <div class="reminder-text">
                                <i class='bx bx-bell'></i> {{ $upcomingReminders }} upcoming reminder(s)
                            </div>
                        </div>
                    </div>
                    @endif
                </aside>

                <!-- Main Content -->
                <main class="prescription-main">
                    <!-- Prescription List -->
                    <div class="prescription-list" id="prescriptionList">
                        @forelse($prescriptions as $prescription)
                        <div 
                            class="prescription-card" 
                            onclick="selectPrescription(this, {{ $prescription->id }})"
                            data-prescription-id="{{ $prescription->id }}"
                        >
                            <div class="prescription-card-title">
                                {{ $prescription->title }}
                            </div>
                            <div class="prescription-card-meta">
                                @if($prescription->doctor_name)
                                <span><i class='bx bx-user'></i> {{ $prescription->doctor_name }}</span>
                                @endif
                                <span><i class='bx bx-calendar'></i> {{ $prescription->prescription_date->format('M d, Y') }}</span>
                            </div>
                            @if($prescription->tags->count() > 0)
                            <div class="prescription-card-tags">
                                @foreach($prescription->tags as $tag)
                                <span 
                                    class="prescription-card-tag" 
                                    style="background-color: {{ $tag->color }}"
                                >
                                    {{ $tag->name }}
                                </span>
                                @endforeach
                            </div>
                            @endif
                        </div>
                        @empty
                        <div class="empty-state">
                            <div class="empty-state-icon">📋</div>
                            <div class="empty-state-title">No prescriptions yet</div>
                            <p>Start by adding your first prescription</p>
                        </div>
                        @endforelse
                    </div>

                    <!-- Prescription Detail View -->
                    <div id="prescriptionDetail" class="prescription-detail">
                        <button class="btn-back" onclick="backToPrescriptionList()">
                            <i class='bx bx-chevron-left'></i> Back
                        </button>
                        <div id="detailContent"></div>
                    </div>
                </main>
            </div>
        </div>
    </div>

    <!-- Add/Edit Modal -->
    <div id="prescriptionModal" style="display: none;" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white dark:bg-gray-800 rounded-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="sticky top-0 bg-white dark:bg-gray-800 border-b dark:border-gray-700 p-6 flex justify-between items-center">
                <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100">Add New Prescription</h2>
                <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">
                    <i class='bx bx-x' style="font-size: 1.5rem;"></i>
                </button>
            </div>

            <form id="prescriptionForm" class="p-6 space-y-4">
                @csrf

                <!-- Title -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Prescription Title <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title" required class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none" placeholder="e.g., Eye Checkup Prescription">
                </div>

                <!-- Date -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Prescription Date <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="prescription_date" required class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Next Visit Date
                        </label>
                        <input type="date" name="next_visit_date" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                </div>

                <!-- Doctor -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Doctor / Hospital Name
                    </label>
                    <input type="text" name="doctor_name" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none" placeholder="e.g., Dr. Smith / Eye Hospital">
                </div>

                <!-- Tags -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Tags
                    </label>
                    <div id="tagsContainer" class="flex flex-wrap gap-2">
                        @foreach($tags as $tag)
                        <label class="flex items-center gap-2 px-3 py-1 bg-gray-100 dark:bg-gray-700 rounded-lg cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-600">
                            <input type="checkbox" name="tags" value="{{ $tag->id }}" class="w-4 h-4">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $tag->name }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <!-- Notes -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Notes / Instructions
                    </label>
                    <textarea name="notes" rows="3" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none resize-none" placeholder="Add any notes or instructions..."></textarea>
                </div>

                <!-- File Upload -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Upload Files
                    </label>
                    <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-6 text-center cursor-pointer hover:border-blue-500" onclick="document.getElementById('fileInput').click()">
                        <i class='bx bx-cloud-upload' style="font-size: 2rem; color: #9ca3af;"></i>
                        <p class="text-gray-600 dark:text-gray-400 mt-2">Click to upload or drag and drop</p>
                        <p class="text-xs text-gray-500 dark:text-gray-500">JPG, PNG, PDF up to 10MB</p>
                    </div>
                    <input type="file" id="fileInput" name="files" multiple accept=".jpg,.jpeg,.png,.pdf" style="display: none;" onchange="updateFileList()">
                    <div id="fileList" class="mt-2 space-y-1"></div>
                </div>

                <!-- Reminder -->
                <div>
                    <label class="flex items-center gap-2 text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        <input type="checkbox" id="reminderToggle" onchange="toggleReminder()">
                        Set a reminder for next visit
                    </label>
                    <div id="reminderSection" style="display: none;" class="space-y-2">
                        <input type="datetime-local" name="reminder_date" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                        <input type="text" name="reminder_note" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Reminder note (optional)">
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex gap-3 pt-4 border-t dark:border-gray-700">
                    <button type="button" onclick="closeModal()" class="flex-1 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 font-medium transition">
                        Cancel
                    </button>
                    <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition">
                        Save Prescription
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openAddModal() {
            document.getElementById('prescriptionModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('prescriptionModal').style.display = 'none';
            document.getElementById('prescriptionForm').reset();
            document.getElementById('fileList').innerHTML = '';
            document.getElementById('reminderSection').style.display = 'none';
        }

        function toggleReminder() {
            const toggle = document.getElementById('reminderToggle').checked;
            document.getElementById('reminderSection').style.display = toggle ? 'block' : 'none';
        }

        function updateFileList() {
            const fileInput = document.getElementById('fileInput');
            const fileList = document.getElementById('fileList');
            fileList.innerHTML = '';

            Array.from(fileInput.files).forEach(file => {
                const fileItem = document.createElement('div');
                fileItem.className = 'flex items-center gap-2 px-3 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg text-sm';
                fileItem.innerHTML = `
                    <i class='bx bx-file'></i>
                    <span class="text-gray-700 dark:text-gray-300">${file.name}</span>
                    <span class="text-xs text-gray-500 dark:text-gray-400">(${(file.size / 1024).toFixed(2)} KB)</span>
                `;
                fileList.appendChild(fileItem);
            });
        }

        document.getElementById('prescriptionForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const formData = new FormData(e.target);
            
            try {
                const response = await fetch('{{ route("prescription.store") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: formData
                });

                const data = await response.json();

                if (data.success) {
                    showToast('Prescription saved successfully!', 'success');
                    closeModal();
                    location.reload();
                } else {
                    showToast(data.message || 'Error saving prescription', 'error');
                }
            } catch (error) {
                console.error(error);
                showToast('Error saving prescription', 'error');
            }
        });

        function selectPrescription(el, id) {
            // Remove active class from all cards
            document.querySelectorAll('.prescription-card').forEach(card => {
                card.classList.remove('active');
            });
            el.classList.add('active');

            // Hide main list and show detail
            document.getElementById('prescriptionList').style.display = 'none';
            document.getElementById('prescriptionDetail').classList.add('active');

            // Load prescription details
            loadPrescriptionDetail(id);
        }

        function backToPrescriptionList() {
            document.getElementById('prescriptionList').style.display = 'flex';
            document.getElementById('prescriptionDetail').classList.remove('active');
            document.querySelectorAll('.prescription-card').forEach(card => {
                card.classList.remove('active');
            });
        }

        async function loadPrescriptionDetail(id) {
            try {
                const response = await fetch(`/prescriptions/${id}`);
                const data = await response.json();

                if (data.success) {
                    const prescription = data.prescription;
                    const html = `
                        <div class="prescription-detail-header">
                            <div>
                                <h2 class="prescription-detail-title">${prescription.title}</h2>
                                <p class="text-gray-600 dark:text-gray-400 text-sm mt-1">
                                    ${new Date(prescription.prescription_date).toLocaleDateString('en-US', {year: 'numeric', month: 'long', day: 'numeric'})}
                                </p>
                            </div>
                            <div class="btn-group">
                                <button class="btn-small btn-primary-small" onclick="editPrescription(${id})">
                                    <i class='bx bx-edit'></i> Edit
                                </button>
                                <button class="btn-small btn-danger-small" onclick="deletePrescription(${id})">
                                    <i class='bx bx-trash'></i> Delete
                                </button>
                            </div>
                        </div>

                        ${prescription.next_visit_date && new Date(prescription.next_visit_date) > new Date() ? `
                            <div class="upcoming-reminder">
                                <div class="reminder-text">
                                    <i class='bx bx-calendar'></i> Next visit: ${new Date(prescription.next_visit_date).toLocaleDateString()}
                                </div>
                            </div>
                        ` : ''}

                        <div class="detail-section">
                            <div class="detail-label">Doctor / Hospital</div>
                            <div class="detail-value">${prescription.doctor_name || 'Not specified'}</div>
                        </div>

                        ${prescription.tags.length > 0 ? `
                            <div class="detail-section">
                                <div class="detail-label">Tags</div>
                                <div class="flex flex-wrap gap-2">
                                    ${prescription.tags.map(tag => `
                                        <span class="prescription-card-tag" style="background-color: ${tag.color}">
                                            ${tag.name}
                                        </span>
                                    `).join('')}
                                </div>
                            </div>
                        ` : ''}

                        ${prescription.notes ? `
                            <div class="detail-section">
                                <div class="detail-label">Notes</div>
                                <div class="detail-value">${prescription.notes}</div>
                            </div>
                        ` : ''}

                        ${prescription.files.length > 0 ? `
                            <div class="detail-section">
                                <div class="detail-label">Attached Files</div>
                                <div class="file-preview">
                                    ${prescription.files.map(file => `
                                        <a href="${file.file_url}" target="_blank" class="file-item">
                                            <span class="file-icon">
                                                ${file.file_type === 'pdf' ? '📄' : '🖼️'}
                                            </span>
                                            <span>${file.original_name}</span>
                                        </a>
                                    `).join('')}
                                </div>
                            </div>
                        ` : ''}
                    `;

                    document.getElementById('detailContent').innerHTML = html;
                }
            } catch (error) {
                console.error(error);
                showToast('Error loading prescription details', 'error');
            }
        }

        async function deletePrescription(id) {
            if (!confirm('Are you sure you want to delete this prescription?')) return;

            try {
                const response = await fetch(`/prescriptions/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    }
                });

                const data = await response.json();

                if (data.success) {
                    showToast('Prescription deleted successfully!', 'success');
                    location.reload();
                } else {
                    showToast(data.message || 'Error deleting prescription', 'error');
                }
            } catch (error) {
                console.error(error);
                showToast('Error deleting prescription', 'error');
            }
        }

        function filterPrescriptions() {
            const search = document.getElementById('searchInput').value.toLowerCase();
            const cards = document.querySelectorAll('.prescription-card');

            cards.forEach(card => {
                const title = card.querySelector('.prescription-card-title').textContent.toLowerCase();
                const meta = card.querySelector('.prescription-card-meta').textContent.toLowerCase();
                const visible = title.includes(search) || meta.includes(search);
                card.style.display = visible ? '' : 'none';
            });
        }

        function filterByTag(tagId, button) {
            button.classList.toggle('active');
        }

        function sortPrescriptions(sortBy) {
            // Implement sorting logic
            console.log('Sort by:', sortBy);
        }

        function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            toast.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: ${type === 'success' ? '#10b981' : '#ef4444'};
                color: white;
                padding: 16px 24px;
                border-radius: 8px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                z-index: 9999;
                display: flex;
                align-items: center;
                gap: 12px;
                font-size: 14px;
                animation: slideIn 0.3s ease-out;
            `;
            toast.innerHTML = `
                <i class='bx ${type === 'success' ? 'bx-check-circle' : 'bx-error-circle'}' style="font-size: 20px;"></i>
                <span>${message}</span>
            `;
            document.body.appendChild(toast);
            setTimeout(() => {
                toast.style.animation = 'slideOut 0.3s ease-out';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // Keyboard shortcut for modal
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
                backToPrescriptionList();
            }
        });
    </script>
</x-app-layout>
