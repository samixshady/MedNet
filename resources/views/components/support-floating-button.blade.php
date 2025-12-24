@once
<style>
    /* Floating Support Button */
    .support-button {
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        width: 64px;
        height: 64px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 4px 20px rgba(102, 126, 234, 0.35);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        z-index: 9999;
        border: none;
        font-size: 1.75rem;
        outline: none;
    }

    .support-button:hover {
        transform: scale(1.12) translateY(-4px);
        box-shadow: 0 8px 35px rgba(102, 126, 234, 0.5);
    }

    .support-button:active {
        transform: scale(0.95);
    }

    /* Pulse Animation */
    @keyframes pulse-ring {
        0% {
            box-shadow: 0 0 0 0 rgba(102, 126, 234, 0.7);
        }
        70% {
            box-shadow: 0 0 0 15px rgba(102, 126, 234, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(102, 126, 234, 0);
        }
    }

    .support-button::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        border-radius: 50%;
        animation: pulse-ring 2s infinite;
    }

    /* Support Popup Backdrop */
    .support-backdrop {
        position: fixed;
        inset: 0;
        background-color: rgba(0, 0, 0, 0);
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        z-index: 9997;
    }

    .support-backdrop.open {
        background-color: rgba(0, 0, 0, 0.5);
        opacity: 1;
        visibility: visible;
    }

    /* Support Popup Container */
    .support-popup {
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        width: 420px;
        max-height: 85vh;
        background: white;
        border-radius: 24px;
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.2);
        transform: scale(0) translate(30px, 30px);
        transform-origin: bottom right;
        opacity: 0;
        visibility: hidden;
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        z-index: 9998;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    .support-popup.open {
        transform: scale(1) translate(0, 0);
        opacity: 1;
        visibility: visible;
    }

    /* Popup Header */
    .support-popup-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 1.75rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        position: relative;
    }

    .support-popup-header svg {
        width: 28px;
        height: 28px;
        flex-shrink: 0;
        animation: bounce 0.6s ease-in-out infinite;
    }

    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-4px); }
    }

    .support-popup-header-text h3 {
        margin: 0;
        font-size: 1.35rem;
        font-weight: 700;
        letter-spacing: -0.5px;
    }

    .support-popup-header-text p {
        margin: 0.35rem 0 0 0;
        font-size: 0.85rem;
        opacity: 0.95;
        font-weight: 500;
    }

    /* Popup Body */
    .support-popup-body {
        flex: 1;
        overflow-y: auto;
        padding: 1.75rem;
        background: #fafbfc;
    }

    .support-popup-body::-webkit-scrollbar {
        width: 6px;
    }

    .support-popup-body::-webkit-scrollbar-track {
        background: transparent;
    }

    .support-popup-body::-webkit-scrollbar-thumb {
        background: #d1d5db;
        border-radius: 3px;
    }

    /* Form Styling */
    .support-form-group {
        margin-bottom: 1.35rem;
    }

    .support-form-label {
        display: block;
        font-size: 0.85rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 0.6rem;
        letter-spacing: 0.3px;
    }

    .support-form-input,
    .support-form-textarea {
        width: 100%;
        padding: 0.85rem;
        border: 1.5px solid #e5e7eb;
        border-radius: 10px;
        font-size: 0.875rem;
        font-family: inherit;
        transition: all 0.25s ease;
        box-sizing: border-box;
        background: white;
    }

    .support-form-input:focus,
    .support-form-textarea:focus {
        outline: none;
        border-color: #667eea;
        background: white;
        box-shadow: 0 0 0 3.5px rgba(102, 126, 234, 0.12);
        transform: translateY(-1px);
    }

    .support-form-textarea {
        resize: vertical;
        min-height: 110px;
    }

    /* Error Messages */
    .support-error {
        color: #dc2626;
        font-size: 0.75rem;
        margin-top: 0.45rem;
        display: none;
        font-weight: 600;
    }

    .support-error.show {
        display: block;
        animation: shake 0.4s ease;
    }

    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }

    /* Success Message */
    .support-success {
        background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
        border: 1.5px solid #6ee7b7;
        color: #065f46;
        padding: 1rem;
        border-radius: 10px;
        font-size: 0.875rem;
        margin-bottom: 1.25rem;
        display: none;
        font-weight: 600;
    }

    .support-success.show {
        display: block;
        animation: slideInDown 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translateY(-15px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Loading State */
    .support-loading {
        display: none;
    }

    .support-loading.show {
        display: inline-block;
        width: 16px;
        height: 16px;
        border: 2.5px solid rgba(255, 255, 255, 0.3);
        border-top-color: white;
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    /* Close Button */
    .support-close-btn {
        position: absolute;
        top: 1.25rem;
        right: 1.25rem;
        background: rgba(255, 255, 255, 0.2);
        border: none;
        color: white;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.25s ease;
        font-size: 1.5rem;
        font-weight: 300;
    }

    .support-close-btn:hover {
        background: rgba(255, 255, 255, 0.35);
        transform: rotate(90deg);
    }

    /* Submit Button */
    .support-submit-btn {
        width: 100%;
        padding: 0.9rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 10px;
        font-weight: 700;
        font-size: 0.875rem;
        cursor: pointer;
        transition: all 0.25s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.6rem;
        margin-top: 1.25rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .support-submit-btn:hover:not(:disabled) {
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.5);
        transform: translateY(-2px);
    }

    .support-submit-btn:disabled {
        opacity: 0.65;
        cursor: not-allowed;
    }

    /* Mobile Responsive */
    @media (max-width: 640px) {
        .support-button {
            bottom: 1.5rem;
            right: 1.5rem;
            width: 60px;
            height: 60px;
            font-size: 1.5rem;
        }

        .support-popup {
            bottom: 1.5rem;
            right: 1.5rem;
            width: calc(100vw - 2rem);
            max-width: 420px;
            max-height: 75vh;
            border-radius: 20px;
        }

        .support-popup-body {
            padding: 1.5rem;
        }

        .support-popup-header {
            padding: 1.5rem;
        }
    }

    /* Extra Small Screens */
    @media (max-width: 380px) {
        .support-button {
            bottom: 1rem;
            right: 1rem;
        }

        .support-popup {
            bottom: 1rem;
            right: 1rem;
            width: calc(100vw - 1rem);
            border-radius: 16px;
        }

        .support-popup-header {
            padding: 1.25rem;
        }

        .support-popup-body {
            padding: 1.25rem;
        }
    }
</style>

<!-- Support Floating Button -->
<button id="supportButton" class="support-button" title="Need help? Click here!" aria-label="Support Chat">
    💬
</button>

<!-- Support Popup Backdrop -->
<div id="supportBackdrop" class="support-backdrop"></div>

<!-- Support Popup Modal -->
<div id="supportPopup" class="support-popup">
    <!-- Close Button -->
    <button type="button" id="supportClose" class="support-close-btn" aria-label="Close support form">
        ✕
    </button>

    <div class="support-popup-header">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 2C6.48 2 2 6.48 2 12c0 1.54.36 3 .97 4.29L2.06 20.5 9.21 17.03C10.3 17.65 11.6 18 13 18c5.52 0 10-4.48 10-10S17.52 2 12 2zm0 18c-1.41 0-2.73-.36-3.88-.98l-.28-.15-2.89.97.97-2.89-.15-.28C4.36 14.73 4 13.41 4 12c0-4.41 3.59-8 8-8s8 3.59 8 8-3.59 8-8 8z"/>
        </svg>
        <div class="support-popup-header-text">
            <h3>Need Help?</h3>
            <p>We're here to assist you</p>
        </div>
    </div>

    <div class="support-popup-body">
        <div id="successMessage" class="support-success"></div>

        <form id="supportForm" method="POST" action="">
            @csrf

            <!-- Name Field -->
            <div class="support-form-group">
                <label for="supportName" class="support-form-label">Your Name <span style="color: #dc2626;">*</span></label>
                <input 
                    type="text" 
                    id="supportName" 
                    name="name" 
                    class="support-form-input" 
                    placeholder="John Doe"
                    maxlength="255"
                    autocomplete="name"
                    required
                >
                <div class="support-error" id="nameError"></div>
            </div>

            <!-- Phone Field -->
            <div class="support-form-group">
                <label for="supportPhone" class="support-form-label">Phone Number <span style="color: #dc2626;">*</span></label>
                <input 
                    type="tel" 
                    id="supportPhone" 
                    name="phone" 
                    class="support-form-input" 
                    placeholder="+1 (555) 000-0000"
                    maxlength="20"
                    autocomplete="tel"
                    required
                >
                <div class="support-error" id="phoneError"></div>
            </div>

            <!-- Message Field -->
            <div class="support-form-group">
                <label for="supportMessage" class="support-form-label">Message <span style="color: #dc2626;">*</span></label>
                <textarea 
                    id="supportMessage" 
                    name="message" 
                    class="support-form-textarea" 
                    placeholder="Tell us what you think or ask a question..."
                    maxlength="5000"
                    required
                ></textarea>
                <div class="support-error" id="messageError"></div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="support-submit-btn" id="supportSubmitBtn">
                <span id="submitText">Send Feedback</span>
                <span id="submitLoading" class="support-loading"></span>
            </button>
        </form>
    </div>
</div>

<script>
    // Ensure this runs only once
    if (!window.supportFeedbackInitialized) {
        window.supportFeedbackInitialized = true;

        document.addEventListener('DOMContentLoaded', function() {
            const supportButton = document.getElementById('supportButton');
            const supportPopup = document.getElementById('supportPopup');
            const supportBackdrop = document.getElementById('supportBackdrop');
            const supportClose = document.getElementById('supportClose');
            const supportForm = document.getElementById('supportForm');
            const supportSubmitBtn = document.getElementById('supportSubmitBtn');
            const successMessage = document.getElementById('successMessage');

            if (!supportButton) return; // Exit if elements not found

            // Open popup with smooth animation
            supportButton.addEventListener('click', function(e) {
                e.preventDefault();
                supportPopup.classList.add('open');
                supportBackdrop.classList.add('open');
                document.body.style.overflow = 'hidden';
                // Focus first input for better UX
                setTimeout(() => {
                    document.getElementById('supportName').focus();
                }, 200);
            });

            // Close popup function
            function closePopup() {
                supportPopup.classList.remove('open');
                supportBackdrop.classList.remove('open');
                document.body.style.overflow = '';
                setTimeout(clearForm, 300);
            }

            // Close button
            supportClose.addEventListener('click', closePopup);

            // Close on backdrop click
            supportBackdrop.addEventListener('click', function(e) {
                if (e.target === supportBackdrop) {
                    closePopup();
                }
            });

            // Close with Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && supportPopup.classList.contains('open')) {
                    closePopup();
                }
            });

            // Clear form
            function clearForm() {
                supportForm.reset();
                clearErrors();
                successMessage.classList.remove('show');
                successMessage.textContent = '';
            }

            // Clear error messages
            function clearErrors() {
                document.querySelectorAll('.support-error').forEach(error => {
                    error.classList.remove('show');
                    error.textContent = '';
                });
            }

            // Form submission
            supportForm.addEventListener('submit', async function(e) {
                e.preventDefault();
                clearErrors();

                const name = document.getElementById('supportName').value.trim();
                const phone = document.getElementById('supportPhone').value.trim();
                const message = document.getElementById('supportMessage').value.trim();

                // Client-side validation
                let hasError = false;

                if (!name) {
                    showError('nameError', 'Name is required');
                    hasError = true;
                } else if (name.length > 255) {
                    showError('nameError', 'Name cannot exceed 255 characters');
                    hasError = true;
                }

                if (!phone) {
                    showError('phoneError', 'Phone number is required');
                    hasError = true;
                } else if (phone.length > 20) {
                    showError('phoneError', 'Phone cannot exceed 20 characters');
                    hasError = true;
                }

                if (!message) {
                    showError('messageError', 'Message is required');
                    hasError = true;
                } else if (message.length > 5000) {
                    showError('messageError', 'Message cannot exceed 5000 characters');
                    hasError = true;
                }

                if (hasError) return;

                // Disable button and show loading
                supportSubmitBtn.disabled = true;
                document.getElementById('submitText').style.display = 'none';
                document.getElementById('submitLoading').classList.add('show');

                try {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                    
                    const response = await fetch('{{ route("support-feedback.store") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify({ name, phone, message }),
                    });

                    const data = await response.json();

                    if (response.ok) {
                        // Show success message
                        successMessage.textContent = data.message;
                        successMessage.classList.add('show');

                        // Clear form
                        supportForm.reset();

                        // Close popup after 3 seconds
                        setTimeout(() => {
                            closePopup();
                        }, 3000);
                    } else {
                        // Handle validation errors
                        if (data.errors) {
                            Object.keys(data.errors).forEach(field => {
                                const errorElement = document.getElementById(field + 'Error');
                                if (errorElement) {
                                    showError(field + 'Error', data.errors[field][0]);
                                }
                            });
                        } else {
                            showError('messageError', data.message || 'An error occurred. Please try again.');
                        }
                    }
                } catch (error) {
                    console.error('Error:', error);
                    showError('messageError', 'Network error. Please try again.');
                } finally {
                    // Re-enable button and hide loading
                    supportSubmitBtn.disabled = false;
                    document.getElementById('submitText').style.display = 'inline';
                    document.getElementById('submitLoading').classList.remove('show');
                }
            });

            // Helper function to show error
            function showError(elementId, message) {
                const errorElement = document.getElementById(elementId);
                if (errorElement) {
                    errorElement.textContent = message;
                    errorElement.classList.add('show');
                    // Scroll to error
                    errorElement.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                }
            }
        });
    }
</script>
@endonce
