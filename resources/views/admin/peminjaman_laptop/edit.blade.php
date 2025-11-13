@extends('layouts.app')
@section('content')
    <div class="px-4 container-fluid">
        <h1 class="mt-4">Edit Peminjaman Laptop</h1>
        <ol class="mb-4 breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.peminjamanlaptop.index') }}">Manajemen
                    Peminjaman Laptop</a></li>
            <li class="breadcrumb-item active">Edit Peminjaman</li>
        </ol>
        <div class="mb-4 card">
            <div class="card-header">
                Formulir Edit Peminjama Laptop
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
                <form method="POST" action="{{ route('admin.peminjamanlaptop.update', $data_peminjam_laptop->id) }}">
                    @csrf
                    @method('put')
                    {{-- User ID --}}
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="mt-3 fs-6 fw-semibold form-label">
                            <span class="required">User</span>
                            <span class="ms-1" data-bs-toggle="tooltip" title="Pilih Jenis Prestasi">
                                <i class="ki-outline ki-information fs-7"></i>
                            </span>
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <select required class="form-select" name="user_id" id="user_id" data-placeholder="Pilih User">
                            <option selected value="">Nama User...</option>
                            @foreach ($data_user as $item_user)
                                <option value="{{ $item_user->id }}" @selected(old('user_id', $data_peminjam_laptop->user_id) == $item_user->id)> {{ $item_user->name }}
                                </option>
                            @endforeach
                        </select>
                        <!--end::Input-->
                    </div>

                    {{-- Laptop ID --}}
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="mt-3 fs-6 fw-semibold form-label">
                            <span class="required">Laptop</span>
                            <span class="ms-1" data-bs-toggle="tooltip" title="Pilih Laptop ">
                                <i class="ki-outline ki-information fs-7"></i>
                            </span>
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <select required class="form-select" name="laptop_id" id="laptop_id"
                            data-placeholder="Pilih Laptop">
                            <option selected value="">Nama Laptop...</option>
                            @foreach ($data_laptop as $item_laptop)
                                <option value="{{ $item_laptop->id }}" @selected(old('laptop_id', $data_peminjam_laptop->laptop_id) == $item_laptop->id)>
                                    {{ $item_laptop->merk }} </option>
                            @endforeach
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
                                value="{{ old('tgl_pinjam', date('Y-m-d', strtotime($data_peminjam_laptop->tgl_pinjam))) }}" />
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
                            <input required type="date" class="form-control" name="tgl_kembali" id="tgl_kembali"
                                value="{{ old('tgl_kembali', date('Y-m-d', strtotime($data_peminjam_laptop->tgl_kembali))) }}" />
                        </div>
                    </div>



                    {{-- Tombol --}}
                    <div class="d-flex justify-content-end" style="margin-top: 20px;">
                        <a href="{{ route('admin.peminjamanlaptop.index') }}" class="btn btn-secondary me2">
                            Batal</a>
                        <button type="submit" class="btn btn-primary" style="margin-left: 10px;">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
