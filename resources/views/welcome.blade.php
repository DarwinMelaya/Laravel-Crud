<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Darwin's Sari Sari Store</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <!-- Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        animation: {
                            'fade-in': 'fadeIn 1s ease-in',
                        },
                        keyframes: {
                            fadeIn: {
                                '0%': { opacity: '0' },
                                '100%': { opacity: '1' },
                            }
                        }
                    }
                }
            }
        </script>

        <style>
            .bg-overlay {
                background-image: linear-gradient(rgba(0, 128, 0, 0.7), rgba(0, 0, 0, 0.8)), url('https://images.unsplash.com/photo-1604719312566-8912e9227c6a?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');
                background-size: cover;
                background-position: center;
                background-attachment: fixed;
            }
            .glass-card {
                backdrop-filter: blur(10px);
                background: rgba(255, 255, 255, 0.1);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="bg-overlay min-h-screen flex flex-col items-center">
            <!-- Navigation -->
            @if (Route::has('login'))
                <nav class="w-full p-4 backdrop-blur-md bg-black/20 z-50">
                    <div class="max-w-6xl mx-auto flex justify-between items-center">
                        <a href="/" class="text-white font-bold text-lg">Darwin's</a>
                        <div>
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-white hover:text-green-300 transition duration-300 ease-in-out">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-white hover:text-green-300 transition duration-300 ease-in-out mr-4">Log in</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="bg-green-500 text-white px-3 py-1.5 rounded-lg hover:bg-green-600 transition duration-300 ease-in-out text-sm">Register</a>
                                @endif
                            @endauth
                        </div>
                    </div>
                </nav>
            @endif

            <!-- Main Content -->
            <div class="text-center px-4 py-16 animate-fade-in max-w-4xl mx-auto">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-3 drop-shadow-lg">
                    Darwin's <span class="text-green-400">Sari Sari</span> Store
                </h1>
                <p class="text-lg text-white/90 mb-8 max-w-2xl mx-auto leading-relaxed">
                    Your one-stop shop for all your daily needs. We offer a wide variety of products at affordable prices.
                </p>
                <a href="{{ route('product.index') }}" 
                   class="group inline-flex items-center px-6 py-2 text-base font-medium text-white bg-green-500 rounded-full hover:bg-green-600 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-green-500/50">
                    Explore Products
                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-2 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
            </div>

            <!-- Features -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-6xl mx-auto px-4 pb-16">
                <div class="glass-card p-6 rounded-lg text-white transform hover:scale-105 transition-all duration-300">
                    <div class="flex items-center justify-center w-12 h-12 bg-green-500 rounded-full mb-4 mx-auto">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Quality Products</h3>
                    <p class="text-white/90 text-sm">We carefully select our products to ensure the best quality for our customers.</p>
                </div>

                <div class="glass-card p-6 rounded-lg text-white transform hover:scale-105 transition-all duration-300">
                    <div class="flex items-center justify-center w-12 h-12 bg-green-500 rounded-full mb-4 mx-auto">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Affordable Prices</h3>
                    <p class="text-white/90 text-sm">We offer competitive prices to make sure our products are accessible to everyone.</p>
                </div>

                <div class="glass-card p-6 rounded-lg text-white transform hover:scale-105 transition-all duration-300">
                    <div class="flex items-center justify-center w-12 h-12 bg-green-500 rounded-full mb-4 mx-auto">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Easy Management</h3>
                    <p class="text-white/90 text-sm">Our inventory system makes it easy to track and manage your products.</p>
                </div>
            </div>
        </div>
    </body>
</html>
