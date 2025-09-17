@php
	\Carbon\Carbon::setLocale('id');
@endphp

@extends('layouts.main')

@section('main-content')
<div class="container-fluid">
	<!--  Row 1 -->
	<div class="row">
		<div class="col-lg-12 d-flex align-items-stretch">
			<div class="card border border-2 w-100">
				<div class="card-body p-4">
					<h3 class="card-title fw-semibold mb-4 text-center">LAPORAN PENILAIAN</h3>

					<!-- Tabel Penilaian -->
					<div class="table-responsive">
						<table class="table text-nowrap table-bordered mb-0 align-middle">
							<thead class="text-dark fs-4">
								<tr class="table-info text-center">
									<th class="border-bottom-0">
										<h6 class="fw-semibold mb-0">No</h6>
									</th>
									<th class="border-bottom-0">
										<h6 class="fw-semibold mb-0">SPBE</h6>
									</th>
									<th class="border-bottom-0">
										<h6 class="fw-semibold mb-0">Kematangan</h6>
									</th>
									<th class="border-bottom-0">
										<h6 class="fw-semibold mb-0">Predikat</h6>
									</th>
									<th class="border-bottom-0">
										<h6 class="fw-semibold mb-0">Tanggal Penilaian</h6>
									</th>
									<th class="border-bottom-0">
										<h6 class="fw-semibold mb-0">Laporan</h6>
									</th>
								</tr>
							</thead>
							<tbody>
								@forelse ($aplikasi as $item)
									<tr>
										<td class="border-bottom-0 text-center">
											<h6 class="fw-semibold mb-0">{{ $loop->iteration }}</h6>
										</td>
										<td class="border-bottom-0">
											<span class="fw-normal">{{ $item->nama_aplikasi }}</span>
										</td>
										<td class="border-bottom-0 text-center">
											<p class="mb-0 fw-normal">{{ $item->kematangan }}</p>
										</td>
										<td class="border-bottom-0 text-center">
											<p class="mb-0 fw-normal">{{ $item->predikat }}</p>
										</td>
										<td class="border-bottom-0 text-center">
											<p class="mb-0 fw-normal">{{ \Carbon\Carbon::parse($item->updated_at)->translatedFormat('d F Y') }}
											</p>
										</td>
										<td>
											<a href="{{ url("/laporan/view/pdf/$item->id") }}" class="btn btn-secondary" target="_blank"><i
													class="ti ti-file"></i></a>
										</td>
									</tr>
								@empty
									<tr class="text-center">
										<td colspan="7">Belum ada data penilaian.</td>
									</tr>
								@endforelse
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection