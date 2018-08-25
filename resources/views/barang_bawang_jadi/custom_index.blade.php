<!-- First you need to extend the CB layout -->
@extends('crudbooster::admin_template')
@section('content')
<!-- Your custom  HTML goes here -->


<div class="box form-inline">
	<div class="box-header">
		<div class="pull-left">
			<select class="form-control" id="barang_id" onchange="getChild(this)">
				<option value=''>** Please select a Induk Barang</option>
				@foreach ($induk_barangs as $induk_barang)
				<option {!! request()->induk_barang == $induk_barang->id ? 'selected' : '' !!} value="{{ $induk_barang->id }}">{{ $induk_barang->nama_barang }}</option>
				@endforeach
			</select>
			<select name="barang_id" class="form-control" id="barang_anak_id" required onchange="getChild2(this); getDataByChild(this)">
            <option value=''>** Please select a Anak Barang</option>
          </select>
		</div>

		<div class="pull-right">
		<select class="form-control" onchange="changeYear(this)">
			@foreach (range(2017, date('Y')+1) as $year)
			<option {!! request()->year == $year || $year == date('Y') ? 'selected' : '' !!} value="{{ $year }}">{{ $year }}</option>
			@endforeach
		</select>

		<select class="form-control" onchange="changeMonth(this)">
			@foreach (range(1, 12) as $month)
			<option {!! request()->month == $month ? 'selected' : '' !!} value="{{ $month }}">{{ $month }}</option>
			@endforeach
		</select>
		</div>
	</div>
	@php
	$satuan = DB::table('satuan_barang')->join('satuan', 'satuan.id', '=', 'satuan_barang.satuan_id')->where('barang_id', $result->id)->get();
	$count = $satuan->count();
	@endphp
	<table class="table table-bordered table-striped table-sm">
		<thead>
			<tr>
				<th class="warning text-center" colspan="9">{{ strtoupper($result->nama_barang) }}</th>
			</tr>
			
			@if ($satuan->count() == 1)
			<tr>
				<th width="15%">Tanggal</th>
				<th>Keterangan</th>
				<th width="10%">Masuk</th>
				<th width="10%">Keluar</th>
				<th width="10%">Saldo</th>
			</tr>
			@else
			<tr>
				<th rowspan="2" valign="middle" width="15%">Tanggal</th>
				<th rowspan="2" valign="middle">Keterangan</th>
				<th colspan="2" width="10%">Masuk</th>
				<th colspan="2" width="10%">Keluar</th>
				<th colspan="2" width="10%">Saldo</th>
			</tr>
			<tr>
				@foreach (range(1, 3) as $col)
					@foreach ($satuan as $st)
					<th>{{ $st->nama_satuan }}</th>
					@endforeach
				@endforeach
			</tr>
			@endif
		</thead>

		<tbody>
			@foreach ($barang_gudangs as $barang_gudang)
			@php
			@endphp
			<tr>
				<td>{{ $barang_gudang->tanggal }}</td>
				<td>{{ $barang_gudang->keterangan }}</td>
				@foreach (json_decode($barang_gudang->masuk) as $col1)
				<td>{{ $col1 }}</td>
				@endforeach

				@foreach (json_decode($barang_gudang->keluar) as $col2)
				<td>{{ $col2 }}</td>
				@endforeach

				@foreach (json_decode($barang_gudang->total) as $col3)
				<td>{{ $col3 }}</td>
				@endforeach


			</tr>
			@endforeach
		</tbody>
	</table>
</div>

<!-- ADD A PAGINATION -->

@endsection