@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* Custom animations and effects */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes shimmer {
            0% { background-position: -200px 0; }
            100% { background-position: calc(200px + 100%) 0; }
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        .animate-pulse-custom {
            animation: pulse 2s infinite;
        }

        .animate-slide-up {
            animation: slideInUp 0.6s ease-out;
        }

        .shimmer {
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
            background-size: 200px 100%;
            animation: shimmer 1.5s infinite;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Enhanced hero carousel - Stable zoom-independent sizing like products */
        .hero-carousel {
            position: relative;
            width: 100%;
            height: 400px;
            border-radius: 1.5rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            overflow: hidden;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            max-width: 100%;
        }

        .hero-slides {
            display: flex;
            transition: transform 0.7s cubic-bezier(0.4, 0, 0.2, 1);
            width: 100%;
            height: 100%;
        }

        .hero-slide {
            width: 100%;
            height: 100%;
            flex-shrink: 0;
            flex-grow: 0;
            flex-basis: 100%;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-slide[style*="background-image"]::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.3) 50%, rgba(0,0,0,0.6) 100%);
            z-index: 1;
        }

        .hero-slide > div {
            position: relative;
            z-index: 2;
        }

        /* Stable content container like products */
        .hero-content-container {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .hero-content-inner {
            text-align: center;
            max-width: 600px;
            padding: 2rem;
            border-radius: 1.5rem;
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .hero-title {
            font-size: 2.5rem !important;
            font-weight: 900 !important;
            line-height: 1.1 !important;
            margin-bottom: 1rem !important;
            letter-spacing: -0.025em !important;
        }

        .hero-subtitle {
            font-size: 1.25rem !important;
            font-weight: 600 !important;
            margin-bottom: 1rem !important;
        }

        .hero-description {
            font-size: 1rem !important;
            line-height: 1.6 !important;
            margin-bottom: 1.5rem !important;
        }

        .hero-button {
            display: inline-flex !important;
            align-items: center !important;
            gap: 0.5rem !important;
            padding: 0.75rem 1.5rem !important;
            font-size: 1rem !important;
            font-weight: 600 !important;
            border-radius: 0.75rem !important;
        }        .hero-nav-btn {
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.2);
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            border-radius: 50%;
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 20;
            cursor: pointer;
        }

        .hero-nav-btn.hero-prev {
            left: 1rem;
        }

        .hero-nav-btn.hero-next {
            right: 1rem;
        }

        .hero-nav-btn:hover {
            background: rgba(255,255,255,0.25);
            transform: scale(1.1);
            box-shadow: 0 12px 40px rgba(0,0,0,0.15);
        }

        .hero-dot {
            border: none;
            outline: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 50%;
            width: 12px;
            height: 12px;
            cursor: pointer;
        }

        .hero-dot.bg-pink-500 {
            box-shadow: 0 0 0 4px rgba(236,72,153,0.3);
            transform: scale(1.2);
        }

        .hero-dots-container {
            position: absolute;
            bottom: 1.5rem;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 0.75rem;
            z-index: 10;
        }        /* Enhanced card styles */
        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        /* Hero content fixed sizing for zoom stability */
        .hero-content-container {
            width: 100%;
            max-width: 90%;
            margin: 0 auto;
            padding: clamp(1rem, 4vw, 3rem);
            position: relative;
            z-index: 2;
        }

        .hero-content-inner {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border-radius: 1.5rem;
            padding: clamp(1.5rem, 5vw, 4rem);
            text-align: center;
            width: 100%;
            max-width: 100%;
        }

        /* Fixed text sizing that doesn't scale with zoom */
        .hero-title {
            font-size: clamp(1.5rem, 4vw, 3.5rem);
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: clamp(0.75rem, 2vw, 1.5rem);
        }

        .hero-subtitle {
            font-size: clamp(1rem, 2.5vw, 2rem);
            font-weight: 300;
            line-height: 1.4;
            margin-bottom: clamp(0.75rem, 2vw, 1.5rem);
        }

        .hero-description {
            font-size: clamp(0.875rem, 1.5vw, 1.25rem);
            line-height: 1.6;
            margin-bottom: clamp(1rem, 3vw, 2rem);
            max-width: 100%;
        }

        .hero-button {
            font-size: clamp(0.875rem, 1.25vw, 1.125rem);
            padding: clamp(0.75rem, 1.5vw, 1rem) clamp(1.5rem, 3vw, 2.5rem);
            border-radius: 2rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Zoom-resistant dots and navigation */
        .hero-dot {
            border: none;
            outline: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 50%;
            width: clamp(10px, 1.5vw, 12px);
            height: clamp(10px, 1.5vw, 12px);
        }

        .hero-dot.bg-pink-500 {
            box-shadow: 0 0 0 4px rgba(236,72,153,0.3);
            transform: scale(1.2);
        }

        /* Dots container positioning */
        .hero-dots-container {
            position: absolute;
            bottom: clamp(16px, 3vw, 24px);
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: clamp(8px, 1.5vw, 12px);
            z-index: 20;
        }

        .stat-card {
            background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.1);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            border-color: rgba(255,255,255,0.2);
        }

        .product-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(0,0,0,0.05);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .product-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 25px 50px rgba(0,0,0,0.15);
        }

        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Enhanced button styles */
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.6);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            border: none;
            box-shadow: 0 4px 15px rgba(240, 147, 251, 0.4);
        }

        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(240, 147, 251, 0.6);
        }

        /* Stable responsive breakpoints like products */
        @media (max-width: 640px) {
            .hero-carousel {
                height: 300px;
            }

            .hero-content-inner {
                padding: 1.5rem;
            }

            .hero-title {
                font-size: 2rem !important;
            }

            .hero-subtitle {
                font-size: 1.125rem !important;
            }

            .hero-nav-btn {
                width: 40px;
                height: 40px;
            }
        }

        @media (min-width: 641px) and (max-width: 1024px) {
            .hero-carousel {
                height: 350px;
            }
        }

        @media (min-width: 1025px) {
            .hero-carousel {
                height: 400px;
            }
        }        /* Enhanced responsive grid */
        .responsive-grid {
            display: grid;
            gap: 1.5rem;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        }

        @media (min-width: 640px) {
            .responsive-grid {
                gap: 2rem;
                grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            }
        }

        @media (min-width: 1024px) {
            .responsive-grid {
                gap: 2.5rem;
                grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            }
        }

        @media (min-width: 1280px) {
            .responsive-grid {
                grid-template-columns: repeat(auto-fit, minmax(380px, 1fr));
                max-width: none;
            }
        }

        /* Prevent cards from becoming too wide */
        .product-card-container {
            max-width: 320px;
            margin: 0 auto;
        }

        @media (min-width: 1024px) {
            .product-card-container {
                max-width: 340px;
            }
        }

        @media (min-width: 1280px) {
            .product-card-container {
                max-width: 360px;
            }
        }

        /* Enhanced floating particles animation */
        .floating-particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
            z-index: 1;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float-particle 15s infinite linear;
        }

        .particle:nth-child(1) { width: 4px; height: 4px; left: 10%; animation-delay: 0s; }
        .particle:nth-child(2) { width: 6px; height: 6px; left: 20%; animation-delay: 2s; }
        .particle:nth-child(3) { width: 3px; height: 3px; left: 30%; animation-delay: 4s; }
        .particle:nth-child(4) { width: 5px; height: 5px; left: 40%; animation-delay: 6s; }
        .particle:nth-child(5) { width: 4px; height: 4px; left: 50%; animation-delay: 8s; }
        .particle:nth-child(6) { width: 6px; height: 6px; left: 60%; animation-delay: 10s; }
        .particle:nth-child(7) { width: 3px; height: 3px; left: 70%; animation-delay: 12s; }
        .particle:nth-child(8) { width: 5px; height: 5px; left: 80%; animation-delay: 14s; }

        @keyframes float-particle {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-100px) rotate(360deg);
                opacity: 0;
            }
        }

        /* Enhanced glow effects */
        .glow-effect {
            position: relative;
        }

        .glow-effect::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, #667eea, #764ba2, #f093fb, #f5576c);
            border-radius: inherit;
            z-index: -1;
            filter: blur(8px);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .glow-effect:hover::before {
            opacity: 0.7;
        }

        /* Enhanced scroll reveal */
        .scroll-reveal {
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .scroll-reveal.revealed {
            opacity: 1;
            transform: translateY(0);
        }

        /* Enhanced card hover effects */
        .card-3d {
            transform-style: preserve-3d;
            transition: transform 0.6s;
        }

        .card-3d:hover {
            transform: rotateY(5deg) rotateX(5deg);
        }

        /* Loading skeleton */
        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        .dark .skeleton {
            background: linear-gradient(90deg, #374151 25%, #4b5563 50%, #374151 75%);
            background-size: 200% 100%;
        }
    </style>
@endsection<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <!-- Enhanced background with gradient and floating particles -->
    <div class="py-6 sm:py-10 bg-gradient-to-br from-indigo-50 via-white to-purple-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 min-h-screen relative overflow-hidden">
        <!-- Floating particles background -->
        <div class="floating-particles">
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
        </div>

        <!-- Decorative background elements -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
            <div class="absolute top-20 left-10 w-72 h-72 bg-gradient-to-r from-purple-400 to-pink-400 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float"></div>
            <div class="absolute top-40 right-10 w-72 h-72 bg-gradient-to-r from-yellow-400 to-red-400 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float" style="animation-delay: 2s;"></div>
            <div class="absolute -top-40 left-1/2 w-72 h-72 bg-gradient-to-r from-blue-400 to-green-400 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float" style="animation-delay: 4s;"></div>
        </div>

        <div class="container-max mx-auto px-4 sm:px-6 lg:px-8 xl:px-8 2xl:px-8 relative z-10">
            <!-- Enhanced Hero Content Section with Carousel -->
            @if($heroContents->count() > 0)
            <div class="relative mb-10 animate-slide-up">
                <div class="hero-carousel">
                    <div class="hero-slides" id="heroSlides">
                        @foreach($heroContents as $index => $hero)
                        <div class="hero-slide"
                             @if($hero->background_image)
                             style="background-image: url('{{ asset('storage/' . $hero->background_image) }}'); background-size: cover; background-position: center;"
                             @endif>
                            <div class="hero-content-container">
                                <div class="hero-content-inner @if($hero->background_image) @else bg-white/90 dark:bg-gray-800/90 @endif">
                                    <div class="animate-float">
                                        <h1 class="hero-title @if($hero->background_image) text-white drop-shadow-2xl @else gradient-text @endif">
                                            {{ $hero->title }}
                                        </h1>
                                        @if($hero->subtitle)
                                        <h2 class="hero-subtitle @if($hero->background_image) text-white/90 @else text-gray-600 dark:text-gray-300 @endif">
                                            {{ $hero->subtitle }}
                                        </h2>
                                        @endif
                                        @if($hero->description)
                                        <p class="hero-description @if($hero->background_image) text-white/80 @else text-gray-700 dark:text-gray-300 @endif">
                                            {{ $hero->description }}
                                        </p>
                                        @endif
                                        @if($hero->button_text && $hero->button_url)
                                        <a href="{{ $hero->button_url }}" class="btn-primary hero-button text-white transform hover:scale-105 transition-all duration-300 shadow-xl hover:shadow-2xl">
                                            {{ $hero->button_text }}
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                            </svg>
                                        </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                @if($heroContents->count() > 1)
                <!-- Navigation arrows -->
                <button class="hero-nav-btn hero-prev">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                <button class="hero-nav-btn hero-next">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>

                <!-- Dots indicator -->
                <div class="hero-dots-container">
                    @foreach($heroContents as $index => $hero)
                    <button class="hero-dot transition-all duration-200 {{ $index === 0 ? 'bg-pink-500 scale-125' : 'bg-white bg-opacity-50 hover:bg-opacity-75' }}" data-slide="{{ $index }}"></button>
                    @endforeach
                </div>
                @endif
            </div>
            @endif

            <!-- Enhanced Statistics Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-4 sm:gap-6 lg:gap-6 xl:gap-8 mb-8 sm:mb-12 max-w-5xl mx-auto mt-16 sm:mt-20 lg:mt-24">
                <div class="stat-card glow-effect p-4 sm:p-6 lg:p-8 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 border border-white/20 scroll-reveal w-full" data-delay="0.1">
                    <div class="flex items-center">
                        <div class="p-3 sm:p-4 lg:p-5 rounded-2xl bg-gradient-to-br from-blue-500 to-blue-600 shadow-lg animate-float flex-shrink-0">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 lg:w-8 lg:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <div class="ml-3 sm:ml-4 lg:ml-6 min-w-0 flex-1">
                            <p class="text-xs sm:text-sm lg:text-base font-semibold text-gray-600 dark:text-gray-300 mb-1 truncate">Total Products</p>
                            <p class="text-lg sm:text-xl lg:text-2xl xl:text-3xl font-bold gradient-text">{{ $totalProducts }}</p>
                            <div class="flex items-center mt-1">
                                <div class="w-2 h-2 bg-blue-500 rounded-full animate-pulse-custom mr-2 flex-shrink-0"></div>
                                <span class="text-xs lg:text-sm text-gray-500 dark:text-gray-400 truncate">Active inventory</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="stat-card glow-effect p-4 sm:p-6 lg:p-8 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 border border-white/20 scroll-reveal w-full" data-delay="0.2">
                    <div class="flex items-center">
                        <div class="p-3 sm:p-4 lg:p-5 rounded-2xl bg-gradient-to-br from-green-500 to-green-600 shadow-lg animate-float flex-shrink-0" style="animation-delay: 1s;">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 lg:w-8 lg:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                        </div>
                        <div class="ml-3 sm:ml-4 lg:ml-6 min-w-0 flex-1">
                            <p class="text-xs sm:text-sm lg:text-base font-semibold text-gray-600 dark:text-gray-300 mb-1 truncate">Categories</p>
                            <p class="text-lg sm:text-xl lg:text-2xl xl:text-3xl font-bold gradient-text">{{ $totalCategories }}</p>
                            <div class="flex items-center mt-1">
                                <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse-custom mr-2 flex-shrink-0"></div>
                                <span class="text-xs lg:text-sm text-gray-500 dark:text-gray-400 truncate">Product types</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="stat-card glow-effect p-4 sm:p-6 lg:p-8 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 border border-white/20 scroll-reveal w-full sm:col-span-2 lg:col-span-1" data-delay="0.3">
                    <div class="flex items-center">
                        <div class="p-3 sm:p-4 lg:p-5 rounded-2xl bg-gradient-to-br from-orange-500 to-red-500 shadow-lg animate-float flex-shrink-0" style="animation-delay: 2s;">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 lg:w-8 lg:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-3 sm:ml-4 lg:ml-6 min-w-0 flex-1">
                            <p class="text-xs sm:text-sm lg:text-base font-semibold text-gray-600 dark:text-gray-300 mb-1 truncate">Limited Stock</p>
                            <p class="text-lg sm:text-xl lg:text-2xl xl:text-3xl font-bold gradient-text">{{ $limitedStockProducts->count() }}</p>
                            <div class="flex items-center mt-1">
                                <div class="w-2 h-2 bg-orange-500 rounded-full animate-pulse-custom mr-2 flex-shrink-0"></div>
                                <span class="text-xs lg:text-sm text-red-600 dark:text-red-400 font-medium truncate">Needs attention</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enhanced Limited Stock Alert -->
            @if($limitedStockProducts->count() > 0)
            <div class="glass-card border border-orange-200/50 dark:border-orange-800/50 rounded-2xl p-4 sm:p-6 lg:p-7 mb-8 sm:mb-12 scroll-reveal max-w-5xl mx-auto mt-12 sm:mt-16 lg:mt-20" data-delay="0.4">
                <div class="flex flex-col sm:flex-row sm:items-center mb-6 space-y-4 sm:space-y-0">
                    <div class="flex items-center">
                        <div class="p-3 rounded-2xl bg-gradient-to-br from-orange-500 to-red-500 shadow-lg animate-pulse-custom flex-shrink-0">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 lg:w-7 lg:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 15.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-base sm:text-lg lg:text-xl font-bold text-orange-800 dark:text-orange-200">⚠️ Limited Stock Alert!</h3>
                            <p class="text-sm lg:text-base text-orange-700 dark:text-orange-300">These products need immediate restocking</p>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-4 gap-4 sm:gap-5 max-w-none">
                    @foreach($limitedStockProducts as $product)
                    <div class="product-card-container">
                        <div class="product-card rounded-2xl p-4 sm:p-5 shadow-lg hover:shadow-xl transition-all duration-300 border border-orange-200/30 h-full flex flex-col">
                            <div class="relative flex-shrink-0">
                                @if($product->image)
                                    <div class="aspect-square overflow-hidden rounded-xl mb-3 sm:mb-4">
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                    </div>
                                    <div class="absolute top-2 right-2">
                                        <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full font-semibold animate-pulse-custom">
                                            {{ $product->stock }} left
                                        </span>
                                    </div>
                                @else
                                    <div class="aspect-square bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-600 dark:to-gray-700 rounded-xl mb-3 sm:mb-4 flex items-center justify-center">
                                        <svg class="w-8 h-8 sm:w-12 sm:h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 flex flex-col">
                                <h4 class="font-bold text-sm lg:text-base text-gray-900 dark:text-gray-100 mb-2 line-clamp-2 flex-1">{{ $product->name }}</h4>
                                <div class="flex justify-between items-center">
                                    <p class="text-sm lg:text-base font-bold gradient-text">${{ number_format($product->price, 2) }}</p>
                                    <span class="bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 text-xs px-2 py-1 rounded-full font-semibold">
                                        Only {{ $product->stock }} left!
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Enhanced Latest Products Section -->
            <div class="glass-card rounded-3xl shadow-2xl overflow-hidden animate-slide-up mt-16 sm:mt-20 lg:mt-24" style="animation-delay: 0.5s">
                <div class="bg-gradient-to-r from-purple-600 to-blue-600 p-6 sm:p-8">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-xl sm:text-2xl font-bold text-white mb-2">✨ Latest Products</h3>
                            <p class="text-purple-100">Discover our newest arrivals</p>
                        </div>
                        <div class="hidden sm:block">
                            <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-xl">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-6 sm:p-8">
                    @if($latestProducts->count() > 0)
                        <!-- Enhanced responsive grid for products -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-4 gap-4 sm:gap-5 lg:gap-6 max-w-none">
                            @foreach($latestProducts as $index => $product)
                            <div class="product-card-container">
                                <div class="product-card card-3d glow-effect rounded-2xl p-4 sm:p-5 lg:p-6 transition-all duration-500 hover:scale-105 hover:shadow-2xl border border-gray-100/50 dark:border-gray-700/50 scroll-reveal h-full flex flex-col"
                                     data-category="{{ $product->category ? strtolower(str_replace(' ', '-', $product->category->name)) : 'uncategorized' }}"
                                     data-delay="{{ 0.6 + ($index * 0.1) }}">

                                    <div class="relative mb-4 group overflow-hidden rounded-xl flex-shrink-0">
                                        @if($product->image)
                                            <div class="aspect-square overflow-hidden rounded-xl">
                                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110 group-hover:rotate-2">
                                            </div>
                                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent rounded-xl opacity-0 group-hover:opacity-100 transition-all duration-300">
                                                <div class="absolute bottom-4 left-4 right-4">
                                                    <div class="flex items-center justify-between text-white">
                                                        <span class="text-sm font-medium">Quick View</span>
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="aspect-square bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-gray-600 dark:to-gray-700 rounded-xl flex items-center justify-center group-hover:from-indigo-200 group-hover:to-purple-200 dark:group-hover:from-gray-500 dark:group-hover:to-gray-600 transition-all duration-300">
                                                <svg class="w-12 h-12 lg:w-16 lg:h-16 text-gray-400 group-hover:text-gray-500 transition-colors duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                        @endif

                                        <!-- Enhanced status badges -->
                                        <div class="absolute top-3 left-3 flex flex-col gap-2">
                                            @if($product->stock <= 5 && $product->stock > 0)
                                                <span class="bg-gradient-to-r from-orange-500 to-red-500 text-white text-xs px-2 py-1 rounded-full font-semibold animate-pulse-custom shadow-lg">
                                                    Low Stock
                                                </span>
                                            @elseif($product->stock == 0)
                                                <span class="bg-gradient-to-r from-gray-500 to-gray-600 text-white text-xs px-2 py-1 rounded-full font-semibold shadow-lg">
                                                    Out of Stock
                                                </span>
                                            @endif
                                        </div>

                                        @if($product->category)
                                            <div class="absolute top-3 right-3">
                                                <span class="bg-white/95 backdrop-blur-md text-gray-800 text-xs px-2 py-1 rounded-full font-semibold shadow-lg border border-white/20">
                                                    {{ $product->category->name }}
                                                </span>
                                            </div>
                                        @endif

                                        <!-- Heart/Wishlist button -->
                                        <div class="absolute bottom-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                            <button class="w-8 h-8 lg:w-10 lg:h-10 bg-white/90 backdrop-blur-md rounded-full flex items-center justify-center shadow-lg hover:bg-red-50 hover:text-red-500 transition-all duration-200">
                                                <svg class="w-4 h-4 lg:w-5 lg:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="space-y-3 flex-1 flex flex-col">
                                        <div class="flex items-start justify-between">
                                            <h4 class="font-bold text-sm lg:text-base text-gray-900 dark:text-gray-100 line-clamp-2 group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors duration-300 flex-1 mr-2">
                                                {{ $product->name }}
                                            </h4>
                                            @if($product->brand)
                                                <span class="text-xs text-gray-500 dark:text-gray-400 font-medium bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded-full flex-shrink-0">
                                                    {{ $product->brand }}
                                                </span>
                                            @endif
                                        </div>

                                        <div class="flex justify-between items-center">
                                            <div class="flex flex-col">
                                                <span class="text-base lg:text-lg xl:text-xl font-bold gradient-text">${{ number_format($product->price, 2) }}</span>
                                                @if($product->stock > 0)
                                                    <span class="text-xs text-green-600 dark:text-green-400 font-medium">
                                                        {{ $product->stock }} in stock
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="flex items-center space-x-1">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <svg class="w-3 h-3 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                    </svg>
                                                @endfor
                                                <span class="text-xs text-gray-500 ml-1">(4.5)</span>
                                            </div>
                                        </div>

                                        @if($product->description)
                                            <p class="text-xs lg:text-sm text-gray-600 dark:text-gray-400 line-clamp-2 leading-relaxed flex-1">
                                                {{ \Illuminate\Support\Str::limit($product->description, 80) }}
                                            </p>
                                        @endif

                                        <!-- Enhanced Add to Cart Section -->
                                        @if($product->stock > 0)
                                        <div class="mt-auto space-y-3">
                                            <form action="{{ route('cart.add') }}" method="POST" class="add-to-cart-form">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <div class="flex items-center justify-between mb-3">
                                                    <label for="quantity_{{ $product->id }}" class="text-xs lg:text-sm font-semibold text-gray-700 dark:text-gray-300">Qty:</label>
                                                    <select name="quantity" id="quantity_{{ $product->id }}" class="border-2 border-gray-200 dark:border-gray-600 rounded-lg px-2 py-1 text-xs lg:text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200">
                                                        @for($i = 1; $i <= min(10, $product->stock); $i++)
                                                            <option value="{{ $i }}">{{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn-primary glow-effect w-full px-3 py-2 lg:px-4 lg:py-3 rounded-xl text-xs lg:text-sm font-semibold text-white transition-all duration-300 flex items-center justify-center group">
                                                    <svg class="w-3 h-3 lg:w-4 lg:h-4 mr-2 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13L5.5 7M17 21a2 2 0 100-4 2 2 0 000 4zM9 21a2 2 0 100-4 2 2 0 000 4z"></path>
                                                    </svg>
                                                    Add to Cart
                                                </button>
                                            </form>
                                        </div>
                                        @else
                                        <div class="mt-auto">
                                            <button disabled class="w-full bg-gray-300 dark:bg-gray-600 text-gray-500 dark:text-gray-400 px-3 py-2 lg:px-4 lg:py-3 rounded-xl text-xs lg:text-sm font-semibold cursor-not-allowed flex items-center justify-center">
                                                <svg class="w-3 h-3 lg:w-4 lg:h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18 21l-2.1-2.1M5.636 5.636L3 3l2.1 2.1"></path>
                                                </svg>
                                                Out of Stock
                                            </button>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-16">
                            <div class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-800 rounded-3xl mx-auto mb-6 flex items-center justify-center">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">No Products Available</h3>
                            <p class="text-gray-600 dark:text-gray-400 max-w-md mx-auto">Products will appear here once they are added by the admin. Check back soon for amazing deals!</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Enhanced Categories Section -->
            @if($categories->count() > 0)
            <div class="mt-16 sm:mt-20 lg:mt-24 glass-card rounded-3xl shadow-2xl overflow-hidden scroll-reveal max-w-5xl mx-auto" data-delay="0.6">
                <div class="bg-gradient-to-r from-emerald-500 to-teal-600 p-4 sm:p-6 lg:p-8">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
                        <div>
                            <h3 class="text-lg sm:text-xl lg:text-2xl font-bold text-white mb-2">🛍️ Shop by Category</h3>
                            <p class="text-sm lg:text-base text-emerald-100">Filter products by your preferred style</p>
                        </div>
                        <div class="hidden lg:block">
                            <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-xl">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-4 sm:p-6 lg:p-8">
                    <div class="flex flex-wrap gap-3 sm:gap-4 justify-center lg:justify-start">
                        <button onclick="filterProducts('all')" class="category-filter active btn-primary px-4 sm:px-6 py-2 sm:py-3 rounded-2xl text-sm lg:text-base font-semibold text-white transition-all duration-300 hover:scale-105 shadow-lg">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                                All Products
                            </span>
                        </button>
                        @foreach($categories as $categoryName)
                        <button onclick="filterProducts('{{ strtolower(str_replace(' ', '-', $categoryName)) }}')" class="category-filter bg-white/80 dark:bg-gray-700/80 backdrop-blur-md text-gray-700 dark:text-gray-300 px-4 sm:px-6 py-2 sm:py-3 rounded-2xl text-sm lg:text-base font-semibold hover:bg-gradient-to-r hover:from-purple-500 hover:to-pink-500 hover:text-white transition-all duration-300 hover:scale-105 shadow-lg border border-gray-200/50 dark:border-gray-600/50">
                            {{ $categoryName }}
                        </button>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- Enhanced Cart Success Alert -->
            <div id="cart-success-alert" class="hidden fixed top-6 right-6 z-50 animate-slide-up">
                <div class="bg-gradient-to-r from-green-500 to-emerald-600 text-white px-6 py-4 rounded-2xl shadow-2xl backdrop-blur-xl border border-white/20 max-w-sm">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-3 flex-1">
                            <p class="text-sm font-semibold">Success!</p>
                            <p class="text-xs text-green-100">Product added to cart</p>
                        </div>
                        <button onclick="hideAlert()" class="ml-4 text-white/80 hover:text-white transition-colors duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Enhanced Hero Carousel functionality with smoother transitions
        let currentSlide = 0;
        const slides = document.querySelectorAll('.hero-slide');
        const totalSlides = slides.length;
        const slidesContainer = document.getElementById('heroSlides');
        const dots = document.querySelectorAll('.hero-dot');
        let autoSlideInterval;

        function updateCarousel() {
            if (slidesContainer && totalSlides > 0) {
                slidesContainer.style.transform = `translateX(-${currentSlide * 100}%)`;

                // Update dots with enhanced animation
                dots.forEach((dot, index) => {
                    if (index === currentSlide) {
                        dot.classList.add('bg-pink-500', 'scale-125');
                        dot.classList.remove('bg-white', 'bg-opacity-50', 'bg-opacity-75');
                    } else {
                        dot.classList.remove('bg-pink-500', 'scale-125');
                        dot.classList.add('bg-white', 'bg-opacity-50');
                    }
                });
            }
        }

        function nextSlide() {
            if (totalSlides > 1) {
                currentSlide = (currentSlide + 1) % totalSlides;
                updateCarousel();
            }
        }

        function prevSlide() {
            if (totalSlides > 1) {
                currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
                updateCarousel();
            }
        }

        function goToSlide(slideIndex) {
            if (slideIndex >= 0 && slideIndex < totalSlides) {
                currentSlide = slideIndex;
                updateCarousel();
            }
        }

        function startAutoSlide() {
            if (totalSlides > 1) {
                stopAutoSlide(); // Clear any existing interval
                autoSlideInterval = setInterval(nextSlide, 5000); // Reduced to 5 seconds
            }
        }

        function stopAutoSlide() {
            if (autoSlideInterval) {
                clearInterval(autoSlideInterval);
                autoSlideInterval = null;
            }
        }

        // Enhanced event listeners for carousel
        document.addEventListener('DOMContentLoaded', function() {
            // Only initialize if carousel exists
            if (totalSlides > 0) {
                const nextBtn = document.querySelector('.hero-next');
                const prevBtn = document.querySelector('.hero-prev');
                const carousel = document.querySelector('.hero-carousel');

                // Next button
                if (nextBtn) {
                    nextBtn.addEventListener('click', (e) => {
                        e.preventDefault();
                        stopAutoSlide();
                        nextSlide();
                        setTimeout(startAutoSlide, 8000);
                    });
                }

                // Previous button
                if (prevBtn) {
                    prevBtn.addEventListener('click', (e) => {
                        e.preventDefault();
                        stopAutoSlide();
                        prevSlide();
                        setTimeout(startAutoSlide, 8000);
                    });
                }

                // Dot navigation
                dots.forEach((dot, index) => {
                    dot.addEventListener('click', (e) => {
                        e.preventDefault();
                        stopAutoSlide();
                        goToSlide(index);
                        setTimeout(startAutoSlide, 8000);
                    });
                });

                // Pause on hover
                if (carousel) {
                    carousel.addEventListener('mouseenter', stopAutoSlide);
                    carousel.addEventListener('mouseleave', startAutoSlide);
                }

                // Keyboard navigation
                document.addEventListener('keydown', function(e) {
                    if (carousel && totalSlides > 1) {
                        if (e.key === 'ArrowLeft') {
                            e.preventDefault();
                            stopAutoSlide();
                            prevSlide();
                            setTimeout(startAutoSlide, 8000);
                        } else if (e.key === 'ArrowRight') {
                            e.preventDefault();
                            stopAutoSlide();
                            nextSlide();
                            setTimeout(startAutoSlide, 8000);
                        }
                    }
                });

                // Touch/swipe support for mobile
                let startX = null;
                if (carousel) {
                    carousel.addEventListener('touchstart', (e) => {
                        startX = e.touches[0].clientX;
                    });

                    carousel.addEventListener('touchend', (e) => {
                        if (startX !== null) {
                            const endX = e.changedTouches[0].clientX;
                            const diff = startX - endX;

                            if (Math.abs(diff) > 50) { // Minimum swipe distance
                                stopAutoSlide();
                                if (diff > 0) {
                                    nextSlide(); // Swipe left = next
                                } else {
                                    prevSlide(); // Swipe right = previous
                                }
                                setTimeout(startAutoSlide, 8000);
                            }
                            startX = null;
                        }
                    });
                }

                // Start auto-slide
                updateCarousel(); // Initialize first slide
                startAutoSlide();

                // Simple resize handler for stable performance
                window.addEventListener('resize', () => {
                    updateCarousel();
                });
            }            // Initialize scroll animations
            initScrollAnimations();
        });

        // Enhanced scroll animations with intersection observer
        function initScrollAnimations() {
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const delay = entry.target.dataset.delay || 0;
                        setTimeout(() => {
                            entry.target.classList.add('revealed');
                        }, delay * 1000);
                    }
                });
            }, observerOptions);

            // Observe all scroll reveal elements
            document.querySelectorAll('.scroll-reveal').forEach(el => {
                observer.observe(el);
            });

            // Legacy support for animate-slide-up
            document.querySelectorAll('.animate-slide-up').forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(30px)';
                el.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
                observer.observe(el);
            });
        }

        // Enhanced add to cart functionality with better UX
        document.querySelectorAll('.add-to-cart-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);
                const button = this.querySelector('button[type="submit"]');
                const originalText = button.innerHTML;

                // Enhanced loading state
                button.innerHTML = `
                    <div class="flex items-center justify-center">
                        <div class="animate-spin rounded-full h-4 w-4 border-b-2 border-white mr-2"></div>
                        <span>Adding...</span>
                    </div>
                `;
                button.disabled = true;
                button.classList.add('opacity-75', 'cursor-not-allowed');

                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showSuccessAlert();
                        updateCartCount();

                        // Add success animation to button
                        button.innerHTML = `
                            <div class="flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Added!</span>
                            </div>
                        `;
                        button.classList.add('bg-green-500');

                        setTimeout(() => {
                            button.innerHTML = originalText;
                            button.classList.remove('bg-green-500');
                        }, 2000);
                    } else {
                        showErrorAlert(data.message || 'Error adding product to cart');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showErrorAlert('An error occurred while adding the product to cart');
                })
                .finally(() => {
                    button.disabled = false;
                    button.classList.remove('opacity-75', 'cursor-not-allowed');
                });
            });
        });

        // Enhanced category filter functionality
        function filterProducts(category) {
            const productCards = document.querySelectorAll('[data-category]');
            const filterButtons = document.querySelectorAll('.category-filter');

            // Enhanced button state management
            filterButtons.forEach(btn => {
                btn.classList.remove('active');
                btn.classList.remove('btn-primary');
                btn.classList.add('bg-white/80', 'dark:bg-gray-700/80', 'text-gray-700', 'dark:text-gray-300');
            });

            // Add active state to clicked button
            event.target.classList.add('active', 'btn-primary');
            event.target.classList.remove('bg-white/80', 'dark:bg-gray-700/80', 'text-gray-700', 'dark:text-gray-300');

            // Enhanced filter animation
            productCards.forEach((card, index) => {
                if (category === 'all' || card.getAttribute('data-category') === category) {
                    card.style.display = 'block';
                    card.classList.remove('hidden');
                    // Stagger animation
                    setTimeout(() => {
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0) scale(1)';
                    }, index * 50);
                } else {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(20px) scale(0.95)';
                    setTimeout(() => {
                        card.style.display = 'none';
                        card.classList.add('hidden');
                    }, 300);
                }
            });
        }

        // Enhanced alert functions
        function showSuccessAlert() {
            const alert = document.getElementById('cart-success-alert');
            alert.classList.remove('hidden');
            alert.style.transform = 'translateX(100%)';
            alert.style.opacity = '0';

            // Animate in
            setTimeout(() => {
                alert.style.transform = 'translateX(0)';
                alert.style.opacity = '1';
            }, 10);

            setTimeout(() => {
                hideAlert();
            }, 4000);
        }

        function showErrorAlert(message) {
            // Create and show error alert
            const alertContainer = document.createElement('div');
            alertContainer.className = 'fixed top-6 right-6 z-50';
            alertContainer.innerHTML = `
                <div class="bg-gradient-to-r from-red-500 to-pink-600 text-white px-6 py-4 rounded-2xl shadow-2xl backdrop-blur-xl border border-white/20 max-w-sm">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-3 flex-1">
                            <p class="text-sm font-semibold">Error!</p>
                            <p class="text-xs text-red-100">${message}</p>
                        </div>
                    </div>
                </div>
            `;

            document.body.appendChild(alertContainer);

            setTimeout(() => {
                alertContainer.remove();
            }, 4000);
        }

        function hideAlert() {
            const alert = document.getElementById('cart-success-alert');
            alert.style.transform = 'translateX(100%)';
            alert.style.opacity = '0';

            setTimeout(() => {
                alert.classList.add('hidden');
            }, 300);
        }

        // Enhanced cart count update
        function updateCartCount() {
            fetch('/cart/count')
                .then(response => response.json())
                .then(data => {
                    const cartCount = document.querySelector('.cart-count');
                    if (cartCount) {
                        cartCount.textContent = data.count;
                        // Add pulse animation
                        cartCount.classList.add('animate-pulse-custom');
                        setTimeout(() => {
                            cartCount.classList.remove('animate-pulse-custom');
                        }, 1000);
                    }
                })
                .catch(error => console.log('Cart count update failed:', error));
        }

        // Enhanced keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (e.key === 'ArrowLeft') {
                prevSlide();
            } else if (e.key === 'ArrowRight') {
                nextSlide();
            }
        });
    </script>
</x-app-layout>
