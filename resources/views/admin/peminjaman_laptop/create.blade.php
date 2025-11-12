@extends('layouts.app')
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Tambah Peminjaman Laptop Baru</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.laptop.index') }}">Manajemen
                Peminjaman Laptop</a></li>
        <li class="breadcrumb-item active">Tambah Baru</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            Formulir Tambah Peminjama Laptop
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
            <form method="POST" action="{{route('admin.peminjamanlaptop.store')}}">
                @csrf
                {{-- User ID --}}
                <div class="fv-row mb-7">
                    <!--begin::Label-->
                    <label class="fs-6 fw-semibold form-label mt-3">
                        <span class="required">User</span>
                        <span class="ms-1" data-bs-toggle="tooltip" title="Pilih Jenis Prestasi">
                            <i class="ki-outline ki-information fs-7"></i>
                        </span>
                    </label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <select required class="form-select" name="user_id"
                        id="user_id" data-placeholder="Pilih User">
                        <option selected value="">Nama User...</option>
                        @foreach ($data_user as $item_user)
                        <option value="{{ $item_user->id }}"> {{ $item_user->name }} </option>
                        @endforeach
                    </select>
                    <!--end::Input-->
                </div>

                {{-- Laptop ID --}}
                <div class="fv-row mb-7">
                    <!--begin::Label-->
                    <label class="fs-6 fw-semibold form-label mt-3">
                        <span class="required">Laptop</span>
                        <span class="ms-1" data-bs-toggle="tooltip" title="Pilih Laptop ">
                            <i class="ki-outline ki-information fs-7"></i>
                        </span>
                    </label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <select required class="form-select" name="laptop_id"
                        id="laptop_id" data-placeholder="Pilih Laptop">
                        <option selected value="">Nama Laptop...</option>
                        @foreach ($data_laptop as $item_laptop)
                        <option value="{{ $item_laptop->id }}"> {{ $item_laptop->merk }} </option>
                        @endforeach
                    </select>
                    <!--end::Input-->
                </div>

                <div class="fv-row mb-7">
                    <label class="fs-6 fw-semibold form-label mt-3">
                        <span class="required">Tanggal Pinjam</span>
                        <span class="ms-1" data-bs-toggle="tooltip">
                            <i class="ki-outline ki-information fs-7"></i>
                        </span>
                    </label>
                    <div class="input-group" id="tgl_pinjam" data-td-target-input="nearest"
                        data-td-target-toggle="nearest">
                        <input required type="date" class="form-control" name="tgl_pinjam" id="tgl_pinjam" />
                    </div>
                </div>



                {{-- Tombol --}}
                <div class="d-flex justify-content-end" style="margin-top: 20px;">
                    <a href="{{ route('admin.laptop.index') }}" class="btn btn-secondary me2">
                        Batal</a>
                    <button type="submit" class="btn btn-primary" style="margin-left: 10px;">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
