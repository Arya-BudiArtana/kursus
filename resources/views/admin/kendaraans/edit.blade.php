@extends('layouts.app')

@section('content')
    <div class="px-4 container-fluid">
        <h1 class="mt-4">Edit Kendaraan</h1>
        <ol class="mb-4 breadcrumb">
            <li class="breadcrumb-item"><a href=
"{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href=
"{{ route('admin.kendaraans.index') }}">Manajemen
                    Kendaraan</a></li>
            <li class="breadcrumb-item active">Edit Data</li>
        </ol>
        <div class="mb-4 card">
            <div class="card-header">
                Formulir Edit Kendaraan
            </div>
            <div class="card-body">
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
"{{ route('admin.kendaraans.update', $kendaraan->id) }}">
                    @csrf
                    @method('PUT')
                    {{-- Tipe Kendaraan --}}
                    <div class="mb-3">
                        <label for="type_kendaraan" class="form-label">Tipe Kendaraan (Merk, Tipe,
                            Tahun)</label>
                        <input type="text" class="form-control @error('type_kendaraan') is-invalid
@enderror"
                            id="type_kendaraan" name="type_kendaraan"
                            value=
"{{ old('type_kendaraan', $kendaraan->type_kendaraan) }}" required autofocus>
                        @error('type_kendaraan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- Nomor Polisi --}}
                    <div class="mb-3">
                        <label for="nomor_polisi" class="form-label">Nomor Polisi</label>
                        <input type="text" class="form-control @error('nomor_polisi') is-invalid
@enderror"
                            id="nomor_polisi" name="nomor_polisi"
                            value=
"{{ old('nomor_polisi', $kendaraan->nomor_polisi) }}" required>
                        @error('nomor_polisi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- Klasifikasi (Dinas / Pool) --}}
                    <div class="mb-3">
                        <label for="classification" class="form-label">Klasifikasi</label>
                        <select class="form-select @error('classification') is-invalid @enderror" id="classification"
                            name="classification" required>
                            <option value="dinas" @selected(old('classification', $kendaraan->classification) == 'dinas')>Dinas</option>
                            <option value="pool" @selected(old('classification', $kendaraan->classification) == 'pool')>Pool</option>
                        </select>
                        @error('classification')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- Status --}}
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                            <option value="available" @selected(old('status', $kendaraan->status) == 'available')>Available</option>
                            <option value="in_use" @selected(old('status', $kendaraan->status) == 'in_use')>In Use / Dipinjam</option>
                            <option value="maintenance" @selected(old('status', $kendaraan->status) == 'maintenance')>Maintenance</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- Tombol --}}
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.kendaraans.index') }}" class="btn btn-secondary me- 2">Batal</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
