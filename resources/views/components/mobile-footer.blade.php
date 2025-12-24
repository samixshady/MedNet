<footer class="mobile-footer md:hidden">
    <div class="mobile-footer-container">
        <!-- Brand Section -->
        <div class="mobile-footer-brand">
            <div class="mobile-footer-logo">
                <i class='bx bx-plus-medical'></i>
            </div>
            <div class="mobile-footer-brand-text">
                <h3 class="mobile-footer-title">MedNet</h3>
                <p class="mobile-footer-tagline">Your Health Partner</p>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="mobile-footer-links">
            <a href="{{ route('dashboard') }}" class="mobile-footer-link">
                <i class='bx bx-home'></i>
                <span>Home</span>
            </a>
            <a href="{{ route('medicine') }}" class="mobile-footer-link">
                <i class='bx bx-capsule'></i>
                <span>Medicine</span>
            </a>
            <a href="{{ route('supplements') }}" class="mobile-footer-link">
                <i class='bx bx-leaf'></i>
                <span>Supplies</span>
            </a>
            <a href="{{ route('first-aid') }}" class="mobile-footer-link">
                <i class='bx bx-plus-medical'></i>
                <span>First Aid</span>
            </a>
        </div>

        <!-- Divider -->
        <div class="mobile-footer-divider"></div>

        <!-- Info Section -->
        <div class="mobile-footer-info">
            <p class="mobile-footer-text">Online Pharmacy</p>
            <p class="mobile-footer-description">Trusted medicines delivered to your doorstep</p>
        </div>

        <!-- Bottom accent -->
        <div class="mobile-footer-accent"></div>
    </div>
</footer>
