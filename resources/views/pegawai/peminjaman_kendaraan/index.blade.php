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
				<a href="{{ route('pegawai.peminjaman-kendaraan.export') }}" class="btn btn-success btn-sm">
					<i class="fas fa-file-excel"></i> Eksport Excel
				</a>
				<button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
					Import Data
				</button>
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

	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<form action="{{ route('pegawai.peminjaman-kendaraan.import') }}" method="post" enctype="multipart/form-data">
				@csrf
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Import Data</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<input type="file" name="file_peminjaman_kendaraan" id="file_peminjaman_kendaraan" class="form-control" required
							accept=".xlsx">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Import</button>
					</div>
				</div>
			</form>

		</div>
	</div>
@endsection

@section('scripts')
	<script>
		console.log("{{ route('pegawai.peminjaman-kendaraan.datatable') }}");
		$(document).ready(function() {
			$('#peminjaman-kendaraan-table').DataTable({
				processing: true,
				serverSide: true,
				method: "GET",
				ajax: "{{ route('pegawai.peminjaman-kendaraan.datatable') }}",
				columns: [{
						data: 'DT_RowIndex',
						name: 'DT_RowIndex',
						orderable: false,
						searchable: false
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
						data: 'id',
						name: 'id',
						orderable: false,
						searchable: false,
						render: function(data, type, row, meta) {
							let editUrl = "{{ route('pegawai.peminjaman-kendaraan.edit', ':id') }}"
								.replace(':id', data);
							let deleteUrl =
								"{{ route('pegawai.peminjaman-kendaraan.destroy', ':id') }}".replace(
									':id', data);
							let buttons = '';

							if (row.approval == 'draft') {
								buttons += `<a href="${editUrl}" class="btn btn-warning btn-sm">
												<i class="fas fa-edit"></i> Edit
											</a> `;

								buttons += `<form action="${deleteUrl}" method="POST" class="d-inline">
												@csrf
												@method('DELETE')
												<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin membatalkan data ini?')">
													<i class="fas fa-trash"></i> Batalkan
												</button>
											</form>`;
							}

							return buttons;
						}
					}

				],
			});
		});
	</script>
@endsection
