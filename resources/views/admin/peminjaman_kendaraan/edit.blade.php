@extends('layouts.app')
@section('content')
    <div class="px-4 container-fluid">
        <h1 class="mt-4">Pengembalian Peminjaman Kendaraan</h1>
        <ol class="mb-4 breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.peminjaman-kendaraan.index') }}">Manajemen
                    Peminjaman Kendaraan</a></li>
            <li class="breadcrumb-item active">Pengembalian Kendaraan</li>
        </ol>
        <div class="mb-4 card">
            <div class="card-header">
                Formulir Pengembalian Peminjaman Kendaraan
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
                <form method="POST" action="{{ route('admin.peminjaman-kendaraan.update', $data_sebelumnya->id) }}">
                    @csrf
                    @method('put')
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="mt-3 fs-6 fw-semibold form-label">
                            <span class="required">Tipe Kendaraan</span>
                            <span class="ms-1" data-bs-toggle="tooltip" title="Pilih Jenis Kendaraan">
                                <i class="ki-outline ki-information fs-7"></i>
                            </span>
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <select required class="form-select" name="id_kendaraan" id="id_kendaraan"
                            data-placeholder="Pilih Kendaraan" disabled>
                            <option value="">Tipe Kendaraan...</option>
                            <option selected value="{{ $data_kendaraan->id }}">{{ $data_kendaraan->type_kendaraan }}
                            </option>
                        </select>
                        <!--end::Input-->
                    </div>

                    <div class="fv-row mb-7">
                        <label class="mt-3 fs-6 fw-semibold form-label">
                            <span class="required">Tanggal Pinjam</span>
                            <span class="ms-1" data-bs-toggle="tooltip">
                                <i class="ki-outline ki-information fs-7"></i>
                            </span>
                        </label>
                        <div class="input-group" id="tgl_pinjam" data-td-target-input="nearest"
                            data-td-target-toggle="nearest">
                            <input required type="date" class="form-control" name="tgl_pinjam" id="tgl_pinjam"
                                value="{{ old('tgl_pinjam', date('Y-m-d', strtotime($data_sebelumnya->tgl_pinjam))) }}"
                                disabled />
                        </div>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="mt-3 fs-6 fw-semibold form-label">
                            <span class="required">Tanggal Kembali</span>
                            <span class="ms-1" data-bs-toggle="tooltip">
                                <i class="ki-outline ki-information fs-7"></i>
                            </span>
                        </label>
                        <div class="input-group" id="tgl_kembali" data-td-target-input="nearest"
                            data-td-target-toggle="nearest">
                            <input required type="date" class="form-control" name="tgl_kembali" id="tgl_kembali" />
                        </div>
                    </div>



                    {{-- Tombol --}}
                    <div class="d-flex justify-content-end" style="margin-top: 20px;">
                        <a href="{{ route('admin.peminjaman-kendaraan.index') }}" class="btn btn-secondary me2">
                            Batal</a>
                        <button type="submit" class="btn btn-primary" style="margin-left: 10px;">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
