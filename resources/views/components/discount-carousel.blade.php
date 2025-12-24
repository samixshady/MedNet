@props(['discountedProducts' => []])

<!-- Desktop View (hidden on mobile) -->
<div class="hidden lg:block w-full mt-12" style="transform: translate(-40px, -150px);">
    <div class="max-w-7xl mx-auto px-4">
        <!-- Header - Centered "Features" -->
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-gray-800">✨ Featured Deals</h2>
        </div>

        @if($discountedProducts->count() > 0)
            <!-- Carousel Container -->
            <div class="relative overflow-visible">
                <div class="discount-carousel-wrapper overflow-hidden">
                    <div class="discount-carousel-track" style="display: flex; gap: 16px; transition: transform 0.8s ease-in-out; transform: translateX(0);">
                        @foreach($discountedProducts as $index => $product)
                            <div class="discount-carousel-item" 
                                 data-index="{{ $index }}" 
                                 style="flex: 0 0 calc(20% - 12.8px);">
                                <a href="{{ route('medicine.show', $product->id) }}" class="group block h-full">
                                    <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 overflow-hidden h-full flex flex-col">
                                        <!-- Product Image -->
                                        <div class="relative h-40 bg-gray-100 overflow-hidden group-hover:scale-105 transition-transform duration-300">
                                            @if($product->image_path)
                                                <img src="{{ asset('storage/' . $product->image_path) }}" 
                                                     alt="{{ $product->name }}" 
                                                     class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-200 to-gray-300">
                                                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                            @endif
                                            
                                            <!-- Discount Badge -->
                                            <div class="absolute top-2 right-2 bg-gradient-to-r from-red-500 to-red-600 text-white px-2 py-1 rounded-full font-bold text-xs shadow-lg">
                                                {{ $product->discount }}% OFF
                                            </div>
                                        </div>

                                        <!-- Product Info -->
                                        <div class="p-3 flex-1 flex flex-col">
                                            <h3 class="font-bold text-gray-800 text-xs group-hover:text-indigo-600 transition-colors line-clamp-2">
                                                {{ $product->name }}
                                            </h3>
                                            
                                            <!-- Pricing -->
                                            <div class="mt-2 mb-2">
                                                @if($product->updated_price && $product->updated_price < $product->price)
                                                    <div class="flex items-center gap-1">
                                                        <span class="text-base font-bold text-green-600">৳{{ number_format($product->updated_price, 0) }}</span>
                                                        <span class="text-xs text-gray-400 line-through">৳{{ number_format($product->price, 0) }}</span>
                                                    </div>
                                                @else
                                                    <span class="text-base font-bold text-gray-800">৳{{ number_format($product->price, 0) }}</span>
                                                @endif
                                            </div>

                                            <!-- Stock Status -->
                                            <div class="mt-auto">
                                                @if($product->stock_status === 'normal')
                                                    <span class="inline-block bg-green-100 text-green-700 text-xs font-bold px-2 py-0.5 rounded-full">
                                                        In Stock
                                                    </span>
                                                @elseif($product->stock_status === 'low_stock')
                                                    <span class="inline-block bg-yellow-100 text-yellow-700 text-xs font-bold px-2 py-0.5 rounded-full">
                                                        Low Stock
                                                    </span>
                                                @else
                                                    <span class="inline-block bg-gray-100 text-gray-700 text-xs font-bold px-2 py-0.5 rounded-full">
                                                        Out of Stock
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Navigation Arrows -->
                @if($discountedProducts->count() > 5)
                    <button onclick="previousDiscountCarousel()" 
                            class="absolute left-0 top-1/3 -translate-y-1/2 -translate-x-14 z-20 bg-white hover:bg-indigo-600 hover:text-white text-indigo-600 rounded-full p-2 shadow-lg transition-all duration-200 hover:shadow-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button onclick="nextDiscountCarousel()" 
                            class="absolute right-0 top-1/3 -translate-y-1/2 translate-x-14 z-20 bg-white hover:bg-indigo-600 hover:text-white text-indigo-600 rounded-full p-2 shadow-lg transition-all duration-200 hover:shadow-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                @endif
            </div>

            <!-- Pagination Dots -->
            @if($discountedProducts->count() > 5)
                <div class="flex justify-center gap-2 mt-6">
                    @for($i = 0; $i < ceil($discountedProducts->count() / 5); $i++)
                        <button onclick="goToDiscountCarousel({{ $i * 5 }})" 
                                class="discount-carousel-dot h-2 w-2 rounded-full transition-all duration-300 {{ $i === 0 ? 'bg-indigo-600 w-6' : 'bg-indigo-300 hover:bg-indigo-400' }}"
                                aria-label="Go to slide {{ $i + 1 }}">
                        </button>
                    @endfor
                </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="text-center py-12 bg-white rounded-lg shadow-sm">
                <p class="text-gray-500 font-medium">No featured deals available</p>
                <p class="text-gray-400 text-sm">Check back soon for amazing discounts!</p>
            </div>
        @endif
    </div>
