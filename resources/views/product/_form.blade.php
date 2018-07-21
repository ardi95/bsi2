<div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
	{!! Form::label('nama', 'Nama', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('nama', null, ['class'=>'form-control']) !!}
		{!! $errors->first('nama', '<p class="help-block">:message</p>') !!}
	</div>
</div>
<div class="form-group{{ $errors->has('harga') ? ' has-error' : '' }}">
	{!! Form::label('harga', 'Harga per meter', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::text('harga', null, ['class'=>'form-control']) !!}
		{!! $errors->first('harga', '<p class="help-block">:message</p>') !!}
	</div>
</div>
<div class="form-group{{ $errors->has('deskripsi') ? ' has-error' : '' }}">
	{!! Form::label('deskripsi', 'Deskripsi', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::textarea('deskripsi', null, ['class'=>'form-control']) !!}
		{!! $errors->first('deskripsi', '<p class="help-block">:message</p>') !!}
	</div>
</div>
<div class="form-group{{ $errors->has('foto') ? ' has-error' : '' }}">
	{!! Form::label('foto', 'Foto', ['class'=>'col-md-2 control-label']) !!}
	<div class="col-md-4">
		{!! Form::file('foto', ['class'=>'form-control']) !!}

		@if (isset($product) && $product->foto)
			<p>
				{!! Html::image(asset('upload/'.$product->foto), null, ['class'=>'img-rounded img-responsive']) !!}
			</p>
		@endif

		{!! $errors->first('foto', '<p class="help-block">:message</p>') !!}
	</div>
</div>

<div class="form-group">
	<div class="col-md-4 col-md-offset-2">
		{!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
	</div>
</div>