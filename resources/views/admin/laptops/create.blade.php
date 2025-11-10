@extends('layouts.app')
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Tambah Laptop Baru</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.laptops.index') }}">Manajemen
                    Laptop</a></li>
            <li class="breadcrumb-item active">Tambah Baru</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                Formulir Tambah Laptop
            </div>
            <div class="card-body">
                {{-- Tampilkan error validasi --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('admin.laptops.store') }}">
                    @csrf
                    {{-- Merk --}}
                    <div class="mb-3">
                        <label for="merk" class="form-label">Merk Laptop</label>
                        <input type="text" class="form-control @error('merk') is-invalid @enderror" id="merk"
                            name="merk" value="{{ old('merk') }}" required autofocus>
                        @error('merk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- Spesifikasi --}}
                    <div class="mb-3">
                        <label for="spesifikasi" class="form-label">Spesifikasi</label>
                        <input type="text" class="form-control @error('spesifikasi') is-invalid @enderror"
                            id="spesifikasi" name="spesifikasi" value="{{ old('spesifikasi') }}" required>
                        @error('spesifikasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- Tahun Pengadaan --}}
                    <div class="mb-3">
                        <label for="tahun_pengadaan" class="form-label">Tahun Pengadaan</label>
                        <input type="number" class="form-control @error('tahun_pengadaan') is-invalid @enderror"
                            id="tahun_pengadaan" name="tahun_pengadaan" value="{{ old('tahun_pengadaan') }}" required>
                        @error('tahun_pengadaan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- Tombol --}}
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.laptops.index') }}" class="btn btn-secondary me2">
                            Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
