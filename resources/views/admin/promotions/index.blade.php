@extends('layouts.admin')

@section('title', 'Manage Promotions')

@section('extra-css')
<style>
    .promotions-container {
        padding: 40px 20px;
        max-width: 1400px;
        margin: 0 auto;
    }

    .promotions-header {
        margin-bottom: 40px;
    }

    .promotions-header h1 {
        font-size: 32px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 10px;
    }

    .promotions-header p {
        font-size: 14px;
        color: #6B7280;
    }

    .promotions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 24px;
        margin-bottom: 40px;
    }

    .promo-card {
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1), 0 1px 2px rgba(0, 0, 0, 0.06);
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        height: 100%;
        border: 2px solid #E5E7EB;
    }

    .promo-card:hover {
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        border-color: #D1D5DB;
        transform: translateY(-2px);
    }

    .promo-image-container {
        position: relative;
        width: 100%;
        aspect-ratio: 4/3;
        background: #F3F4F6;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .promo-image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .promo-card:hover .promo-image-container img {
        transform: scale(1.05);
    }

    .promo-placeholder {
        background: linear-gradient(135deg, #E5E7EB 0%, #D1D5DB 100%);
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        gap: 12px;
        color: #9CA3AF;
    }

    .promo-placeholder i {
        font-size: 48px;
    }

    .promo-content {
        padding: 20px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .promo-info {
        flex-grow: 1;
    }

    .promo-title {
        font-size: 14px;
        font-weight: 600;
        color: #111827;
        margin-bottom: 4px;
        word-break: break-word;
    }

    .promo-status {
        font-size: 12px;
        color: #6B7280;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 10px;
        background: #DBEAFE;
        color: #1E40AF;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 500;
    }

    .promo-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .btn-delete {
        flex: 1;
        min-width: 140px;
        padding: 10px 16px;
        background: #EF4444;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-delete:hover {
        background: #DC2626;
        box-shadow: 0 4px 6px rgba(239, 68, 68, 0.2);
    }

    .btn-delete:active {
        transform: scale(0.98);
    }

    .btn-upload {
        flex: 1;
        min-width: 140px;
        padding: 10px 16px;
        background: #3B82F6;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-upload:hover {
        background: #2563EB;
        box-shadow: 0 4px 6px rgba(59, 130, 246, 0.2);
    }

    .btn-upload:active {
        transform: scale(0.98);
    }

    .btn-upload:disabled,
    .btn-delete:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }

    .empty-slot {
        opacity: 0.6;
    }

    .empty-slot .promo-placeholder {
        background: linear-gradient(135deg, #F3F4F6 0%, #E5E7EB 100%);
    }

    /* Upload Modal */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .modal.show {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .modal-content {
        background-color: #fff;
        padding: 32px;
        border-radius: 12px;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        max-width: 500px;
        width: 90%;
        animation: slideUp 0.3s ease;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .modal-header {
        margin-bottom: 24px;
    }

    .modal-header h2 {
        font-size: 20px;
        font-weight: 700;
        color: #111827;
        margin: 0;
    }

    .modal-close {
        position: absolute;
        top: 16px;
        right: 16px;
        background: none;
        border: none;
        font-size: 24px;
        color: #6B7280;
        cursor: pointer;
        transition: color 0.3s ease;
        padding: 0;
    }

    .modal-close:hover {
        color: #111827;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #D1D5DB;
        border-radius: 8px;
        font-size: 14px;
        font-family: inherit;
        transition: all 0.3s ease;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #3B82F6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .file-input-wrapper {
        position: relative;
        display: inline-block;
        width: 100%;
    }

    .file-input-label {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 20px;
        border: 2px dashed #D1D5DB;
        border-radius: 8px;
        background: #F9FAFB;
        cursor: pointer;
        transition: all 0.3s ease;
        color: #6B7280;
        font-weight: 500;
        font-size: 14px;
    }

    .file-input-label:hover {
        border-color: #3B82F6;
        background: #EFF6FF;
        color: #3B82F6;
    }

    #imageInput {
        display: none;
    }

    .preview-image {
        margin-top: 16px;
        display: none;
    }

    .preview-image.show {
        display: block;
    }

    .preview-image img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        border: 1px solid #E5E7EB;
    }

    .modal-footer {
        display: flex;
        gap: 12px;
        margin-top: 24px;
    }

    .btn-cancel {
        flex: 1;
        padding: 10px 16px;
        background: #E5E7EB;
        color: #111827;
        border: none;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-cancel:hover {
        background: #D1D5DB;
    }

    .btn-submit {
        flex: 1;
        padding: 10px 16px;
        background: #3B82F6;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-submit:hover {
        background: #2563EB;
    }

    .btn-submit:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }

    /* Alert Messages */
    .alert {
        padding: 12px 16px;
        border-radius: 8px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 14px;
        animation: slideDown 0.3s ease;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .alert-success {
        background: #DCFCE7;
        color: #166534;
        border: 1px solid #BBF7D0;
    }

    .alert-error {
        background: #FEE2E2;
        color: #991B1B;
        border: 1px solid #FECACA;
    }

    .alert-info {
        background: #DBEAFE;
        color: #1E40AF;
        border: 1px solid #BFDBFE;
    }

    .alert i {
        font-size: 18px;
        flex-shrink: 0;
    }

    .loading-spinner {
        display: inline-block;
        width: 16px;
        height: 16px;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        border-top-color: white;
        animation: spin 0.8s linear infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .promotions-container {
            padding: 20px 12px;
        }

        .promotions-grid {
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 16px;
        }

        .promotions-header h1 {
            font-size: 24px;
        }

        .modal-content {
            padding: 24px;
            width: 95%;
        }

        .promo-actions {
            flex-direction: column;
        }

        .btn-delete,
        .btn-upload {
            width: 100%;
        }
    }

    @media (max-width: 480px) {
        .promotions-grid {
            grid-template-columns: 1fr;
        }

        .promotions-header h1 {
            font-size: 20px;
        }

        .promo-content {
            padding: 16px;
        }
    }
</style>
@endsection

@section('content')
<div class="promotions-container">
    <div class="promotions-header">
        <h1><i class='bx bx-images'></i> Manage Promotions</h1>
        <p>Upload and manage up to 6 promotional images for your storefront</p>
    </div>

    <!-- Alert Messages -->
    <div id="alertContainer"></div>

    <!-- Promotions Grid -->
    <div class="promotions-grid">
        @forelse($promotions as $index => $promotion)
            @if($promotion)
                <div class="promo-card" data-promotion-id="{{ $promotion->id }}">
                    <div class="promo-image-container">
                        <img src="{{ asset('storage/' . $promotion->image_path) }}" alt="{{ $promotion->alt_text ?? 'Promotional Image' }}" loading="lazy">
                    </div>
                    <div class="promo-content">
                        <div class="promo-info">
                            <div class="promo-title">{{ $promotion->title ?? 'Promotional Image #' . ($index + 1) }}</div>
                            <div class="promo-status">
                                <span class="status-badge">
                                    <i class='bx bx-check-circle'></i>
                                    Active
                                </span>
                            </div>
                        </div>
                        <div class="promo-actions">
                            <button class="btn-delete" onclick="deletePromotion({{ $promotion->id }})">
                                <i class='bx bx-trash'></i>
                                Delete
                            </button>
                            <button class="btn-upload" onclick="openUploadModal({{ $index }})">
                                <i class='bx bx-upload'></i>
                                Replace
                            </button>
                        </div>
                    </div>
                </div>
            @else
                <div class="promo-card empty-slot">
                    <div class="promo-image-container">
                        <div class="promo-placeholder">
                            <i class='bx bx-image-add'></i>
                            <span>Empty Slot</span>
                        </div>
                    </div>
                    <div class="promo-content">
                        <div class="promo-info">
                            <div class="promo-title">Promotional Image #{{ $index + 1 }}</div>
                            <div class="promo-status">
                                <span class="status-badge">
                                    <i class='bx bx-time'></i>
                                    Waiting
                                </span>
                            </div>
                        </div>
                        <div class="promo-actions">
                            <button class="btn-upload" onclick="openUploadModal({{ $index }})">
                                <i class='bx bx-upload'></i>
                                Upload
                            </button>
                        </div>
                    </div>
                </div>
            @endif
        @empty
            @for($i = 1; $i <= 6; $i++)
                <div class="promo-card empty-slot">
                    <div class="promo-image-container">
                        <div class="promo-placeholder">
                            <i class='bx bx-image-add'></i>
                            <span>Empty Slot</span>
                        </div>
                    </div>
                    <div class="promo-content">
                        <div class="promo-info">
                            <div class="promo-title">Promotional Image #{{ $i }}</div>
                            <div class="promo-status">
                                <span class="status-badge">
                                    <i class='bx bx-time'></i>
                                    Waiting
                                </span>
                            </div>
                        </div>
                        <div class="promo-actions">
                            <button class="btn-upload" onclick="openUploadModal({{ $i - 1 }})">
                                <i class='bx bx-upload'></i>
                                Upload
                            </button>
                        </div>
                    </div>
                </div>
            @endfor
        @endforelse
    </div>
</div>

<!-- Upload Modal -->
<div id="uploadModal" class="modal">
    <div class="modal-content">
        <button class="modal-close" onclick="closeUploadModal()">
            <i class='bx bx-x'></i>
        </button>
        <div class="modal-header">
            <h2>Upload Promotional Image</h2>
        </div>

        <form id="uploadForm">
            @csrf
            <div class="form-group">
                <label for="imageInput">Select Image *</label>
                <div class="file-input-wrapper">
                    <label class="file-input-label" for="imageInput">
                        <i class='bx bx-cloud-upload'></i>
                        Click to upload or drag and drop
                    </label>
                    <input type="file" id="imageInput" name="image" accept="image/*" required>
                </div>
                <div class="preview-image" id="previewContainer">
                    <img id="previewImage" src="" alt="Preview">
                </div>
            </div>

            <div class="form-group">
                <label for="titleInput">Title (Optional)</label>
                <input type="text" id="titleInput" name="title" placeholder="e.g., Summer Sale">
            </div>

            <div class="form-group">
                <label for="altTextInput">Alt Text (Optional)</label>
                <input type="text" id="altTextInput" name="alt_text" placeholder="Image description for accessibility">
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeUploadModal()">Cancel</button>
                <button type="submit" class="btn-submit">
                    <i class='bx bx-check'></i>
                    Upload Image
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('extra-scripts')
<script>
    let currentSlotIndex = null;

    // File input drag and drop
    const fileInput = document.getElementById('imageInput');
    const fileInputLabel = document.querySelector('.file-input-label');

    fileInputLabel.addEventListener('dragover', (e) => {
        e.preventDefault();
        fileInputLabel.style.borderColor = '#3B82F6';
        fileInputLabel.style.background = '#EFF6FF';
    });

    fileInputLabel.addEventListener('dragleave', () => {
        fileInputLabel.style.borderColor = '#D1D5DB';
        fileInputLabel.style.background = '#F9FAFB';
    });

    fileInputLabel.addEventListener('drop', (e) => {
        e.preventDefault();
        fileInputLabel.style.borderColor = '#D1D5DB';
        fileInputLabel.style.background = '#F9FAFB';
        
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            fileInput.files = files;
            previewImage();
        }
    });

    // File input change event
    fileInput.addEventListener('change', previewImage);

    function previewImage() {
        const file = fileInput.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                const previewContainer = document.getElementById('previewContainer');
                const previewImage = document.getElementById('previewImage');
                previewImage.src = e.target.result;
                previewContainer.classList.add('show');
            };
            reader.readAsDataURL(file);
        }
    }

    function openUploadModal(slotIndex) {
        currentSlotIndex = slotIndex;
        const modal = document.getElementById('uploadModal');
        modal.classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    function closeUploadModal() {
        const modal = document.getElementById('uploadModal');
        const form = document.getElementById('uploadForm');
        const previewContainer = document.getElementById('previewContainer');
        
        modal.classList.remove('show');
        document.body.style.overflow = 'auto';
        form.reset();
        previewContainer.classList.remove('show');
        currentSlotIndex = null;
    }

    // Close modal on outside click
    document.getElementById('uploadModal').addEventListener('click', (e) => {
        if (e.target === document.getElementById('uploadModal')) {
            closeUploadModal();
        }
    });

    // Form submission
    document.getElementById('uploadForm').addEventListener('submit', async (e) => {
        e.preventDefault();

        const formData = new FormData();
        formData.append('image', fileInput.files[0]);
        formData.append('title', document.getElementById('titleInput').value);
        formData.append('alt_text', document.getElementById('altTextInput').value);

        const submitBtn = e.target.querySelector('.btn-submit');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="loading-spinner"></span> Uploading...';

        try {
            const response = await fetch('{{ route("admin.promotions.store") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                }
            });

            const data = await response.json();

            if (data.success) {
                showAlert('Image uploaded successfully!', 'success');
                closeUploadModal();
                setTimeout(() => location.reload(), 1500);
            } else {
                showAlert(data.message || 'Failed to upload image', 'error');
            }
        } catch (error) {
            showAlert('An error occurred: ' + error.message, 'error');
            console.error('Upload error:', error);
        } finally {
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="bx bx-check"></i> Upload Image';
        }
    });

    function deletePromotion(promotionId) {
        if (confirm('Are you sure you want to delete this promotional image?')) {
            const deleteBtn = document.querySelector(`[data-promotion-id="${promotionId}"] .btn-delete`);
            deleteBtn.disabled = true;
            deleteBtn.innerHTML = '<span class="loading-spinner"></span> Deleting...';

            fetch(`{{ route('admin.promotions.destroy', '') }}/${promotionId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showAlert('Image deleted successfully!', 'success');
                    setTimeout(() => location.reload(), 1500);
                } else {
                    showAlert(data.message || 'Failed to delete image', 'error');
                    deleteBtn.disabled = false;
                    deleteBtn.innerHTML = '<i class="bx bx-trash"></i> Delete';
                }
            })
            .catch(error => {
                showAlert('An error occurred: ' + error.message, 'error');
                deleteBtn.disabled = false;
                deleteBtn.innerHTML = '<i class="bx bx-trash"></i> Delete';
            });
        }
    }

    function showAlert(message, type) {
        const alertContainer = document.getElementById('alertContainer');
        const alertId = 'alert-' + Date.now();
        
        let icon = 'bx-check-circle';
        if (type === 'error') icon = 'bx-x-circle';
        if (type === 'info') icon = 'bx-info-circle';

        const alertHTML = `
            <div class="alert alert-${type}" id="${alertId}">
                <i class='bx ${icon}'></i>
                <span>${message}</span>
            </div>
        `;

        alertContainer.insertAdjacentHTML('beforeend', alertHTML);

        setTimeout(() => {
            const alert = document.getElementById(alertId);
            if (alert) {
                alert.style.animation = 'slideDown 0.3s ease reverse';
                setTimeout(() => alert.remove(), 300);
            }
        }, 4000);
    }
</script>
@endsection
