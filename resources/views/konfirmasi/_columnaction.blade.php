<div class="btn-group">
	<a href="{{ route('konfirmasi.show',$id) }}" class="btn btn-info">Lihat pemesanan</a>
	@if($statusbayar == 1)
		<button onclick="konfirmasi('{{ $id }}')" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
  			Konfirmasi
		</button>

	@endif
</div>