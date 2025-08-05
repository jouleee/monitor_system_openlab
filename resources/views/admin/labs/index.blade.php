@extends('layouts.app')

@section('title', 'Kelola Laboratorium - Admin Dashboard')

@section('content')
<div class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="display-6 fw-bold mb-2">
                    <i class="fas fa-list me-3"></i>
                    Kelola Laboratorium
                </h1>
                <p class="lead mb-0">Daftar semua laboratorium dalam sistem</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="{{ route('admin.labs.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>
                    Tambah Lab Baru
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card status-card">
        <div class="card-body">
            @if($labs->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nama Lab</th>
                                <th>Lokasi</th>
                                <th>Kapasitas</th>
                                <th>Status</th>
                                <th>Terakhir Diperbarui</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($labs as $lab)
                            <tr>
                                <td>
                                    <i class="fas fa-flask me-2 text-primary"></i>
                                    {{ $lab->name }}
                                </td>
                                <td>
                                    <i class="fas fa-map-marker-alt me-1 text-muted"></i>
                                    {{ $lab->location }}
                                </td>
                                <td>
                                    <i class="fas fa-users me-1 text-muted"></i>
                                    {{ $lab->capacity }} orang
                                </td>
                                <td>
                                    <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $lab->status->name)) }}">
                                        {{ $lab->status->name }}
                                    </span>
                                </td>
                                <td>
                                    <small class="text-muted">
                                        {{ $lab->updated_at->format('d/m/Y H:i') }}
                                    </small>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.labs.edit', $lab) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.labs.destroy', $lab) }}" method="POST" class="d-inline" 
                                              onsubmit="return confirm('Yakin hapus lab {{ $lab->name }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-microscope fa-4x text-muted mb-4"></i>
                    <h4 class="text-muted mb-3">Belum Ada Laboratorium</h4>
                    <p class="text-muted mb-4">Mulai dengan menambahkan laboratorium pertama.</p>
                    <a href="{{ route('admin.labs.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>
                        Tambah Laboratorium Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
