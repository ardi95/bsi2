@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="{{ url('/home') }}">Dashboard</a></li>
					<li><a href="{{ route('productuser.index') }}">Product</a></li>
					<li class="active">Beli</li>
				</ul>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h2 class="panel-title">{{ $products->nama }}</h2>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-3">
								<img src="{{ asset('upload/'.$products->foto) }}" class="img-thumbnail">
							</div>
							<div class="col-lg-3">
								<h3><span class="label label-primary">Rp. {{ number_format($products->harga,0,",",".") }}</span></h3>
								<h3 class="text-danger"><u>Deskripsi</u></h3>
								<p>{{ $products->deskripsi }}</p>
							</div>
							<div class="col-lg-6">
								<div class="panel panel-primary">
									<div class="panel-heading">
										<h2 class="panel-title">Form pemesanan</h2>
									</div>
									<div class="panel-body">
										{!! Form::open(['url' => route('cart.store'), 'method' => 'post', 'class'=>'form-horizontal']) !!}
											<input type="hidden" name="id" value="{{ $products->id }}">
											<div class="form-group{{ $errors->has('jumlah') ? ' has-error' : '' }}">
												{!! Form::label('jumlah', 'Jumlah', ['class'=>'col-lg-4 control-label']) !!}
												<div class="col-lg-8">
													{!! Form::text('jumlah', null, ['class'=>'form-control']) !!}
													{!! $errors->first('jumlah', '<p class="help-block">:message</p>') !!}
												</div>
											</div>
											<div class="form-group">
												{!! Form::label('kirim', 'Dikirim Ke', ['class'=>'col-lg-4 control-label']) !!}
												<div class="col-lg-8">
													<textarea name="alamat" rows="5" class="form-control" readonly="readonly">{{ Auth::user()->alamat }}</textarea>
												</div>
											</div>
											<div class="form-group">
												{!! Form::label('kontak', 'Kontak yang bisa dihubungi', ['class'=>'col-lg-4 control-label']) !!}
												<div class="col-lg-8">
													<input type="text" name="kontak" value="{{ Auth::user()->kontak }}" class="form-control" readonly="readonly">
												</div>
											</div>
											<div class="form-group">
												<div class="col-lg-2 col-lg-offset-3">
													<button type="submit" class="btn btn-primary">Submit</button>
												</div>
											</div>

										{!! Form::close() !!}
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection