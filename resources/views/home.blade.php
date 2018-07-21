@extends('layouts.app')

@section('css')
    <style type="text/css">
        nav{
            margin-bottom: 0px !important;
        }
        .item1{
            background: url('{{ asset('carousel/1.jpg') }}') 50% 50% no-repeat; 
            /*width: 100%; */
            /*height: 554px;*/
            background-size: cover;
        }

        .owl-carousel .item img{
            /*display: block;*/
            width: 100%;
            height: 550px;
        }
    </style>
@endsection

@section('content')
    <!-- <div class="owl-carousel owl-theme">
        <div class="item"><img src="{{ asset('carousel/1.jpg') }}"></div>
        <div class="item"><img src="{{ asset('carousel/2.jpg') }}"></div>
        <div class="item"><img src="{{ asset('carousel/3.jpg') }}"></div>
    </div> -->
    <img src="{{ asset('carousel/1.jpg') }}" style="width: 100%; height: 450px;">
    <div class="container">
        <h2 class="text-primary text-center">Selamat datang di website Pemesanan Pagar</h2>
        <div class="jumbotron">
            <h4 class="text-justify">Menerima pemesanan untuk pembuatan pagar. Bahan berkualitas. Untuk pemesanan sangat mudah tidak perlu datang silahkan telfon dan buat janji untuk bertemu biar kami yang datang ketempat anda. Kualitas dan kepuasan pelanggan adalah yang utama bagi toko kami. Hanya terima diwilayah khusus cibitung-bekasi. Harga sudah termasuk ongkos kirim. Jika ingin berkonsultasi/cek harga selanjutnya hubungi: 081996272909. Terima kasih atas perhatiannya.</h4>
        </div>
        
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $('.owl-carousel').owlCarousel({
            loop:true,
            items:1,
            autoplay:true,
            responsive:{
                0:{
                    items:1
                }
            }
        });
    </script>
    
@endsection