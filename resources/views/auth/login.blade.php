@extends('layouts.app')

@section('title', 'Admin Login - OpenLab FPMIPA UPI 2025')

@section('content')
<section class="min-h-screen flex items-center justify-center relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 bg-gradient-to-br from-navy via-dark-blue to-medium-blue">
        <div class="absolute inset-0 bg-black bg-opacity-10"></div>
        <!-- Animated Background Shapes -->
        <div class="absolute top-10 left-10 w-72 h-72 bg-light-blue opacity-10 rounded-full mix-blend-multiply filter blur-xl animate-float"></div>
        <div class="absolute top-0 right-4 w-72 h-72 bg-medium-blue opacity-10 rounded-full mix-blend-multiply filter blur-xl animate-float" style="animation-delay: 2s;"></div>
        <div class="absolute -bottom-8 left-20 w-72 h-72 bg-white opacity-5 rounded-full mix-blend-multiply filter blur-xl animate-float" style="animation-delay: 4s;"></div>
    </div>
    
    <div class="relative w-full max-w-md mx-auto px-6">
        <!-- Login Card -->
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-light-blue to-medium-blue px-8 py-12 text-center text-white relative">
                <div class="absolute inset-0 bg-black bg-opacity-10"></div>
                <div class="relative">
                    <!-- Logo -->
                    <div class="w-20 h-20 mx-auto mb-6 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-user-shield text-3xl"></i>
                    </div>
                    <h1 class="text-2xl font-bold mb-2">Admin Login</h1>
                    <p class="text-blue-100">Masuk untuk mengelola status laboratorium</p>
                </div>
            </div>
            
            <!-- Form -->
            <div class="p-8">
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-6">
                        <div class="flex">
                            <i class="fas fa-exclamation-circle text-red-400 mr-3 mt-0.5"></i>
                            <div>
                                <h3 class="text-red-800 font-medium mb-2">Terjadi Kesalahan:</h3>
                                <ul class="text-red-700 text-sm space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <!-- Email Field -->
                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-envelope mr-2 text-medium-blue"></i>Email Address
                        </label>
                        <div class="relative">
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                value="{{ old('email') }}" 
                                required 
                                autocomplete="email"
                                placeholder="admin@fpmipa.upi.edu"
                                class="w-full px-4 py-4 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-medium-blue focus:border-transparent transition-all duration-200 text-gray-800 placeholder-gray-400"
                            >
                            <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Password Field -->
                    <div class="space-y-2">
                        <label for="password" class="block text-sm font-semibold text-gray-700">
                            <i class="fas fa-lock mr-2 text-medium-blue"></i>Password
                        </label>
                        <div class="relative">
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                required 
                                autocomplete="current-password"
                                placeholder="••••••••••••"
                                class="w-full px-4 py-4 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-medium-blue focus:border-transparent transition-all duration-200 text-gray-800 placeholder-gray-400"
                            >
                            <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                                <button type="button" onclick="togglePassword()" class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
                                    <i class="fas fa-eye" id="password-toggle-icon"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button type="submit" class="w-full bg-gradient-to-r from-medium-blue to-dark-blue text-white font-semibold py-4 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-medium-blue focus:ring-offset-2">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            Masuk sebagai Admin
                        </button>
                    </div>
                </form>
                
                <!-- Back to Dashboard Link -->
                <div class="text-center mt-8 pt-6 border-t border-gray-100">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center text-gray-600 hover:text-medium-blue transition-colors duration-200 font-medium">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Demo Credentials -->
        <div class="mt-8 bg-white bg-opacity-95 backdrop-blur-sm rounded-2xl p-6 shadow-lg">
            <div class="text-center">
                <h3 class="text-lg font-semibold text-navy mb-4 flex items-center justify-center">
                    <i class="fas fa-info-circle mr-2 text-light-blue"></i>
                    Informasi Login Demo
                </h3>
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl p-4 space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600 font-medium">Email:</span>
                        <span class="text-navy font-mono bg-white px-3 py-1 rounded-lg text-sm">admin@fpmipa.upi.edu</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600 font-medium">Password:</span>
                        <span class="text-navy font-mono bg-white px-3 py-1 rounded-lg text-sm">password123</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Auto focus on email field
    $('#email').focus();
    
    // Form submission with loading state
    $('form').on('submit', function() {
        const submitBtn = $(this).find('button[type="submit"]');
        const originalText = submitBtn.html();
        
        submitBtn.html('<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...');
        submitBtn.prop('disabled', true);
        
        // Re-enable if form validation fails
        setTimeout(function() {
            submitBtn.html(originalText);
            submitBtn.prop('disabled', false);
        }, 5000);
    });
    
    // Add subtle animations to form elements
    $('.space-y-6 > div').each(function(index) {
        $(this).css({
            'animation-delay': (index * 0.1) + 's',
            'animation-fill-mode': 'both'
        }).addClass('animate-slide-up');
    });
});

// Toggle password visibility
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.getElementById('password-toggle-icon');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    }
}
</script>
@endsection
