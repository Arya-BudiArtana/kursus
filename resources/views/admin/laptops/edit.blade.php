@extends('layouts.app')
@section('content')
    <div class="px-4 container-fluid">
        <h1 class="mt-4">Edit Laptop</h1>
        <ol class="mb-4 breadcrumb">
            <li class="breadcrumb-item"><a href=
"{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href=
"{{ route('admin.laptop.index') }}">
                    Manajemen Laptop</a></li>
            <li class="breadcrumb-item active">Edit Data</li>
        </ol>
        <div class="mb-4 card">
            <div class="card-header">
                Formulir Edit Laptop
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
                <form method="POST" action=
"{{ route('admin.laptop.update', $data->id) }}">
                    @csrf
                    @method('PUT') {{-- Method spoofing untuk update --}}
                    {{-- Merk --}}
                    <div class="mb-3">
                        <label for="merk" class="form-label">Merk Laptop</label>
                        <input type="text" class="form-control @error('merk') is-invalid @enderror" id="merk"
                            name="merk" value=
"{{ old('merk', $data->merk) }}" required autofocus>
                        @error('merk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- Spesifikasi --}}
                    <div class="mb-3">
                        <label for="spesifikasi" class="form-label">Spesifikasi</label>
                        <input type="text" class="form-control @error('spesifikasi') is-invalid @enderror"
                            id="spesifikasi" name="spesifikasi" value=
"{{ old('spesifikasi', $data->spesifikasi) }}"
                            required>
                        @error('spesifikasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- Tahun Pengadaan --}}
                    <div class="mb-3">
                        <label for="tahun_pengadaan" class="form-label">Tahun Pengadaan</label>
                        <input type="number" class="form-control @error('tahun_pengadaan') is-invalid
@enderror"
                            id="tahun_pengadaan" name="tahun_pengadaan"
                            value=
"{{ old('tahun_pengadaan', $data->tahun_pengadaan) }}" required>
                        @error('tahun_pengadaan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- Status (HANYA MUNCUL DI SINI) --}}
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                            <option value="1" @selected(old('status', $data->status) == '1')>Available</option>
                            <option value="2" @selected(old('status', $data->status) == '2')>Borrowed</option>
                            <option value="3" @selected(old('status', $data->status) == '3')>Maintenance</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- Tombol --}}
                    <div class="d-flex justify-content-end">
                        <a href=
"{{ route('admin.laptop.index') }}" class="btn btn-secondary me- 2">Batal</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
