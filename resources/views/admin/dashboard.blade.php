@extends('layouts.app')

@section('title', 'Admin Dashboard - OpenLab FPMIPA UPI 2025')

@section('content')
<!-- Hero Section untuk Admin -->
<section class="bg-gradient-to-br from-blue-600 via-blue-700 to-blue-800 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="flex flex-col lg:flex-row items-center justify-between">
            <!-- Welcome Text -->
            <div class="text-center lg:text-left mb-8 lg:mb-0">
                <div class="flex items-center justify-center lg:justify-start mb-4">
                    <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center mr-4">
                        <i class="fas fa-cogs text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl lg:text-4xl font-bold">Admin Dashboard</h1>
                        <p class="text-blue-100 text-lg">Kelola status laboratorium secara real-time</p>
                    </div>
                </div>
            </div>
            
            <!-- Quick Actions -->
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="{{ route('admin.labs.create') }}" class="bg-white text-blue-700 hover:bg-blue-50 px-6 py-3 rounded-xl font-semibold transition-all duration-200 flex items-center justify-center shadow-lg hover:shadow-xl">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Lab Baru
                </a>
                <button onclick="refreshAllStatus()" class="bg-blue-500 hover:bg-blue-400 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-200 flex items-center justify-center shadow-lg hover:shadow-xl">
                    <i class="fas fa-sync-alt mr-2" id="refresh-icon"></i>
                    Refresh Semua
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Stats Overview -->
<section class="bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-gray-800 text-center mb-8">Overview Status Laboratorium</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <!-- Total Labs -->
            <div class="stats-card bg-white rounded-2xl shadow-lg p-6 border-l-4 border-blue-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Total Laboratorium</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $labs->count() }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-microscope text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>
            
            <!-- Available Labs -->
            <div class="stats-card bg-white rounded-2xl shadow-lg p-6 border-l-4 border-green-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Lab Tersedia</p>
                        <p class="text-3xl font-bold text-green-600">{{ $labs->where('status.name', 'Kosong')->count() }}</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>
            
            <!-- Occupied Labs -->
            <div class="stats-card bg-white rounded-2xl shadow-lg p-6 border-l-4 border-red-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Lab Terisi</p>
                        <p class="text-3xl font-bold text-red-600">{{ $labs->where('status.name', 'Terisi')->count() }}</p>
                    </div>
                    <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-users text-red-600 text-xl"></i>
                    </div>
                </div>
            </div>
            
            <!-- Almost Done Labs -->
            <div class="stats-card bg-white rounded-2xl shadow-lg p-6 border-l-4 border-yellow-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Hampir Selesai</p>
                        <p class="text-3xl font-bold text-yellow-600">{{ $labs->where('status.name', 'Hampir Selesai')->count() }}</p>
                    </div>
                    <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-clock text-yellow-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Success Message -->
@if(session('success'))
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6">
    <div class="bg-green-50 border border-green-200 rounded-xl p-4 flex items-center">
        <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
        <div>
            <p class="text-green-800 font-medium">{{ session('success') }}</p>
        </div>
        <button onclick="this.parentElement.style.display='none'" class="ml-auto text-green-400 hover:text-green-600">
            <i class="fas fa-times"></i>
        </button>
    </div>
</div>
@endif

