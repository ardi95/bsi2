@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><a href="{{ url('/home') }}">Dashboard</a></li>
					<li class="active">Konfirmasi</li>
				</ul>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h2 class="panel-title">Konfirmasi</h2>
					</div>
					<div class="panel-body">
						{!! $html->table(['class'=>'table-striped']) !!}
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  		<div class="modal-dialog" role="document">
    		<div class="modal-content">
      			<div class="modal-header">
        			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        			<h4 class="modal-title" id="myModalLabel">Konfirmasi pembayaran</h4>
      			</div>
      			<div class="modal-body">
      				<div class="row">
      					<div class="col-lg-8 col-lg-offset-2">
	        				<img class="img-fotokonfirmasi" style="width: 100%;">
	        			</div>
      				</div>
        			
      			</div>
      			<div class="modal-footer">
      				{!! Form::open(['url' => route('konfirmasi.store'),'class' => 'form-horizontal form-daftaruser']) !!}
      					<input type="hidden" name="id" id="id_bayar">
	        			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        			<button type="submit" class="btn btn-primary">Konfirmasi</button>
	        		{!! Form::close() !!}
      			</div>
    		</div>
  		</div>
	</div>

@endsection

@section('scripts')

	{!! $html->scripts() !!}

	<script type="text/javascript">
		function konfirmasi(id) {
			$('#id_bayar').removeAttr('value');
			$('#id_bayar').attr('value',id);

			$.ajax({
				type	: 'GET',
				url		: "{{ route('ajaxkonfirmasi') }}",
				dataType: 'JSON',
				data 	: {
					id: id
				},
				'success' : function(data) {
					$('.img-fotokonfirmasi').removeAttr('src');
					$('.img-fotokonfirmasi').attr("src","{{ asset('konfirmasi') }}/" + data.foto);
				}
			});
		}
	</script>

@endsection