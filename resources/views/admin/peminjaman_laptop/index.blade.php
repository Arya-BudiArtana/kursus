@extends('layouts.app')
{{-- Ini akan mengisi @yield('content') di template Anda --}}
@section('content')
    <div class="px-4 container-fluid">
        <h1 class="mt-4">Manajemen Peminjaman Laptop</h1>
        <ol class="mb-4 breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Manajemen Peminjaman Laptop</li>
        </ol>
        <div class="mb-4 card">
            <div class="card-header">
                <a href="{{ route('admin.peminjamanlaptop.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Tambah Peminjman Laptop Baru
                </a>
            </div>
            <div class="card-body">
                {{-- Menampilkan notifikasi sukses --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>
                @endif
                {{-- Tabel Data --}}
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>User ID</th>
                            <th>Laptop ID</th>
                            <th>Tgl Pinjam</th>
                            <th>Tgl Kembali</th>
                            <th style="width: 150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data_peminjaman as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->laptop?->merk }}</td>
                                <td>{{ $item->tgl_pinjam }}</td>
                                <td>{{ $item->tgl_kembali }}</td>
                                <td>
                                    {{-- Tombol Edit --}}
                                    <a href="{{ route('admin.peminjamanlaptop.edit', $item->id) }}"
                                        class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    {{-- Tombol Hapus (dalam form) --}}
                                    <form action="{{ route('admin.peminjamanlaptop.delete', $item->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus data ini?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">
                                    Data peminjman laptop belum tersedia.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{-- Link Paginasi (Bootstrap 5) --}}
                <div class="mt-4">
                    {{ $data_peminjaman->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
