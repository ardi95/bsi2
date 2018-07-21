{!! Form::open(['url' => route('product.destroy',$id), 'method' => 'delete', 'class'=>'form-horizontal']) !!}	
	<a href="{{ route('product.edit',$id) }}" class="btn btn-warning">Edit</a> &nbsp; <button type="submit" class="btn btn-danger" onclick="return confirm('Apa anda yakin ingin menghapus product ini?');">Delete</button>
{!! Form::close()!!}