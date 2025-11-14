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
				<table id="peminjaman-kendaraan-table" class="table table-bordered table-striped table-hover">
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

					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	<script>
		$(document).ready(function() {
			$('#peminjaman-kendaraan-table').DataTable({
				processing: true,
				serverSide: true,
				method: "POST",
				ajax: "{{ route('pegawai.peminjaman-kendaraan.datatable') }}",
				columns: [{
						data: 'DT_RowIndex',
						name: 'DT_RowIndex'
					},
					{
						data: 'user.name',
						name: 'user.name'
					},
					{
						data: 'kendaraan.type_kendaraan',
						name: 'kendaraan.type_kendaraan'
					},
					{
						data: 'kendaraan.nomor_polisi',
						name: 'kendaraan.nomor_polisi'
					},
					{
						data: 'tgl_pinjam',
						name: 'tgl_pinjam'
					},
					{
						data: 'tgl_kembali',
						name: 'tgl_kembali'
					},
					{
						data: 'approval',
						name: 'approval'
					},
					{
						data: 'actions',
						name: 'actions',
						orderable: false,
						searchable: false,
						render: function(data, type, row) {
							return data ?? '-';
						}
					},
				],
			});
		});
	</script>
@endsection
