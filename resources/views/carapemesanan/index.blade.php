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
				    <li class="list-group-item">Pesan pager yang anda inginkan di menu <a href="{{ route('productuser.index') }}">Product</a></li>
				    <li class="list-group-item">Pesanan yang anda pesan akan masuk ke <a href="{{ route('cart.index') }}">keranjang belanja</a></li>
				    <li class="list-group-item">Klik checkout pada menu keranjang belanja jika pesanan sudah selesai dibuat</li>
				    <li class="list-group-item">Transfer pembayaran ke rekening yang sudah di sediakan di menu <a href="{{ route('kontak.index') }}">Kontak</a></li>
				    <li class="list-group-item">Konfirmasi pembayaran anda di menu <a href="{{ route('carapemesanan.index') }}">Pembayaran</a> dengan upload bukti pembayaran anda</li>
				    <li class="list-group-item">Tunggu pesanan anda di konfirmasi admin dan pesanan akan di antar ke rumah anda</li>
				 </ul>
			</div>
		</div>
	</div>
</div>

@endsection