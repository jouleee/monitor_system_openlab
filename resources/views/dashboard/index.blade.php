@extends('layouts.app')

@section('title', 'OpenLab Status Tracker - FPMIPA UPI 2025')

@section('content')
<!-- Hero Section dengan Background yang Berbeda -->
<section class="relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 bg-gradient-to-br from-blue-50 via-white to-blue-50">
        <div class="absolute inset-0 bg-grid-pattern opacity-5"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24">
        <div class="text-center">
            <!-- Animated Icon -->
            <div class="flex justify-center mb-8">
                <div class="relative">
                    <div class="w-20 h-20 bg-gradient-to-br from-light-blue to-medium-blue rounded-3xl flex items-center justify-center animate-float shadow-2xl">
                        <i class="fas fa-microscope text-white text-3xl"></i>
                    </div>
                    <!-- Pulse Ring -->
                    <div class="absolute inset-0 w-20 h-20 bg-light-blue rounded-3xl opacity-30 animate-ping"></div>
                </div>
            </div>
            
            <!-- Hero Text -->
            <h1 class="text-4xl md:text-6xl font-bold text-navy mb-6 animate-fade-in">
                OpenLab Status
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-light-blue to-medium-blue">
                    Tracker
                </span>
            </h1>
            
            <p class="text-xl md:text-2xl text-gray-600 mb-8 max-w-3xl mx-auto animate-slide-up">
                Pantau status laboratorium secara <span class="font-semibold text-medium-blue">real-time</span> 
                untuk kegiatan OpenLab FPMIPA UPI 2025
            </p>
            
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl mx-auto mb-12">
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                    <div class="text-3xl font-bold text-navy mb-2" id="total-labs">{{ $labs->count() }}</div>
                    <div class="text-gray-600 font-medium">Total Laboratorium</div>
                </div>
                
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                    <div class="text-3xl font-bold text-green-500 mb-2" id="available-labs">
                        {{ $labs->where('status.name', 'Kosong')->count() }}
                    </div>
                    <div class="text-gray-600 font-medium">Lab Tersedia</div>
                </div>
                
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                    <div class="text-3xl font-bold text-red-500 mb-2" id="occupied-labs">
                        {{ $labs->where('status.name', 'Terisi')->count() }}
                    </div>
                    <div class="text-gray-600 font-medium">Lab Terisi</div>
                </div>
            </div>
            
            <!-- Last Update Info -->
            <div class="inline-flex items-center bg-white rounded-full px-6 py-3 shadow-md border border-gray-100">
                <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse mr-3"></div>
                <span class="text-gray-600 text-sm">
                    Terakhir diperbarui: <span id="update-time" class="font-medium">{{ now()->format('H:i:s') }}</span>
                </span>
            </div>
        </div>
    </div>
</section>

<!-- Status Legend dengan Design Modern -->
<section class="bg-white py-12 border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center text-navy mb-12">Keterangan Status</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Status Kosong -->
            <div class="text-center group">
                <div class="bg-gradient-to-br from-green-100 to-green-50 rounded-2xl p-8 mb-6 group-hover:shadow-lg transition-all duration-300">
                    <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center">
                        <i class="fas fa-check-circle text-white text-2xl"></i>
                    </div>
                    <div class="status-kosong inline-flex items-center px-6 py-3 rounded-full text-lg font-semibold mb-4">
                        🟢 Kosong
                    </div>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Laboratorium Tersedia</h3>
                <p class="text-gray-600">Laboratorium siap untuk dikunjungi dan digunakan oleh pengunjung</p>
            </div>
            
            <!-- Status Terisi -->
            <div class="text-center group">
                <div class="bg-gradient-to-br from-red-100 to-red-50 rounded-2xl p-8 mb-6 group-hover:shadow-lg transition-all duration-300">
                    <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-br from-red-500 to-red-600 rounded-2xl flex items-center justify-center">
                        <i class="fas fa-users text-white text-2xl"></i>
                    </div>
                    <div class="status-terisi inline-flex items-center px-6 py-3 rounded-full text-lg font-semibold mb-4">
                        🔴 Terisi
                    </div>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Sedang Digunakan</h3>
                <p class="text-gray-600">Laboratorium sedang digunakan atau dikunjungi oleh tamu</p>
            </div>
            
            <!-- Status Hampir Selesai -->
            <div class="text-center group">
                <div class="bg-gradient-to-br from-yellow-100 to-yellow-50 rounded-2xl p-8 mb-6 group-hover:shadow-lg transition-all duration-300">
                    <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-2xl flex items-center justify-center">
                        <i class="fas fa-clock text-white text-2xl"></i>
                    </div>
                    <div class="status-hampir-selesai inline-flex items-center px-6 py-3 rounded-full text-lg font-semibold mb-4">
                        🟡 Hampir Selesai
                    </div>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Hampir Tersedia</h3>
                <p class="text-gray-600">Kegiatan hampir berakhir, laboratorium akan segera tersedia</p>
            </div>
        </div>
    </div>
