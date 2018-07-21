@extends('layouts.app')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/home') }}">Dashboard</a></li>
				<li class="active">Cara Pemesanan</li>
			</ul>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Cara Pemesanan</h2>
				</div>
				<ul class="list-group">
					<li class="list-group-item">Alamat: Teluk Buyung</li>
				    <li class="list-group-item">No.HP: 089123456</li>
				    <li class="list-group-item">No.Telp: 021-123456</li>
				    <li class="list-group-item">Rek.BCA: 01112312141</li>
				 </ul>
			</div>
		</div>
	</div>
</div>

@endsection