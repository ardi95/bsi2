@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/home') }}">Dashboard</a></li>
				<li><a href="{{ url('/admin/product') }}">Product</a></li>
				<li class="active">Edit Product</li>
			</ul>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Tambah Penulis</h2>
				</div>
				<div class="panel-body">
					{!! Form::model($product, ['url' => route('product.update', $product->id), 'files' => true, 'method' => 'put', 'class'=>'form-horizontal']) !!}
					
						@include('product._form')
					
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>

@endsection