<!-- Labs Management Section -->
<section class="bg-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-8">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Manajemen Status Laboratorium</h2>
                <p class="text-gray-600">Klik tombol status untuk mengubah status laboratorium secara real-time</p>
            </div>
        </div>
        
        @if($labs->count() > 0)
        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-8">
            @foreach($labs as $lab)
            <div class="bg-white border border-gray-200 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden" data-lab-id="{{ $lab->id }}">
                <!-- Lab Header -->
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center mr-4">
                                <i class="fas fa-flask text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold">{{ $lab->name }}</h3>
                                <p class="text-blue-100 flex items-center mt-1">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    {{ $lab->location }}
                                </p>
                            </div>
                        </div>
                        
                        <!-- Dropdown Menu -->
                        <div class="relative">
                            <button class="text-white hover:text-blue-200 p-2 rounded-lg hover:bg-white hover:bg-opacity-10 transition-all duration-200" onclick="toggleDropdown('{{ $lab->id }}')">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div id="dropdown-{{ $lab->id }}" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-100 z-10">
                                <div class="py-2">
                                    <a href="{{ route('admin.labs.edit', $lab) }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-50 hover:text-blue-600 transition-colors duration-200">
                                        <i class="fas fa-edit mr-2"></i>Edit Lab
                                    </a>
                                    <hr class="my-1 border-gray-100">
                                    <form action="{{ route('admin.labs.destroy', $lab) }}" method="POST" class="block" onsubmit="return confirm('Yakin hapus lab {{ $lab->name }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50 transition-colors duration-200">
                                            <i class="fas fa-trash mr-2"></i>Hapus Lab
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Current Status -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <span class="text-blue-100 text-sm mr-2">Status saat ini:</span>
                            <div class="current-status-display px-3 py-1 rounded-full text-sm font-semibold 
                                @if($lab->status->name === 'Kosong') bg-green-500 text-white
                                @elseif($lab->status->name === 'Terisi') bg-red-500 text-white  
                                @else bg-yellow-500 text-gray-900
                                @endif
                            ">
                                {{ $lab->status->name }}
                            </div>
                        </div>
                        <div class="text-blue-100 text-sm">
                            <i class="fas fa-users mr-1"></i>{{ $lab->capacity }} orang
                        </div>
                    </div>
                </div>
                
                <!-- Lab Content -->
                <div class="p-6">
                    <!-- Lab Description -->
                    @if($lab->description)
                    <div class="mb-6">
                        <p class="text-gray-600 text-sm leading-relaxed">{{ $lab->description }}</p>
                    </div>
                    @endif
                    
                    <!-- Status Control -->
                    <div class="mb-6">
                        <h4 class="text-gray-800 font-semibold mb-4 flex items-center">
                            <i class="fas fa-sliders-h mr-2 text-blue-500"></i>
                            Ubah Status:
                        </h4>
                        <div class="grid grid-cols-1 gap-3">
                            @foreach($statuses as $status)
                            <!-- Form untuk testing -->
                            <form action="{{ route('admin.labs.update-status', $lab) }}" method="POST" class="status-form" data-lab-id="{{ $lab->id }}" data-status-id="{{ $status->id }}" data-status-name="{{ $status->name }}">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status_id" value="{{ $status->id }}">
                                <input type="hidden" name="notes" value="Status diubah menjadi {{ $status->name }} oleh admin">
                                
                                <button 
                                    type="button" 
                                    class="status-btn w-full text-left px-4 py-3 rounded-xl font-medium transition-all duration-200 flex items-center justify-between
                                        @if($status->name === 'Kosong') 
                                            {{ $lab->status_id === $status->id ? 'bg-green-500 text-white' : 'bg-green-50 text-green-700 hover:bg-green-100 border-2 border-green-200' }}
                                        @elseif($status->name === 'Terisi') 
                                            {{ $lab->status_id === $status->id ? 'bg-red-500 text-white' : 'bg-red-50 text-red-700 hover:bg-red-100 border-2 border-red-200' }}
                                        @else 
                                            {{ $lab->status_id === $status->id ? 'bg-yellow-500 text-gray-900' : 'bg-yellow-50 text-yellow-700 hover:bg-yellow-100 border-2 border-yellow-200' }}
                                        @endif
                                        {{ $lab->status_id === $status->id ? 'cursor-not-allowed' : 'hover:scale-105' }}
                                    "
                                    data-lab-id="{{ $lab->id }}"
                                    data-status-id="{{ $status->id }}"
                                    data-status-name="{{ $status->name }}"
                                    {{ $lab->status_id === $status->id ? 'disabled' : '' }}
                                    onclick="updateLabStatusWithForm(this)"
                                >
                                    <div class="flex items-center">
                                        @if($status->name === 'Kosong')
                                            <i class="fas fa-check-circle mr-3"></i>
                                        @elseif($status->name === 'Terisi')
                                            <i class="fas fa-users mr-3"></i>
                                        @else
                                            <i class="fas fa-clock mr-3"></i>
                                        @endif
                                        <span>{{ $status->name }}</span>
                                    </div>
                                    @if($lab->status_id === $status->id)
                                        <i class="fas fa-check text-sm"></i>
                                    @endif
                                </button>
                            </form>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Last Update -->
                    <div class="pt-4 border-t border-gray-100">
                        <div class="flex items-center justify-between text-sm text-gray-500">
                            <div class="flex items-center">
                                <i class="fas fa-clock mr-2"></i>
                                <span>Terakhir diperbarui:</span>
                            </div>
                            <span class="font-medium last-update-time">{{ $lab->updated_at->format('d/m/Y H:i:s') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <!-- Empty State -->
        <div class="text-center py-16">
            <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                <i class="fas fa-microscope text-gray-400 text-3xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Belum Ada Laboratorium</h3>
            <p class="text-gray-600 mb-8 max-w-md mx-auto">
                Mulai dengan menambahkan laboratorium pertama untuk sistem monitoring.
            </p>
            <a href="{{ route('admin.labs.create') }}" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-xl font-semibold transition-all duration-200 shadow-lg hover:shadow-xl">
                <i class="fas fa-plus mr-2"></i>
                Tambah Laboratorium Pertama
            </a>
        </div>
        @endif
    </div>
</section>

<!-- Toast Container -->
<div id="toast-container" class="fixed top-20 right-6 z-50 space-y-4"></div>
@endsection

@section('scripts')
<script>
// Global variables
let isUpdating = false;

function updateLabStatusWithForm(button) {
    if (isUpdating) return;
    if (button.disabled) return;
    
    isUpdating = true;
    const form = button.closest('form');
    if (!form) {
        console.error('Form not found');
        isUpdating = false;
        return;
    }
    
    const labId = form.getAttribute('data-lab-id');
    const statusId = form.getAttribute('data-status-id');
    const statusName = form.getAttribute('data-status-name');
    
    console.log('Updating with form:', {labId, statusId, statusName});
    
    const labCard = document.querySelector(`[data-lab-id="${labId}"]`);
    if (!labCard) {
        console.error('Lab card not found');
        isUpdating = false;
        return;
    }
    
    const statusButtons = labCard.querySelectorAll('.status-btn');
    
    // Disable all buttons and show loading
    statusButtons.forEach(btn => {
        btn.disabled = true;
        btn.classList.add('opacity-50');
    });
    
    const originalContent = button.innerHTML;
    button.innerHTML = '<div class="flex items-center"><i class="fas fa-spinner fa-spin mr-3"></i><span>Memperbarui...</span></div>';
    
    // Create FormData
    const formData = new FormData(form);
    
    // Make AJAX request using FormData
    fetch(form.action, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: formData
    })
    .then(response => {
        console.log('Response status:', response.status);
        
        if (!response.ok) {
            return response.text().then(text => {
                console.error('Error response body:', text);
                throw new Error(`HTTP error! status: ${response.status}`);
            });
        }
        return response.json();
    })
    .then(data => {
        console.log('Success response:', data);
        if (data.success) {
            // Update UI
            updateLabCardStatus(labId, statusId, statusName);
            showToast('Status laboratorium berhasil diperbarui!', 'success');
            
            // Close dropdown if open
            closeDropdown(labId);
            
            // Update stats overview with delay to ensure DOM is updated
            setTimeout(() => {
                updateStatsOverview();
            }, 100);
        } else {
            throw new Error(data.message || 'Gagal memperbarui status');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast(`Gagal memperbarui status: ${error.message}`, 'error');
        
        // Restore original button content
        button.innerHTML = originalContent;
    })
    .finally(() => {
        // Re-enable all buttons and remove loading state
        statusButtons.forEach(btn => {
            const btnForm = btn.closest('form');
            const btnStatusId = btnForm ? btnForm.getAttribute('data-status-id') : null;
            
            // Only enable buttons that are not the current active status
            if (btnStatusId != statusId) {
                btn.disabled = false;
            }
            btn.classList.remove('opacity-50');
        });
        
        // Ensure the clicked button is properly restored if update failed
        if (button.innerHTML.includes('fa-spinner')) {
            button.innerHTML = originalContent;
        }
        
        isUpdating = false;
    });
}

function updateLabStatus(labId, statusId, statusName) {
    if (isUpdating) return;
    
    isUpdating = true;
    const labCard = document.querySelector(`[data-lab-id="${labId}"]`);
    const statusButtons = labCard.querySelectorAll('.status-btn');
    const clickedButton = labCard.querySelector(`[data-status-id="${statusId}"]`);
    
    console.log('Updating lab status:', {labId, statusId, statusName});
    
    // Disable all buttons and show loading
    statusButtons.forEach(btn => {
        btn.disabled = true;
        btn.classList.add('opacity-50');
    });
    
    const originalContent = clickedButton.innerHTML;
    clickedButton.innerHTML = '<div class="flex items-center"><i class="fas fa-spinner fa-spin mr-3"></i><span>Memperbarui...</span></div>';
    
    // Make AJAX request
    const requestData = {
        status_id: parseInt(statusId),
        notes: `Status diubah menjadi ${statusName} oleh admin`
    };
    
    console.log('Request data:', requestData);
    
    fetch(`/admin/labs/${labId}/status`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify(requestData)
    })
    .then(response => {
        console.log('Response status:', response.status);
        console.log('Response headers:', response.headers);
        
        if (!response.ok) {
            return response.text().then(text => {
                console.error('Error response body:', text);
                throw new Error(`HTTP error! status: ${response.status} - ${text}`);
            });
        }
        return response.json();
    })
    .then(data => {
        console.log('Success response:', data);
        if (data.success) {
            // Update UI
            updateLabCardStatus(labId, statusId, statusName);
            showToast('Status laboratorium berhasil diperbarui!', 'success');
            
            // Close dropdown if open
            closeDropdown(labId);
            
            // Update stats overview
            updateStatsOverview();
        } else {
            throw new Error(data.message || 'Gagal memperbarui status');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast(`Gagal memperbarui status: ${error.message}`, 'error');
        
        // Restore original button content
        clickedButton.innerHTML = originalContent;
    })
    .finally(() => {
        // Re-enable all buttons
        statusButtons.forEach(btn => {
            btn.disabled = false;
            btn.classList.remove('opacity-50');
        });
        
        isUpdating = false;
    });
}

function updateLabCardStatus(labId, statusId, statusName) {
    const labCard = document.querySelector(`[data-lab-id="${labId}"]`);
    if (!labCard) {
        console.error('Lab card not found for ID:', labId);
        return;
    }
    
    // Update current status display
    const statusDisplay = labCard.querySelector('.current-status-display');
    if (statusDisplay) {
        statusDisplay.className = 'current-status-display px-3 py-1 rounded-full text-sm font-semibold';
        
        if (statusName === 'Kosong') {
            statusDisplay.classList.add('bg-green-500', 'text-white');
        } else if (statusName === 'Terisi') {
            statusDisplay.classList.add('bg-red-500', 'text-white');
        } else {
            statusDisplay.classList.add('bg-yellow-500', 'text-gray-900');
        }
        statusDisplay.textContent = statusName;
    }
    
    // Update status buttons in forms
    const statusForms = labCard.querySelectorAll('.status-form');
    statusForms.forEach(form => {
        const btn = form.querySelector('.status-btn');
        if (!btn) return;
        
        const btnStatusId = form.getAttribute('data-status-id');
        const btnStatusName = form.getAttribute('data-status-name');
        
        // Reset button classes
        btn.className = 'status-btn w-full text-left px-4 py-3 rounded-xl font-medium transition-all duration-200 flex items-center justify-between';
        
        if (btnStatusId == statusId) {
            // This is the active status
            btn.disabled = true;
            btn.classList.add('cursor-not-allowed');
            
            if (btnStatusName === 'Kosong') {
                btn.classList.add('bg-green-500', 'text-white');
            } else if (btnStatusName === 'Terisi') {
                btn.classList.add('bg-red-500', 'text-white');
            } else {
                btn.classList.add('bg-yellow-500', 'text-gray-900');
            }
            
            // Restore original content with check icon
            btn.innerHTML = `
                <div class="flex items-center">
                    ${btnStatusName === 'Kosong' ? '<i class="fas fa-check-circle mr-3"></i>' : 
                      btnStatusName === 'Terisi' ? '<i class="fas fa-users mr-3"></i>' : 
                      '<i class="fas fa-clock mr-3"></i>'}
                    <span>${btnStatusName}</span>
                </div>
                <i class="fas fa-check text-sm"></i>
            `;
        } else {
            // This is an inactive status
            btn.disabled = false;
            btn.classList.add('hover:scale-105');
            
            if (btnStatusName === 'Kosong') {
                btn.classList.add('bg-green-50', 'text-green-700', 'hover:bg-green-100', 'border-2', 'border-green-200');
            } else if (btnStatusName === 'Terisi') {
                btn.classList.add('bg-red-50', 'text-red-700', 'hover:bg-red-100', 'border-2', 'border-red-200');
            } else {
                btn.classList.add('bg-yellow-50', 'text-yellow-700', 'hover:bg-yellow-100', 'border-2', 'border-yellow-200');
            }
            
            // Restore original content without check icon
            btn.innerHTML = `
                <div class="flex items-center">
                    ${btnStatusName === 'Kosong' ? '<i class="fas fa-check-circle mr-3"></i>' : 
                      btnStatusName === 'Terisi' ? '<i class="fas fa-users mr-3"></i>' : 
                      '<i class="fas fa-clock mr-3"></i>'}
                    <span>${btnStatusName}</span>
                </div>
            `;
        }
    });
    
    // Update timestamp
    const timestampElement = labCard.querySelector('.last-update-time');
    if (timestampElement) {
        const now = new Date();
        const formattedTime = now.toLocaleDateString('id-ID') + ' ' + now.toLocaleTimeString('id-ID');
        timestampElement.textContent = formattedTime;
    }
    
    // Add visual feedback
    labCard.classList.add('ring-4', 'ring-blue-200');
    setTimeout(() => {
        labCard.classList.remove('ring-4', 'ring-blue-200');
    }, 2000);
    
    console.log('Lab card updated successfully for:', {labId, statusId, statusName});
}

function toggleDropdown(labId) {
    const dropdown = document.getElementById(`dropdown-${labId}`);
    const isHidden = dropdown.classList.contains('hidden');
    
    // Close all other dropdowns
    document.querySelectorAll('[id^="dropdown-"]').forEach(dd => {
        dd.classList.add('hidden');
    });
    
    // Toggle current dropdown
    if (isHidden) {
        dropdown.classList.remove('hidden');
    }
}

function closeDropdown(labId) {
    const dropdown = document.getElementById(`dropdown-${labId}`);
    dropdown.classList.add('hidden');
}

function refreshAllStatus() {
    const refreshIcon = document.getElementById('refresh-icon');
    refreshIcon.classList.add('fa-spin');
    
    // Simulate refresh
    setTimeout(() => {
        refreshIcon.classList.remove('fa-spin');
        showToast('Status semua laboratorium berhasil diperbarui!', 'success');
        location.reload();
    }, 1500);
}

function updateStatsOverview() {
    // Update stats counters based on current lab statuses
    const labCards = document.querySelectorAll('[data-lab-id]');
    let kosongCount = 0;
    let terisiCount = 0;
    let hampirSelesaiCount = 0;
    
    labCards.forEach(card => {
        const statusDisplay = card.querySelector('.current-status-display');
        if (statusDisplay) {
            const status = statusDisplay.textContent.trim();
            
            if (status === 'Kosong') kosongCount++;
            else if (status === 'Terisi') terisiCount++;
            else if (status === 'Hampir Selesai') hampirSelesaiCount++;
        }
    });
    
    console.log('Updated counts:', {kosongCount, terisiCount, hampirSelesaiCount});
    
    // Update the stats cards by targeting specific elements
    const availableLabsElement = document.querySelector('.stats-card:nth-child(2) .text-3xl');
    const occupiedLabsElement = document.querySelector('.stats-card:nth-child(3) .text-3xl');
    const almostDoneLabsElement = document.querySelector('.stats-card:nth-child(4) .text-3xl');
    
    if (availableLabsElement) {
        availableLabsElement.textContent = kosongCount;
        availableLabsElement.classList.add('text-green-600');
    }
    
    if (occupiedLabsElement) {
        occupiedLabsElement.textContent = terisiCount;
        occupiedLabsElement.classList.add('text-red-600');
    }
    
    if (almostDoneLabsElement) {
        almostDoneLabsElement.textContent = hampirSelesaiCount;
        almostDoneLabsElement.classList.add('text-yellow-600');
    }
}

function showToast(message, type) {
    const toastContainer = document.getElementById('toast-container');
    const toastId = 'toast-' + Date.now();
    
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
    
    const toast = document.createElement('div');
    toast.id = toastId;
    toast.className = `${toastColors[type]} text-white px-6 py-4 rounded-xl shadow-lg transform translate-x-full transition-transform duration-300`;
    toast.innerHTML = `
        <div class="flex items-center">
            <i class="${toastIcons[type]} mr-3"></i>
            <span>${message}</span>
        </div>
    `;
    
    toastContainer.appendChild(toast);
    
    // Animate in
    setTimeout(() => {
        toast.classList.remove('translate-x-full');
    }, 100);
    
    // Animate out and remove
    setTimeout(() => {
        toast.classList.add('translate-x-full');
        setTimeout(() => {
            toast.remove();
        }, 300);
    }, 4000);
}

// Close dropdowns when clicking outside
document.addEventListener('click', function(event) {
    if (!event.target.closest('[onclick^="toggleDropdown"]') && !event.target.closest('[id^="dropdown-"]')) {
        document.querySelectorAll('[id^="dropdown-"]').forEach(dropdown => {
            dropdown.classList.add('hidden');
        });
    }
});

// Auto refresh every 2 minutes
setInterval(() => {
    if (!isUpdating) {
        refreshAllStatus();
    }
}, 120000);

// Initialize stats on page load
document.addEventListener('DOMContentLoaded', function() {
    console.log('Page loaded, initializing stats...');
    updateStatsOverview();
});
</script>
@endsection