</div>

<!-- Mobile View (shown only on mobile) -->
<div class="lg:hidden w-full mt-0 px-0">
    <div class="text-center mb-4 px-3">
        <h2 class="text-xl font-bold text-gray-800 flex items-center justify-center gap-2">
            <span class="text-2xl">✨</span>
            Featured Deals
        </h2>
    </div>

    @if($discountedProducts->count() > 0)
        <div class="relative">
            <!-- Carousel Wrapper -->
            <div class="overflow-hidden mobile-carousel-wrapper">
                <div class="mobile-carousel-track flex transition-transform duration-700 ease-in-out gap-2" style="transform: translateX(0);">
                    @php
                        $chunks = $discountedProducts->chunk(3);
                    @endphp
                    @foreach($chunks as $chunkIndex => $chunk)
                        <div class="mobile-carousel-slide flex-shrink-0 w-full px-3" data-mobile-index="{{ $chunkIndex }}">
                            <div class="grid grid-cols-3 gap-3">
                                @foreach($chunk as $product)
                                    <a href="{{ route('medicine.show', $product->id) }}" class="group block">
                                        <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden h-full flex flex-col border border-gray-100">
                                            <!-- Product Image -->
                                            <div class="relative h-32 bg-gradient-to-br from-gray-50 to-gray-100 overflow-hidden">
                                                @if($product->image_path)
                                                    <img src="{{ asset('storage/' . $product->image_path) }}" 
                                                         alt="{{ $product->name }}" 
                                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center">
                                                        <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                    </div>
                                                @endif
                                                
                                                <!-- Discount Badge -->
                                                <div class="absolute top-1.5 right-1.5 bg-gradient-to-r from-red-500 to-pink-500 text-white px-2 py-0.5 rounded-full font-bold text-[9px] shadow-lg">
                                                    -{{ $product->discount }}%
                                                </div>

                                                <!-- Stock Status Badge -->
                                                <div class="absolute bottom-1.5 left-1.5">
                                                    @if($product->stock_status === 'normal')
                                                        <span class="inline-block bg-green-500 text-white text-[8px] font-bold px-1.5 py-0.5 rounded-full shadow-sm">
                                                            ✓
                                                        </span>
                                                    @elseif($product->stock_status === 'low_stock')
                                                        <span class="inline-block bg-yellow-500 text-white text-[8px] font-bold px-1.5 py-0.5 rounded-full shadow-sm">
                                                            !
                                                        </span>
                                                    @else
                                                        <span class="inline-block bg-gray-500 text-white text-[8px] font-bold px-1.5 py-0.5 rounded-full shadow-sm">
                                                            ✕
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- Product Info -->
                                            <div class="p-2 flex-1 flex flex-col">
                                                <h3 class="font-semibold text-gray-800 text-[10px] leading-tight line-clamp-2 mb-1.5 group-hover:text-indigo-600 transition-colors">
                                                    {{ $product->name }}
                                                </h3>
                                                
                                                <!-- Pricing -->
                                                <div class="mt-auto">
                                                    @if($product->updated_price && $product->updated_price < $product->price)
                                                        <div class="space-y-0.5">
                                                            <span class="text-sm font-bold text-green-600 block">৳{{ number_format($product->updated_price, 0) }}</span>
                                                            <span class="text-[9px] text-gray-400 line-through block">৳{{ number_format($product->price, 0) }}</span>
                                                        </div>
                                                    @else
                                                        <span class="text-sm font-bold text-gray-800 block">৳{{ number_format($product->price, 0) }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Navigation Dots -->
            @if($chunks->count() > 1)
                <div class="flex justify-center gap-2 mt-4">
                    @foreach($chunks as $index => $chunk)
                        <button onclick="goToMobileSlide({{ $index }})" 
                                class="mobile-carousel-dot h-2 w-2 rounded-full transition-all duration-300 {{ $index === 0 ? 'bg-indigo-600 w-6' : 'bg-indigo-300' }}"
                                aria-label="Go to slide {{ $index + 1 }}">
                        </button>
                    @endforeach
                </div>
            @endif
        </div>
    @else
        <div class="text-center py-12 bg-white rounded-xl shadow-sm border border-gray-100 mx-3">
            <div class="text-4xl mb-3">🎁</div>
            <p class="text-gray-600 font-medium text-sm">No featured deals available</p>
            <p class="text-gray-400 text-xs mt-1">Check back soon!</p>
        </div>
    @endif
</div>

<style>
    .discount-carousel-track {
        display: flex;
        gap: 16px;
        transition: transform 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .discount-carousel-item {
        flex: 0 0 calc(20% - 12.8px);
    }

    .discount-carousel-dot {
        transition: all 0.3s ease;
    }

    @media (max-width: 1280px) {
        .discount-carousel-item {
            flex: 0 0 calc(25% - 12px);
        }
    }

    @media (max-width: 1024px) {
        .discount-carousel-item {
            flex: 0 0 calc(33.333% - 11px);
        }
    }

    @media (max-width: 768px) {
        .discount-carousel-item {
            flex: 0 0 calc(50% - 8px);
        }
    }

    @media (max-width: 480px) {
        .discount-carousel-item {
            flex: 0 0 100%;
        }
    }
</style>

<script>
    let currentDiscountCarouselIndex = 0;
    let discountCarouselAutoInterval = null;
    
    let currentMobileSlideIndex = 0;
    let mobileCarouselAutoInterval = null;

    function updateDiscountCarousel() {
        const track = document.querySelector('.discount-carousel-track');
        const items = document.querySelectorAll('.discount-carousel-item');
        const totalItems = items.length;
        
        if (!track || totalItems === 0) return;

        // Calculate scroll position (each batch is 5 items)
        track.style.transform = `translateX(calc(-${currentDiscountCarouselIndex} * (20% + 3.2px)))`;

        // Update dots
        const dots = document.querySelectorAll('.discount-carousel-dot');
        const currentBatch = Math.floor(currentDiscountCarouselIndex / 5);
        dots.forEach((dot, index) => {
            if (index === currentBatch) {
                dot.classList.remove('w-2', 'bg-indigo-300');
                dot.classList.add('bg-indigo-600', 'w-6');
            } else {
                dot.classList.remove('bg-indigo-600', 'w-6');
                dot.classList.add('w-2', 'bg-indigo-300');
            }
        });
    }

    function nextDiscountCarousel() {
        const items = document.querySelectorAll('.discount-carousel-item');
        const totalItems = items.length;
        if (totalItems <= 5) return;
        
        currentDiscountCarouselIndex = (currentDiscountCarouselIndex + 5) % totalItems;
        updateDiscountCarousel();
        resetDiscountCarouselAutoPlay();
    }

    function previousDiscountCarousel() {
        const items = document.querySelectorAll('.discount-carousel-item');
        const totalItems = items.length;
        if (totalItems <= 5) return;
        
        currentDiscountCarouselIndex = (currentDiscountCarouselIndex - 5 + totalItems) % totalItems;
        updateDiscountCarousel();
        resetDiscountCarouselAutoPlay();
    }

    function goToDiscountCarousel(index) {
        currentDiscountCarouselIndex = index;
        updateDiscountCarousel();
        resetDiscountCarouselAutoPlay();
    }

    function startDiscountCarouselAutoPlay() {
        const items = document.querySelectorAll('.discount-carousel-item');
        if (items.length <= 5) return;

        discountCarouselAutoInterval = setInterval(() => {
            nextDiscountCarousel();
        }, 5000);
    }

    function resetDiscountCarouselAutoPlay() {
        clearInterval(discountCarouselAutoInterval);
        startDiscountCarouselAutoPlay();
    }

    // Mobile Carousel Functions
    function updateMobileCarousel() {
        const track = document.querySelector('.mobile-carousel-track');
        const slides = document.querySelectorAll('.mobile-carousel-slide');
        const totalSlides = slides.length;
        
        if (!track || totalSlides === 0) return;

        // Calculate scroll position
        track.style.transform = `translateX(-${currentMobileSlideIndex * 100}%)`;

        // Update dots
        const dots = document.querySelectorAll('.mobile-carousel-dot');
        dots.forEach((dot, index) => {
            if (index === currentMobileSlideIndex) {
                dot.classList.remove('w-2', 'bg-indigo-300');
                dot.classList.add('bg-indigo-600', 'w-6');
            } else {
                dot.classList.remove('bg-indigo-600', 'w-6');
                dot.classList.add('w-2', 'bg-indigo-300');
            }
        });
    }

    function nextMobileSlide() {
        const slides = document.querySelectorAll('.mobile-carousel-slide');
        const totalSlides = slides.length;
        if (totalSlides === 0) return;
        
        currentMobileSlideIndex = (currentMobileSlideIndex + 1) % totalSlides;
        updateMobileCarousel();
        resetMobileCarouselAutoPlay();
    }

    function goToMobileSlide(index) {
        currentMobileSlideIndex = index;
        updateMobileCarousel();
        resetMobileCarouselAutoPlay();
    }

    function startMobileCarouselAutoPlay() {
        const slides = document.querySelectorAll('.mobile-carousel-slide');
        if (slides.length <= 1) return;

        mobileCarouselAutoInterval = setInterval(() => {
            nextMobileSlide();
        }, 3500); // 3.5 seconds for smoother transitions
    }

    function resetMobileCarouselAutoPlay() {
        clearInterval(mobileCarouselAutoInterval);
        startMobileCarouselAutoPlay();
    }

    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(() => {
            // Desktop carousel
            updateDiscountCarousel();
            startDiscountCarouselAutoPlay();

            const wrapper = document.querySelector('.discount-carousel-wrapper');
            if (wrapper) {
                wrapper.addEventListener('mouseenter', () => {
                    clearInterval(discountCarouselAutoInterval);
                });
                wrapper.addEventListener('mouseleave', () => {
                    startDiscountCarouselAutoPlay();
                });
            }

            // Mobile carousel
            updateMobileCarousel();
            startMobileCarouselAutoPlay();

            const mobileWrapper = document.querySelector('.mobile-carousel-wrapper');
            if (mobileWrapper) {
                // Touch swipe support
                let touchStartX = 0;
                let touchEndX = 0;

                mobileWrapper.addEventListener('touchstart', (e) => {
                    touchStartX = e.changedTouches[0].screenX;
                    clearInterval(mobileCarouselAutoInterval);
                });

                mobileWrapper.addEventListener('touchend', (e) => {
                    touchEndX = e.changedTouches[0].screenX;
                    handleSwipe();
                    startMobileCarouselAutoPlay();
                });

                function handleSwipe() {
                    const swipeThreshold = 50;
                    if (touchStartX - touchEndX > swipeThreshold) {
                        // Swipe left - next slide
                        nextMobileSlide();
                    } else if (touchEndX - touchStartX > swipeThreshold) {
                        // Swipe right - previous slide
                        const slides = document.querySelectorAll('.mobile-carousel-slide');
                        currentMobileSlideIndex = (currentMobileSlideIndex - 1 + slides.length) % slides.length;
                        updateMobileCarousel();
                    }
                }
            }
        }, 100);
    });
</script>
