@extends('layouts.app')

@section('title', 'Edit Laboratorium - Admin Dashboard')

@section('content')
<div class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="display-6 fw-bold mb-2">
                    <i class="fas fa-edit me-3"></i>
                    Edit Laboratorium
                </h1>
                <p class="lead mb-0">Perbarui informasi laboratorium {{ $lab->name }}</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-light">
                    <i class="fas fa-arrow-left me-2"></i>
                    Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card status-card">
                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.labs.update', $lab) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="name" class="form-label fw-semibold">
                                    <i class="fas fa-flask me-2"></i>Nama Laboratorium
                                </label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    id="name" 
                                    name="name" 
                                    value="{{ old('name', $lab->name) }}" 
                                    required
                                    placeholder="Lab Kimia Organik"
                                >
                            </div>
                            
                            <div class="col-md-6 mb-4">
                                <label for="location" class="form-label fw-semibold">
                                    <i class="fas fa-map-marker-alt me-2"></i>Lokasi
                                </label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    id="location" 
                                    name="location" 
                                    value="{{ old('location', $lab->location) }}" 
                                    required
                                    placeholder="Gedung A, Lantai 2"
                                >
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="capacity" class="form-label fw-semibold">
                                    <i class="fas fa-users me-2"></i>Kapasitas (orang)
                                </label>
                                <input 
                                    type="number" 
                                    class="form-control" 
                                    id="capacity" 
                                    name="capacity" 
                                    value="{{ old('capacity', $lab->capacity) }}" 
                                    required
                                    min="1"
                                    placeholder="20"
                                >
                            </div>
                            
                            <div class="col-md-6 mb-4">
                                <label for="status_id" class="form-label fw-semibold">
                                    <i class="fas fa-circle me-2"></i>Status
                                </label>
                                <select class="form-select" id="status_id" name="status_id" required>
                                    @foreach($statuses as $status)
                                    <option value="{{ $status->id }}" {{ old('status_id', $lab->status_id) == $status->id ? 'selected' : '' }}>
                                        {{ $status->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="description" class="form-label fw-semibold">
                                <i class="fas fa-info-circle me-2"></i>Deskripsi (Opsional)
                            </label>
                            <textarea 
                                class="form-control" 
                                id="description" 
                                name="description" 
                                rows="3"
                                placeholder="Deskripsi singkat tentang laboratorium ini..."
                            >{{ old('description', $lab->description) }}</textarea>
                        </div>
                        
                        <div class="text-end">
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary me-2">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Perbarui Laboratorium
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
