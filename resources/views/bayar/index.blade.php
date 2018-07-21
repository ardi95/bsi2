@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="{{ url('/home') }}">Dashboard</a></li>
					<li class="active">Pembayaran</li>
				</ul>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h2 class="panel-title">Pembayaran</h2>
					</div>
					<div class="panel-body">
						{!! $html->table(['class'=>'table-striped']) !!}
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  	<div class="modal-dialog" role="document">
	    	<div class="modal-content">
	      		<div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title" id="myModalLabel">Konfirmasi pembayaran</h4>
	      		</div>
				{!! Form::open(['url' => route('checkout'), 'files' => true, 'method' => 'post', 'class'=>'form-horizontal']) !!}
					<input type="hidden" name="id" id="id_upload">
		      		<div class="modal-body">
		        		<div class="form-group">
							{!! Form::label('foto', 'Upload bukti pembayaran', ['class'=>'col-md-3 control-label']) !!}
							<div class="col-md-9">
								{!! Form::file('foto', ['class'=>'form-control']) !!}
							</div>
						</div>
		      		</div>
		      		<div class="modal-footer">
		        		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        		<button type="submit" class="btn btn-primary">Submit</button>
		      		</div>
	      		{!! Form::close() !!}
	    	</div>
	  	</div>
	</div>

@endsection

@section('scripts')

	{!! $html->scripts() !!}

	<script type="text/javascript">
		function tes(id) {
			// console.log('tes');
			$('#id_upload').removeAttr('value');
			$('#id_upload').attr('value',id);
		}

		{!! $errors->first('foto', 'swal("Gagal!",":message","error")') !!}
	</script>

@endsection