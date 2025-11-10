@extends('layouts.app')
{{-- Ini akan mengisi @yield('content') di template Anda --}}
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Manajemen Laptop</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Manajemen Laptop</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <a href="{{ route('admin.laptops.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Tambah Laptop Baru
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

                            <th>Merk</th>
                            <th>Spesifikasi</th>
                            <th>Tahun</th>
                            <th>Status</th>
                            <th style="width: 150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($laptops as $laptop)
                            <tr>
                                <td>{{ $laptop->merk }}</td>
                                <td>{{ $laptop->spesifikasi }}</td>
                                <td>{{ $laptop->tahun_pengadaan }}</td>
                                <td>
                                    @if ($laptop->status == '1')
                                        <span class="badge bg-success">Tersedia</span>
                                    @elseif ($laptop->status == '2')
                                        <span class="badge bg-warning">Dipinjam</span>
                                    @else
                                        <span class="badge bg-secondary">Diperbaiki</span>
                                    @endif
                                </td>
                                <td>
                                    {{-- Tombol Edit --}}
                                    <a href="{{ route('admin.laptops.edit', $laptop->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    {{-- Tombol Hapus (dalam form) --}}
                                    <form action="{{ route('admin.laptops.destroy', $laptop->id) }}" method="POST"
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
                                <td colspan="5" class="text-center">
                                    Data laptop belum tersedia.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{-- Link Paginasi (Bootstrap 5) --}}
                <div class="mt-4">
                    {{ $laptops->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
