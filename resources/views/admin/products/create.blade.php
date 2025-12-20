<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product - MedNet</title>
    <link rel="stylesheet" href="{{ asset('css/adminsidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/addproduct.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="sidebar">
        <div class="logo-details">
            <div class="logo_name">MedNet</div>
            <i class='bx bx-menu' id="btn"></i>
        </div>
        <ul class="nav-list">
            <li>
                <i class='bx bx-search'></i>
                <input type="text" placeholder="Search...">
                <span class="tooltip">Search</span>
            </li>
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class='bx bx-grid-alt'></i>
                    <span class="links_name">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>
            <li>
                <a href="{{ route('admin.products.create') }}" style="background: #fff;">
                    <i class='bx bx-plus-circle'></i>
                    <span class="links_name">Add Product</span>
                </a>
                <span class="tooltip">Add Product</span>
            </li>
            <li>
                <a href="{{ route('admin.products.index') }}">
                    <i class='bx bx-list-ul'></i>
                    <span class="links_name">Products</span>
                </a>
                <span class="tooltip">Products</span>
            </li>
            <li>
                <a href="">
                    <i class='bx bx-user'></i>
                    <span class="links_name">Users</span>
                </a>
                <span class="tooltip">Users</span>
            </li>
            <li>
                <a href="">
                    <i class='bx bx-cog'></i>
                    <span class="links_name">Settings</span>
                </a>
                <span class="tooltip">Settings</span>
            </li>
            <li class="profile">
                <div class="profile-details">
                    <img src="{{ asset('favicon.ico') }}" alt="profileImg">
                    <div class="name_job">
                        <div class="name">{{ Auth::user()->name }}</div>
                        <div class="job">Administrator</div>
                    </div>
                </div>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class='bx bx-log-out' id="log_out"></i>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>

    <section class="home-section">
        <div class="product-container">
            <div class="product-header">
                <h1>Add New Medicine Product</h1>
                <p>Fill in all required fields to add a new product to your inventory</p>
            </div>

            <form id="productForm" class="product-form" enctype="multipart/form-data">
                @csrf

                <div class="form-row">
                    <div class="form-group full-width">
                        <label>Product Image <span class="required">*</span></label>
                        <div class="image-upload-area" id="imageUploadArea">
                            <div class="upload-icon">
                                <i class='bx bx-cloud-upload'></i>
                            </div>
                            <div class="upload-text">
                                <p>Drag and drop your image here or click to select</p>
                                <small>Supported formats: JPEG, PNG, JPG, GIF (Max 2MB)</small>
                            </div>
                            <input type="file" id="imageInput" name="image" accept="image/*" style="display: none;">
                        </div>
                        <div id="imagePreview" class="image-preview" style="display: none;">
                            <img id="previewImage" src="" alt="Preview">
                            <button type="button" class="remove-image" onclick="removeImage()">×</button>
                        </div>
                        <span class="error-message" id="image_error"></span>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Product Name <span class="required">*</span></label>
                        <input type="text" name="name" placeholder="e.g., Aspirin 500mg" required>
                        <span class="error-message" id="name_error"></span>
                    </div>
                    <div class="form-group">
                        <label>Manufacturer/Brand <span class="required">*</span></label>
                        <input type="text" name="manufacturer" placeholder="e.g., Bayer" required>
                        <span class="error-message" id="manufacturer_error"></span>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group full-width">
                        <label>Description <span class="required">*</span></label>
                        <textarea name="description" placeholder="Enter detailed product description..." rows="4" required></textarea>
                        <span class="error-message" id="description_error"></span>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Price (Taka) <span class="required">*</span></label>
                        <input type="number" name="price" placeholder="0.00" step="0.01" min="0" required>
                        <span class="error-message" id="price_error"></span>
                    </div>
                    <div class="form-group">
                        <label>Quantity <span class="required">*</span></label>
                        <input type="number" name="quantity" placeholder="0" min="0" required>
                        <span class="error-message" id="quantity_error"></span>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Dosage <span class="required">*</span></label>
                        <input type="text" name="dosage" placeholder="e.g., 500mg tablet" required>
                        <span class="error-message" id="dosage_error"></span>
                    </div>
                    <div class="form-group">
                        <label>Expiry Date <span class="required">*</span></label>
                        <input type="date" name="expiry_date" required>
                        <span class="error-message" id="expiry_date_error"></span>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Product Tag <span class="required">*</span></label>
                        <select name="tag" required>
                            <option value="">Select a category</option>
                            <option value="medicine">Medicine</option>
                            <option value="supplement">Supplement</option>
                            <option value="first_aid">First Aid</option>
                        </select>
                        <span class="error-message" id="tag_error"></span>
                    </div>
                    <div class="form-group">
                        <label>Low Stock Threshold <span class="required">*</span></label>
                        <input type="number" name="low_stock_threshold" placeholder="10" min="0" value="10" required>
                        <span class="error-message" id="low_stock_threshold_error"></span>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Prescription Required <span class="required">*</span></label>
                        <div class="radio-group">
                            <label class="radio-label">
                                <input type="radio" name="prescription_required" value="1" required> Yes
                            </label>
                            <label class="radio-label">
                                <input type="radio" name="prescription_required" value="0" required checked> No
                            </label>
                        </div>
                        <span class="error-message" id="prescription_required_error"></span>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group full-width">
                        <label>Side Effects (Optional)</label>
                        <textarea name="side_effects" placeholder="List any known side effects..." rows="3"></textarea>
                        <span class="error-message" id="side_effects_error"></span>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        <i class='bx bx-plus'></i> Add Product
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                        <i class='bx bx-arrow-back'></i> Cancel
                    </a>
                </div>
            </form>
        </div>

        <!-- Success Modal -->
        <div id="successModal" class="modal">
            <div class="modal-content success-modal">
                <div class="modal-icon">
                    <i class='bx bx-check-circle'></i>
                </div>
                <h2>Success!</h2>
                <p id="successMessage">Product has been added successfully!</p>
                <button type="button" class="btn btn-primary" onclick="redirectToProducts()">View Products</button>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sidebar functionality
            let sidebar = document.querySelector(".sidebar");
            let closeBtn = document.querySelector("#btn");
            let searchBtn = document.querySelector(".bx-search");

            if (closeBtn) {
                closeBtn.addEventListener("click", () => {
                    sidebar.classList.toggle("open");
                    menuBtnChange();
                });
            }

            if (searchBtn) {
                searchBtn.addEventListener("click", () => {
                    sidebar.classList.toggle("open");
                    menuBtnChange();
                });
            }

            function menuBtnChange() {
                if (sidebar.classList.contains("open")) {
                    closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");
                } else {
                    closeBtn.classList.replace("bx-menu-alt-right", "bx-menu");
                }
            }

            menuBtnChange();

            // Image upload functionality
            const imageUploadArea = document.getElementById('imageUploadArea');
            const imageInput = document.getElementById('imageInput');
            const imagePreview = document.getElementById('imagePreview');
            const previewImage = document.getElementById('previewImage');

            if (imageUploadArea && imageInput) {
                imageUploadArea.addEventListener('click', () => imageInput.click());

                imageUploadArea.addEventListener('dragover', (e) => {
                    e.preventDefault();
                    imageUploadArea.classList.add('dragover');
                });

                imageUploadArea.addEventListener('dragleave', () => {
                    imageUploadArea.classList.remove('dragover');
                });

                imageUploadArea.addEventListener('drop', (e) => {
                    e.preventDefault();
                    imageUploadArea.classList.remove('dragover');
                    const files = e.dataTransfer.files;
                    if (files.length > 0) {
                        imageInput.files = files;
                        handleImageSelect();
                    }
                });

                imageInput.addEventListener('change', handleImageSelect);
            }

            function handleImageSelect() {
                const file = imageInput.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        previewImage.src = e.target.result;
                        imageUploadArea.style.display = 'none';
                        imagePreview.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                }
            }

            window.removeImage = function() {
                imageInput.value = '';
                imagePreview.style.display = 'none';
                imageUploadArea.style.display = 'block';
            }

            // Form submission
            const productForm = document.getElementById('productForm');
            const submitBtn = document.getElementById('submitBtn');

            if (productForm) {
                productForm.addEventListener('submit', async (e) => {
                    e.preventDefault();
                    console.log('Form submission started');

                    // Clear all errors
                    document.querySelectorAll('.error-message').forEach(el => el.textContent = '');

                    const formData = new FormData(productForm);
                    
                    // Convert prescription_required to boolean
                    const prescriptionValue = formData.get('prescription_required');
                    console.log('Prescription value:', prescriptionValue);
                    
                    if (prescriptionValue !== null && prescriptionValue !== '') {
                        formData.set('prescription_required', prescriptionValue === '1' ? 1 : 0);
                    }
                    
                    if (submitBtn) {
                        submitBtn.disabled = true;
                        submitBtn.innerHTML = '<i class="bx bx-loader-alt bx-spin"></i> Adding Product...';
                    }

                    try {
                        const storeRoute = '{{ route("admin.products.store") }}';
                        console.log('Submitting to:', storeRoute);
                        
                        const response = await fetch(storeRoute, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        });

                        console.log('Response status:', response.status);
                        const data = await response.json();
                        console.log('Response data:', data);

                        if (response.ok) {
                            document.getElementById('successMessage').textContent = data.message;
                            document.getElementById('successModal').classList.add('show');
                            setTimeout(() => {
                                redirectToProducts();
                            }, 2000);
                        } else {
                            console.log('Errors:', data.errors);
                            if (data.errors) {
                                Object.keys(data.errors).forEach(field => {
                                    const errorEl = document.getElementById(`${field}_error`);
                                    if (errorEl) {
                                        errorEl.textContent = data.errors[field][0];
                                    }
                                });
                            } else if (data.message) {
                                alert('Error: ' + data.message);
                            }
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        alert('An error occurred while adding the product: ' + error.message);
                    } finally {
                        if (submitBtn) {
                            submitBtn.disabled = false;
                            submitBtn.innerHTML = '<i class="bx bx-plus"></i> Add Product';
                        }
                    }
                });
            }

            window.redirectToProducts = function() {
                window.location.href = '{{ route("admin.products.index") }}';
            }
        });
    </script>
</body>
</html>
