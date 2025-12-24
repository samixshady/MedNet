<!-- Mobile Sidebar (Collapsible) -->
<div id="mobile-sidebar" class="md:hidden fixed top-0 left-0 h-full w-64 bg-white shadow-xl z-50 transform -translate-x-full transition-transform duration-300">
    <div class="flex flex-col h-full">
        <!-- Header -->
        <div class="flex items-center justify-between p-4 border-b border-gray-200" style="background-color: #37404f;">
            <h2 class="font-semibold text-xl text-white">MedNet</h2>
            <button id="mobile-sidebar-close" class="p-2 text-white hover:bg-gray-600 rounded-lg transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- User Info -->
        <div class="p-4 border-b border-gray-200 bg-gray-50">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-semibold">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="flex-1">
                    <p class="font-medium text-gray-900">{{ Auth::user()->name }}</p>
                    <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                </div>
            </div>
        </div>

        <!-- Navigation Links -->
        <nav class="flex-1 overflow-y-auto p-4">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-100 transition {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-600' : 'text-gray-700' }}">
                <i class='bx bx-home text-xl'></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('medicine') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-100 transition {{ request()->routeIs('medicine') ? 'bg-blue-50 text-blue-600' : 'text-gray-700' }}">
                <i class='bx bx-capsule text-xl'></i>
                <span>Medicine</span>
            </a>
            <a href="{{ route('supplements') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-100 transition {{ request()->routeIs('supplements') ? 'bg-blue-50 text-blue-600' : 'text-gray-700' }}">
                <i class='bx bx-leaf text-xl'></i>
                <span>Supplements</span>
            </a>
            <a href="{{ route('first-aid') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-100 transition {{ request()->routeIs('first-aid') ? 'bg-blue-50 text-blue-600' : 'text-gray-700' }}">
                <i class='bx bx-plus-medical text-xl'></i>
                <span>First Aid</span>
            </a>
            <a href="{{ route('cart.index') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-100 transition {{ request()->routeIs('cart.index') ? 'bg-blue-50 text-blue-600' : 'text-gray-700' }}">
                <i class='bx bx-cart text-xl'></i>
                <span>Cart</span>
            </a>
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-100 transition {{ request()->routeIs('profile.edit') ? 'bg-blue-50 text-blue-600' : 'text-gray-700' }}">
                <i class='bx bx-user text-xl'></i>
                <span>Profile</span>
            </a>
        </nav>

        <!-- Logout Button -->
        <div class="p-4 border-t border-gray-200">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 p-3 rounded-lg hover:bg-red-50 text-red-600 transition">
                    <i class='bx bx-log-out text-xl'></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </div>
</div>
