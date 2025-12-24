@props(['promotions' => []])

@once
    <link rel="stylesheet" href="{{ asset('css/promotional-slider.css') }}">
@endonce

<div class="promotional-slider-container w-full flex flex-col relative z-10" 
     style="width: 100%; height: auto; max-width: 550px; position: relative;"
     data-lg-style="position: absolute; left: 570px; top: -100px; width: 550px; height: 320px;">
    
    <style>
        @media (min-width: 1024px) {
            .promotional-slider-container {
                position: absolute !important;
                left: 570px !important;
                top: -100px !important;
                width: 550px !important;
                height: 320px !important;
            }
        }
    </style>
    
    <div class="bg-white rounded-xl shadow-lg overflow-hidden h-full flex flex-col" style="height: 320px;">
    <!-- Header -->
    <div class="bg-gradient-to-r from-purple-600 to-pink-600 px-3 sm:px-4 py-3 flex justify-between items-center flex-shrink-0">
        <div>
            <h2 class="text-base sm:text-lg font-bold text-white flex items-center gap-2">
                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" />
                </svg>
                Promotions
            </h2>
        </div>
    </div>

    <!-- Slider Container -->
    <div class="flex-1 relative overflow-hidden bg-gray-50">
        @if($promotions && count($promotions) > 0)
            <!-- Slider Track -->
            <div class="promotional-slider-track h-full">
                @foreach($promotions as $index => $promotion)
                    @if($promotion && $promotion->is_active && $promotion->image_path)
                        <div 
                            class="promotional-slide"
                            data-index="{{ $index }}"
                            style="opacity: {{ $index === 0 ? '1' : '0' }}; transition: opacity 0.8s ease-in-out;"
                        >
                            <img 
                                src="{{ asset('storage/' . $promotion->image_path) }}" 
                                alt="{{ $promotion->alt_text ?? 'Promotional Image' }}"
                                class="w-full h-full object-cover"
                                loading="lazy"
                            >
                            @if($promotion->title)
                                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-4">
                                    <h3 class="text-white font-bold text-sm">{{ $promotion->title }}</h3>
                                </div>
                            @endif
                        </div>
                    @endif
                @endforeach
            </div>

            <!-- Slider Controls -->
            <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex gap-2 z-10">
                @php
                    $activePromotions = $promotions->filter(fn($p) => $p && $p->is_active && $p->image_path)->count();
                @endphp
                @for($i = 0; $i < $activePromotions && $i < 6; $i++)
                    <button 
                        class="promotional-dot h-2 w-2 rounded-full transition-all duration-300 {{ $i === 0 ? 'bg-white w-6' : 'bg-white/50 hover:bg-white/75' }}"
                        onclick="goToSlide({{ $i }})"
                        aria-label="Go to slide {{ $i + 1 }}"
                    ></button>
                @endfor
            </div>

            <!-- Navigation Arrows -->
            @if($activePromotions > 1)
                <button 
                    class="absolute left-3 top-1/2 transform -translate-y-1/2 z-10 bg-white/80 hover:bg-white text-purple-600 rounded-full p-2 transition-all duration-300 shadow-lg hover:shadow-xl"
                    onclick="previousSlide()"
                    aria-label="Previous slide"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button 
                    class="absolute right-3 top-1/2 transform -translate-y-1/2 z-10 bg-white/80 hover:bg-white text-purple-600 rounded-full p-2 transition-all duration-300 shadow-lg hover:shadow-xl"
                    onclick="nextSlide()"
                    aria-label="Next slide"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            @endif
        @else
            <!-- Empty State -->
            <div class="h-full flex flex-col items-center justify-center text-center px-4">
                <svg class="w-16 h-16 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <p class="text-gray-500 font-medium mb-2">No Active Promotions</p>
                <p class="text-gray-400 text-sm">Check back later for exciting offers!</p>
            </div>
        @endif
    </div>
    </div>
</div>

<style>
    .promotional-slider-container {
        animation: slideInUp 0.6s ease-out;
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .promotional-slide {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
    }

    .promotional-dot {
        animation: dotPulse 0.3s ease-in-out;
    }

    @keyframes dotPulse {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.2);
        }
        100% {
            transform: scale(1);
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @keyframes fadeOut {
        from {
            opacity: 1;
        }
        to {
            opacity: 0;
        }
    }
</style>

<script>
    let currentSlideIndex = 0;
    let autoSlideInterval = null;

    function getSlides() {
        return document.querySelectorAll('.promotional-slide');
    }

    function getDots() {
        return document.querySelectorAll('.promotional-dot');
    }

    function showSlide(n) {
        const slides = getSlides();
        const dots = getDots();

        if (slides.length === 0) return;

        if (n >= slides.length) currentSlideIndex = 0;
        if (n < 0) currentSlideIndex = slides.length - 1;

        slides.forEach((slide, index) => {
            slide.style.opacity = '0';
            slide.style.transition = 'opacity 0.8s ease-in-out';
        });

        slides[currentSlideIndex].style.opacity = '1';

        dots.forEach((dot, index) => {
            if (index === currentSlideIndex) {
                dot.classList.add('w-6', 'bg-white');
                dot.classList.remove('w-2', 'bg-white/50', 'hover:bg-white/75');
            } else {
                dot.classList.remove('w-6', 'bg-white');
                dot.classList.add('w-2', 'bg-white/50', 'hover:bg-white/75');
            }
        });
    }

    function nextSlide() {
        currentSlideIndex++;
        showSlide(currentSlideIndex);
        resetAutoSlide();
    }

    function previousSlide() {
        currentSlideIndex--;
        showSlide(currentSlideIndex);
        resetAutoSlide();
    }

    function goToSlide(n) {
        currentSlideIndex = n;
        showSlide(currentSlideIndex);
        resetAutoSlide();
    }

    function startAutoSlide() {
        const slides = getSlides();
        if (slides.length <= 1) return;

        autoSlideInterval = setInterval(() => {
            currentSlideIndex++;
            showSlide(currentSlideIndex);
        }, 3000);
    }

    function resetAutoSlide() {
        clearInterval(autoSlideInterval);
        startAutoSlide();
    }

    document.addEventListener('DOMContentLoaded', function() {
        showSlide(0);
        startAutoSlide();
    });

    document.addEventListener('DOMContentLoaded', function() {
        const slider = document.querySelector('.promotional-slider-container');
        if (slider) {
            slider.addEventListener('mouseenter', () => {
                clearInterval(autoSlideInterval);
            });
            slider.addEventListener('mouseleave', () => {
                startAutoSlide();
            });
        }
    });
</script>