</section>

<!-- Lab Status Grid dengan Spacing yang Baik -->
<section class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-navy mb-4">Status Laboratorium Real-time</h2>
            <p class="text-gray-600 text-lg">Klik pada kartu untuk melihat detail laboratorium</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="labs-container">
            @foreach($labs as $lab)
            <div class="group" data-lab-id="{{ $lab->id }}">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover border border-gray-100">
                    <!-- Lab Header dengan Gradient -->
                    <div class="bg-gradient-to-r from-light-blue to-medium-blue p-6 text-white">
                        <div class="flex items-center justify-between mb-3">
                            <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center">
                                <i class="fas fa-flask text-white text-xl"></i>
                            </div>
                            <div class="status-badge {{ strtolower(str_replace(' ', '-', $lab->status->name)) }}">
                                @if($lab->status->name === 'Kosong')
                                    <i class="fas fa-check-circle mr-2"></i>
                                @elseif($lab->status->name === 'Terisi')
                                    <i class="fas fa-users mr-2"></i>
                                @else
                                    <i class="fas fa-clock mr-2"></i>
                                @endif
                                {{ $lab->status->name }}
                            </div>
                        </div>
                        
                        <h3 class="text-xl font-bold mb-2">{{ $lab->name }}</h3>
                        <p class="text-blue-100 flex items-center">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            {{ $lab->location }}
                        </p>
                    </div>
                    
                    <!-- Lab Content -->
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-user-friends mr-2 text-medium-blue"></i>
                                <span class="font-medium">Kapasitas: {{ $lab->capacity }} orang</span>
                            </div>
                        </div>
                        
                        @if($lab->description)
                        <p class="text-gray-600 mb-4 line-clamp-2">
                            {{ Str::limit($lab->description, 100) }}
                        </p>
                        @endif
                        
                        <!-- Timestamp -->
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-sync-alt mr-2"></i>
                                <span class="update-time">{{ $lab->updated_at->format('H:i:s') }}</span>
                            </div>
                            
                            <!-- Status Indicator Dot -->
                            <div class="flex items-center">
                                <div class="w-3 h-3 rounded-full mr-2
                                    @if($lab->status->name === 'Kosong') bg-green-500
                                    @elseif($lab->status->name === 'Terisi') bg-red-500
                                    @else bg-yellow-500
                                    @endif
                                "></div>
                                <span class="text-sm font-medium text-gray-700">{{ $lab->status->name }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @if($labs->isEmpty())
        <div class="text-center py-16">
            <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                <i class="fas fa-microscope text-gray-400 text-3xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Belum Ada Laboratorium</h3>
            <p class="text-gray-600 mb-8 max-w-md mx-auto">
                Data laboratorium akan ditampilkan di sini setelah admin menambahkan laboratorium ke sistem.
            </p>
            @auth
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center bg-gradient-to-r from-medium-blue to-dark-blue text-white px-6 py-3 rounded-xl hover:shadow-lg transition-all duration-200 font-medium">
                <i class="fas fa-plus mr-2"></i>
                Tambah Laboratorium
            </a>
            @endauth
        </div>
        @endif
    </div>
</section>

<!-- Auto Refresh Button dengan Design Modern -->
<div class="fixed bottom-6 right-6 z-40">
    <button type="button" class="bg-gradient-to-r from-medium-blue to-dark-blue text-white w-14 h-14 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-110 group" id="refresh-btn" title="Refresh Status">
        <i class="fas fa-sync-alt text-lg group-hover:rotate-180 transition-transform duration-300"></i>
    </button>
</div>

<!-- Toast Notification Container -->
<div id="toast-container" class="fixed top-20 right-6 z-50 space-y-4"></div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    let autoRefresh = true;
    let refreshInterval;

    // Auto refresh every 30 seconds
    function startAutoRefresh() {
        refreshInterval = setInterval(function() {
            if (autoRefresh) {
                refreshLabStatus();
            }
        }, 30000);
    }

    // Manual refresh
    $('#refresh-btn').click(function() {
        refreshLabStatus();
        showToast('Memperbarui status laboratorium...', 'info');
    });

    // Toggle auto refresh when page visibility changes
    document.addEventListener('visibilitychange', function() {
        if (document.hidden) {
            autoRefresh = false;
        } else {
            autoRefresh = true;
            refreshLabStatus();
        }
    });

    function refreshLabStatus() {
        const refreshBtn = $('#refresh-btn');
        const icon = refreshBtn.find('i');
        
        // Show loading animation
        icon.addClass('fa-spin');
        
        $.get('{{ route("api.lab-status") }}')
            .done(function(data) {
                updateLabsDisplay(data.labs);
                updateStats(data.labs);
                $('#update-time').text(new Date().toLocaleTimeString('id-ID'));
                
                // Remove loading animation
                icon.removeClass('fa-spin');
                
                showToast('Status laboratorium berhasil diperbarui!', 'success');
            })
            .fail(function() {
                icon.removeClass('fa-spin');
                showToast('Gagal memperbarui status. Silakan coba lagi.', 'error');
            });
    }

    function updateLabsDisplay(labs) {
        labs.forEach(function(lab) {
            const labCard = $(`[data-lab-id="${lab.id}"]`);
            if (labCard.length) {
                // Update status badge
                const statusBadge = labCard.find('.status-badge');
                statusBadge.removeClass('status-kosong status-terisi status-hampir-selesai');
                statusBadge.addClass('status-' + lab.status.name.toLowerCase().replace(' ', '-'));
                
                // Update status text and icon
                let icon = 'fas fa-check-circle';
                if (lab.status.name === 'Terisi') {
                    icon = 'fas fa-users';
                } else if (lab.status.name === 'Hampir Selesai') {
                    icon = 'fas fa-clock';
                }
                
                statusBadge.html(`<i class="${icon} mr-2"></i> ${lab.status.name}`);
                
                // Update status dot
                const statusDot = labCard.find('.w-3.h-3.rounded-full');
                statusDot.removeClass('bg-green-500 bg-red-500 bg-yellow-500');
                if (lab.status.name === 'Kosong') {
                    statusDot.addClass('bg-green-500');
                } else if (lab.status.name === 'Terisi') {
                    statusDot.addClass('bg-red-500');
                } else {
                    statusDot.addClass('bg-yellow-500');
                }
                
                // Update timestamp
                labCard.find('.update-time').text(lab.updated_at);
                
                // Add subtle animation
                labCard.addClass('ring-2 ring-blue-200').delay(1500).queue(function() {
                    $(this).removeClass('ring-2 ring-blue-200').dequeue();
                });
            }
        });
    }

    function updateStats(labs) {
        const total = labs.length;
        const available = labs.filter(lab => lab.status.name === 'Kosong').length;
        const occupied = labs.filter(lab => lab.status.name === 'Terisi').length;
        
        $('#total-labs').text(total);
        $('#available-labs').text(available);
        $('#occupied-labs').text(occupied);
    }

    function showToast(message, type) {
        const toastColors = {
            'success': 'bg-green-500',
            'error': 'bg-red-500',
            'info': 'bg-blue-500'
        };
        
        const toastIcons = {
            'success': 'fas fa-check-circle',
            'error': 'fas fa-exclamation-circle',
            'info': 'fas fa-info-circle'
        };
        
        const toast = $(`
            <div class="toast ${toastColors[type]} text-white px-6 py-4 rounded-xl shadow-lg transform translate-x-full transition-transform duration-300">
                <div class="flex items-center">
                    <i class="${toastIcons[type]} mr-3"></i>
                    <span>${message}</span>
                </div>
            </div>
        `);
        
        $('#toast-container').append(toast);
        
        // Animate in
        setTimeout(() => {
            toast.removeClass('translate-x-full');
        }, 100);
        
        // Animate out and remove
        setTimeout(() => {
            toast.addClass('translate-x-full');
            setTimeout(() => {
                toast.remove();
            }, 300);
        }, 3000);
    }

    // Start auto refresh
    startAutoRefresh();

    // Add entrance animations
    $('.card-hover').each(function(index) {
        $(this).css({
            'animation-delay': (index * 0.1) + 's',
            'animation-fill-mode': 'both'
        }).addClass('animate-slide-up');
    });
});
</script>
@endsection
