@extends('layouts.app')
@section('content')
    <div class="px-4 container-fluid">
        <h1 class="mt-4">Manajemen Kendaraan</h1>
        <ol class="mb-4 breadcrumb">
            <li class="breadcrumb-item"><a href=
"{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Manajemen Kendaraan</li>
        </ol>
        <div class="mb-4 card">
            <div class="card-header">
                <a href=
"{{ route('admin.kendaraans.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Tambah Kendaraan Baru
                </a>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>
                @endif
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Tipe Kendaraan</th>
                            <th>Nomor Polisi</th>
                            <th>Klasifikasi</th>
                            <th>Status</th>
                            <th style="width: 150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kendaraans as $kendaraan)
                            <tr>
                                <td>{{ $kendaraan->type_kendaraan }}</td>
                                <td>{{ $kendaraan->nomor_polisi }}</td>
                                <td>
                                    @if ($kendaraan->classification == 'dinas')
                                        <span class="badge bg-info">Dinas</span>
                                    @else
                                        <span class="badge bg-primary">Pool</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($kendaraan->status == 'available')
                                        <span class="badge bg-success">{{ $kendaraan->status }}</span>
                                    @elseif ($kendaraan->status == 'in_use')
                                        <span class="badge bg-warning">{{ $kendaraan->status }}</span>
                                    @else
                                        <span class="badge bg-secondary">{{ $kendaraan->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href=
"{{ route('admin.kendaraans.edit', $kendaraan->id) }}"
                                        class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action=
"{{ route('admin.kendaraans.destroy', $kendaraan->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick=
"return confirm('Yakin ingin menghapus data ini?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">
                                    Data kendaraan belum tersedia.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $kendaraans->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
