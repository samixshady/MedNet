<!-- Interactive Footer Component -->
<footer class="text-white mt-12" style="background-color: #37404f;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <!-- Main Footer Content -->
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-6">
            <!-- Brand -->
            <div class="col-span-2 md:col-span-1">
                <div class="flex items-center gap-2">
                    <div class="w-7 h-7 bg-white rounded-lg flex items-center justify-center">
                        <i class='bx bx-capsule text-blue-600 font-bold'></i>
                    </div>
                    <span class="font-bold text-sm">MedNet</span>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-xs font-bold mb-2 uppercase tracking-wide">Shop</h3>
                <ul class="space-y-1">
                    <li><a href="{{ route('medicine') }}" class="text-xs text-blue-50 hover:text-white hover:underline transition">Medicine</a></li>
                    <li><a href="{{ route('supplements') }}" class="text-xs text-blue-50 hover:text-white hover:underline transition">Supplements</a></li>
                    <li><a href="{{ route('first-aid') }}" class="text-xs text-blue-50 hover:text-white hover:underline transition">First Aid</a></li>
                </ul>
            </div>

            <!-- Support -->
            <div>
                <h3 class="text-xs font-bold mb-2 uppercase tracking-wide">Help</h3>
                <ul class="space-y-1">
                    <li><a href="#" class="text-xs text-blue-50 hover:text-white hover:underline transition">Contact</a></li>
                    <li><a href="#" class="text-xs text-blue-50 hover:text-white hover:underline transition">FAQ</a></li>
                    <li><a href="#" class="text-xs text-blue-50 hover:text-white hover:underline transition">Track Order</a></li>
                </ul>
            </div>

            <!-- Legal -->
            <div>
                <h3 class="text-xs font-bold mb-2 uppercase tracking-wide">Legal</h3>
                <ul class="space-y-1">
                    <li><a href="#" class="text-xs text-blue-50 hover:text-white hover:underline transition">Privacy</a></li>
                    <li><a href="#" class="text-xs text-blue-50 hover:text-white hover:underline transition">Terms</a></li>
                    <li><a href="#" class="text-xs text-blue-50 hover:text-white hover:underline transition">Cookies</a></li>
                </ul>
            </div>

            <!-- Social & Contact -->
            <div>
                <h3 class="text-xs font-bold mb-2 uppercase tracking-wide">Connect</h3>
                <div class="flex gap-2 mb-2">
                    <a href="#" class="w-6 h-6 bg-white/20 hover:bg-white hover:text-blue-600 rounded flex items-center justify-center transition text-xs" title="Facebook">
                        <i class='bx bxl-facebook'></i>
                    </a>
                    <a href="#" class="w-6 h-6 bg-white/20 hover:bg-white hover:text-blue-600 rounded flex items-center justify-center transition text-xs" title="Twitter">
                        <i class='bx bxl-twitter'></i>
                    </a>
                    <a href="#" class="w-6 h-6 bg-white/20 hover:bg-white hover:text-blue-600 rounded flex items-center justify-center transition text-xs" title="Instagram">
                        <i class='bx bxl-instagram'></i>
                    </a>
                </div>
                <a href="tel:+8801700000000" class="text-xs text-blue-50 hover:text-white flex items-center gap-1 transition">
                    <i class='bx bx-phone text-xs'></i>+880-1700
                </a>
            </div>
        </div>

        <!-- Bottom Divider & Info -->
        <div class="border-t border-white/20 pt-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <p class="text-xs text-blue-50">&copy; {{ date('Y') }} MedNet | <a href="#" class="hover:text-white transition">Privacy</a> • <a href="#" class="hover:text-white transition">Terms</a></p>
            <div class="flex gap-2 text-xs text-blue-50">
                <span class="flex items-center gap-1 bg-white/10 px-2 py-1 rounded">
                    <i class='bx bx-lock text-green-300'></i>Secure
                </span>
                <span class="flex items-center gap-1 bg-white/10 px-2 py-1 rounded">
                    <i class='bx bx-check-circle text-green-300'></i>Verified
                </span>
            </div>
        </div>
    </div>
</footer>
