@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/home') }}">Dashboard</a></li>
				<li class="active">Edit Profil</li>
			</ul>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Edit Profil</h2>
				</div>
				<div class="panel-body">
					{!! Form::model($user, ['url' => route('profil.update', $user->id), 'files' => true, 'method' => 'put', 'class'=>'form-horizontal']) !!}
					
						<div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
							{!! Form::label('name', 'Nama', ['class'=>'col-md-2 control-label']) !!}
							<div class="col-md-4">
								{!! Form::text('name', null, ['class'=>'form-control']) !!}
								{!! $errors->first('name', '<p class="help-block">:message</p>') !!}
							</div>
						</div>
						<div class="form-group{{ $errors->has('alamat') ? ' has-error' : '' }}">
							{!! Form::label('alamat', 'Alamat', ['class'=>'col-md-2 control-label']) !!}
							<div class="col-md-4">
								{!! Form::textarea('alamat', null, ['class'=>'form-control','rows'=>'5']) !!}
								{!! $errors->first('alamat', '<p class="help-block">:message</p>') !!}
							</div>
						</div>
						<div class="form-group{{ $errors->has('kontak') ? ' has-error' : '' }}">
							{!! Form::label('kontak', 'Nomor yang bisa dihubungi', ['class'=>'col-md-2 control-label']) !!}
							<div class="col-md-4">
								{!! Form::text('kontak', null, ['class'=>'form-control']) !!}
								{!! $errors->first('kontak', '<p class="help-block">:message</p>') !!}
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-4 col-md-offset-2">
								{!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
							</div>
						</div>
					
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>

@endsection