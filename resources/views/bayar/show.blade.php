@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="{{ url('/home') }}">Dashboard</a></li>
					<li class="active">Pemesanan</li>
				</ul>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h2 class="panel-title">Pemesanan</h2>
					</div>
					<div class="panel-body">
						<p>Nomor Invoice: {{ $bayar->id }}</p>
						<p>Tanggal: {{ date('d-m-Y',strtotime($bayar->created_at)) }}</p>
						<hr>
						{!! $html->table(['class'=>'table-striped']) !!}
						<hr>
						<h3>Total: Rp.{{ number_format($bayar->totalbayar,0,",",".") }}</h3>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection

@section('scripts')

	{!! $html->scripts() !!}

@endsection