@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="{{ url('/home') }}">Dashboard</a></li>
					<li class="active">Keranjang Belanja</li>
				</ul>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h2 class="panel-title">Keranjang Belanja</h2>
					</div>
					<div class="panel-body">
						{!! $html->table(['class'=>'table-striped']) !!}
						<div class="row">
							<div class="col-lg-6">
								<h3>Total Pembayaran: <span class="label label-primary">Rp. {{ number_format($total,0,",",".") }}</span></h3>
								<p><a href="{{ route('productuser.index') }}" class="btn btn-default"><i class="fas fa-angle-double-left"></i>&nbsp; Lanjut Belanja</a></p>
							</div>
							<div class="col-lg-6 col-right-cart">\
								{!! Form::open(['url' => route('bayar.store'), 'method' => 'post', 'class'=>'form-horizontal']) !!}
									<p class="text-right"><button class="btn btn-warning btn-lg" type="submit"><i class="far fa-check-circle fa-lg"></i>&nbsp; Checkout</button></p>
								{!! Form::close() !!}
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>

@endsection

@section('scripts')

	{!! $html->scripts() !!}

@endsection