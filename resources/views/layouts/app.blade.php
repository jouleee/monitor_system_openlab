<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'OpenLab Status Tracker - FPMIPA UPI 2025')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-bg': '#FCFCFD',
                        'light-blue': '#4DA2D9',
                        'medium-blue': '#1E7CD7',
                        'dark-blue': '#0068CA',
                        'navy': '#263997',
                    },
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif'],
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-up': 'slideUp 0.6s ease-out',
                        'bounce-subtle': 'bounceSubtle 0.3s ease-in-out',
                        'float': 'float 3s ease-in-out infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        slideUp: {
                            '0%': { transform: 'translateY(20px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        },
                        bounceSubtle: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-4px)' },
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-10px)' },
                        }
                    }
                },
            },
        }
    </script>
    
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #263997 0%, #0068CA 100%);
        }
        
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        }
        
        .status-kosong {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }
        
        .status-terisi {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
        }
        
        .status-hampir-selesai {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
        }
    </style>
    
    @yield('styles')
</head>
<body class="bg-primary-bg font-inter antialiased">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 group">
                        <div class="w-10 h-10 bg-gradient-to-br from-medium-blue to-dark-blue rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-microscope text-white text-lg"></i>
                        </div>
                        <div class="hidden sm:block">
                            <h1 class="text-xl font-bold text-navy">OpenLab FPMIPA</h1>
                            <p class="text-sm text-gray-600">UPI 2025</p>
                        </div>
                    </a>
                </div>
                
                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-medium-blue transition-colors duration-200 font-medium">
                        <i class="fas fa-home mr-2"></i>Dashboard
                    </a>
                    
                    @auth
                        <div class="relative group">
                            <button class="flex items-center space-x-2 text-gray-700 hover:text-medium-blue transition-colors duration-200 font-medium">
                                <div class="w-8 h-8 bg-gradient-to-br from-light-blue to-medium-blue rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-white text-sm"></i>
                                </div>
                                <span>Admin</span>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </button>
                            
                            <div class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                                <div class="py-2">
                                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-50 hover:text-medium-blue transition-colors duration-200">
                                        <i class="fas fa-cogs mr-2"></i>Dashboard Admin
                                    </a>
                                    <hr class="my-1 border-gray-100">
                                    <form action="{{ route('logout') }}" method="POST" class="block">
                                        @csrf
                                        <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50 transition-colors duration-200">
                                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="bg-gradient-to-r from-medium-blue to-dark-blue text-white px-4 py-2 rounded-lg hover:shadow-lg transition-all duration-200 font-medium">
                            <i class="fas fa-lock mr-2"></i>Admin Login
                        </a>
                    @endauth
                </div>
                
                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button type="button" class="text-gray-700 hover:text-medium-blue transition-colors duration-200" onclick="toggleMobileMenu()">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile menu -->
        <div id="mobile-menu" class="md:hidden hidden bg-white border-t border-gray-100">
            <div class="px-4 py-3 space-y-2">
                <a href="{{ route('dashboard') }}" class="block text-gray-700 hover:text-medium-blue transition-colors duration-200 font-medium py-2">
                    <i class="fas fa-home mr-2"></i>Dashboard
                </a>
                
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="block text-gray-700 hover:text-medium-blue transition-colors duration-200 font-medium py-2">
                        <i class="fas fa-cogs mr-2"></i>Dashboard Admin
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="block">
                        @csrf
                        <button type="submit" class="w-full text-left text-red-600 hover:text-red-700 transition-colors duration-200 font-medium py-2">
                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block text-medium-blue hover:text-dark-blue transition-colors duration-200 font-medium py-2">
                        <i class="fas fa-lock mr-2"></i>Admin Login
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-navy text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center md:text-left">
                    <div class="flex items-center justify-center md:justify-start space-x-3 mb-4">
                        <div class="w-10 h-10 bg-light-blue rounded-xl flex items-center justify-center">
                            <i class="fas fa-microscope text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold">OpenLab FPMIPA</h3>
                            <p class="text-light-blue text-sm">UPI 2025</p>
                        </div>
                    </div>
                    <p class="text-gray-300 text-sm">
                        Sistem monitoring laboratorium untuk kegiatan OpenLab FPMIPA UPI
                    </p>
                </div>
                
                <div class="text-center">
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <div class="space-y-2">
                        <a href="{{ route('dashboard') }}" class="block text-gray-300 hover:text-light-blue transition-colors duration-200">Dashboard</a>
                        @auth
                            <a href="{{ route('admin.dashboard') }}" class="block text-gray-300 hover:text-light-blue transition-colors duration-200">Admin Panel</a>
                        @endauth
                    </div>
                </div>
                
                <div class="text-center md:text-right">
                    <h4 class="text-lg font-semibold mb-4">Kontak</h4>
                    <div class="space-y-2 text-gray-300 text-sm">
                        <p><i class="fas fa-university mr-2"></i>FPMIPA UPI</p>
                        <p><i class="fas fa-map-marker-alt mr-2"></i>Bandung, Indonesia</p>
                        <p><i class="fas fa-envelope mr-2"></i>fpmipa@upi.edu</p>
                    </div>
                </div>
            </div>
            
            <hr class="border-gray-600 my-8">
            
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-300 text-sm mb-4 md:mb-0">
                    © 2025 Fakultas Pendidikan Matematika dan Ilmu Pengetahuan Alam - UPI
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-300 hover:text-light-blue transition-colors duration-200">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-gray-300 hover:text-light-blue transition-colors duration-200">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-gray-300 hover:text-light-blue transition-colors duration-200">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    
    <script>
        // Setup CSRF token for AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        // Mobile menu toggle
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        }
        
        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const mobileMenu = document.getElementById('mobile-menu');
            const mobileButton = event.target.closest('[onclick="toggleMobileMenu()"]');
            
            if (!mobileButton && !mobileMenu.contains(event.target)) {
                mobileMenu.classList.add('hidden');
            }
        });
    </script>
    
    @yield('scripts')
</body>
</html>
