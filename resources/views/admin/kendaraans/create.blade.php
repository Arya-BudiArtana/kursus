@extends('layouts.app')
@section('content')
    <div class="px-4 container-fluid">
        <h1 class="mt-4">Tambah Kendaraan Baru</h1>
        <ol class="mb-4 breadcrumb">
            <li class="breadcrumb-item"><a href=
"{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href=
"{{ route('admin.kendaraans.index') }}">Manajemen
                    Kendaraan</a></li>
            <li class="breadcrumb-item active">Tambah Baru</li>
        </ol>
        <div class="mb-4 card">
            <div class="card-header">
                Formulir Tambah Kendaraan
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
"{{ route('admin.kendaraans.store') }}">
                    @csrf
                    {{-- Tipe Kendaraan --}}
                    <div class="mb-3">
                        <label for="type_kendaraan" class="form-label">Tipe Kendaraan (Merk, Tipe,
                            Tahun)</label>
                        <input type="text" class="form-control @error('type_kendaraan') is-invalid
@enderror"
                            id="type_kendaraan" name="type_kendaraan" value=
"{{ old('type_kendaraan') }}"
                            placeholder="Contoh: Toyota Avanza 2022" required autofocus>
                        @error('type_kendaraan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- Nomor Polisi --}}
                    <div class="mb-3">
                        <label for="nomor_polisi" class="form-label">Nomor Polisi</label>
                        <input type="text" class="form-control @error('nomor_polisi') is-invalid
@enderror"
                            id="nomor_polisi" name="nomor_polisi" value=
"{{ old('nomor_polisi') }}"
                            placeholder="Contoh: DK
1234 AB" required>
                        @error('nomor_polisi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- Klasifikasi (Dinas / Pool) --}}
                    <div class="mb-3">
                        <label for="classification" class="form-label">Klasifikasi</label>
                        <select class="form-select @error('classification') is-invalid @enderror" id="classification"
                            name="classification" required>
                            <option value=
"" disabled selected>-- Pilih Klasifikasi --</option>
                            <option value="dinas" @selected(old('classification') == 'dinas')>Dinas</option>
                            <option value="pool" @selected(old('classification') == 'pool')>Pool</option>
                        </select>
                        @error('classification')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- Tombol --}}
                    <div class="d-flex justify-content-end">
                        <a href=
"{{ route('admin.kendaraans.index') }}" class="btn btn-secondary me- 2">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
