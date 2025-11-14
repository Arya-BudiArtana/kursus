@extends('layouts.app')
{{-- Ini akan mengisi @yield('content') di template Anda --}}
@section('content')
	<div class="px-4 container-fluid">
		<h1 class="mt-4">Manajemen Peminjaman Kendaraan</h1>
		<ol class="mb-4 breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
			<li class="breadcrumb-item active">Manajemen Peminjaman Kendaraan</li>
		</ol>
		<div class="mb-4 card">
			<div class="card-header">
				<a href="{{ route('pegawai.peminjaman-kendaraan.create') }}" class="btn btn-primary btn-sm">
					<i class="fas fa-plus"></i> Tambah Peminjaman Kendaraan Baru
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
							<th>Peminjam</th>
							<th>Nama Kendaraan</th>
							<th>Nomor Polisi</th>
							<th>Tgl Pinjam</th>
							<th>Tgl Kembali</th>
							<th>Approval Status</th>
							<th style="width: 150px;">Aksi</th>
						</tr>
					</thead>
					<tbody>
						@forelse ($data_peminjaman_kendaraan as $index => $item)
							<tr>
								<td>{{ $index + 1 }}</td>
								<td>{{ $item->user?->name }}</td>
								<td>{{ $item?->kendaraan?->type_kendaraan }}</td>
								<td>{{ $item?->kendaraan?->nomor_polisi }}</td>
								<td>{{ $item->tgl_pinjam }}</td>
								<td>{{ $item->tgl_kembali }}</td>
								<td>{{ $item->approval }}</td>
								<td>
									{{-- Tombol Edit --}}
									@if ($item->approval == 'draft')
										<a href="{{ route('pegawai.peminjaman-kendaraan.edit', $item->id) }}" class="btn btn-warning btn-sm">
											<i class="fas fa-edit"></i> Edit
										</a>
										{{-- Tombol Hapus (dalam form) --}}
										<form action="{{ route('pegawai.peminjaman-kendaraan.destroy', $item->id) }}" method="POST" class="d-inline">
											@csrf
											@method('DELETE')
											<button type="submit" class="btn btn-danger btn-sm"
												onclick="return confirm('Yakin ingin membatalkan data ini?')">
												<i class="fas fa-trash"></i> Batalkan
											</button>
										</form>
									@endif
								</td>
							</tr>
						@empty
							<tr>
								<td colspan="8" class="text-center">
									Data Peminjaman Kendaraan belum tersedia.
								</td>
							</tr>
						@endforelse
					</tbody>
				</table>
				{{-- Link Paginasi (Bootstrap 5) --}}
				<div class="mt-4">
					{{ $data_peminjaman_kendaraan->links() }}
				</div>
			</div>
		</div>
	</div>
@endsection
