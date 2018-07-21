{!! Form::open(['url' => route('cart.destroy',$id), 'method' => 'delete', 'class'=>'form-horizontal']) !!}
	
	<button type="submit" class="btn btn-danger" onclick="return confirm('Apa anda yakin ingin menghapus pesanan ini?');">Delete</button>

{!! Form::close()!!}