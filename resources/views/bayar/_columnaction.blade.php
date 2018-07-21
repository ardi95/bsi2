<div class="btn-group">
	<a href="{{ route('bayar.show',$id) }}" class="btn btn-info">Lihat Pesanan</a>
	@if($statusbayar == '0')
		<button class="btn btn-primary btn-upload" onclick="tes('{{ $id }}')" data-toggle="modal" data-target="#myModal">Konfirmasi</button>
	@endif
</div>