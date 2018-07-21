<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\Pesan;
use App\Product;
use App\Bayar;
use Alert;

class BayarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
        //
        if ($request->ajax()) {
            $bayars = Bayar::where('user_id','=',Auth::user()->id);
            return Datatables::of($bayars)
            ->addColumn('rpstatusbayar', function(Bayar $bayars) {
                if ($bayars->statusbayar == '0') {
                    return 'Menunggu pembayaran customer';
                }
                elseif ($bayars->statusbayar == '1') {
                    return 'Sudah upload bukti pembayaran, menunggu konfirmasi admin';
                }
                else{
                    return 'Sudah dikonfirmasi, tunggu pesanan diantar ke tujuan 1 hari kemudian';
                }
            })
            ->addColumn('rptotalbayar', function(Bayar $bayars) {
                return 'Rp. '.number_format($bayars->totalbayar,0,",",".");
            })
            ->addColumn('column_action', 'bayar._columnaction')
            ->rawColumns(['column_action'])
            ->make(true);
        }

        $html = $htmlBuilder
        ->addColumn(['data' => 'id', 'name'=>'id', 'title'=>'Kode Pembayaran'])
        ->addColumn(['data' => 'rpstatusbayar', 'name'=>'rpstatusbayar', 'title'=>'Status', 'orderable'=>false, 'searchable'=>false])
        ->addColumn(['data' => 'rptotalbayar', 'name'=>'rptotalbayar', 'title'=>'Total Pembayaran'])
        ->addColumn(['data' => 'column_action', 'name'=>'column_action', 'title'=>'Action', 'orderable'=>false, 'searchable'=>false, 'width'=>'300px']);

        return view('bayar.index')->with(compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $total = 0;
        $pesan2 = Pesan::where('pesans.user_id','=',Auth::user()->id)->where('pesans.status','=','0')->get();
        
        foreach ($pesan2 as $p) {
            $totalharga = $p->jumlah * $p->product->harga;
            $total += $totalharga;

        }

        $data = array(
            'statusbayar'   => '0',
            'totalbayar'    => $total,
            'user_id'       => Auth::user()->id
        );
        $bayar = Bayar::create($data);
        $pesan = Pesan::where('user_id','=',Auth::user()->id)->where('status','=','0');
        // return $pesan;die();
        $pesan->update([
            'status'    => '1',
            'bayar_id'  => $bayar->id
        ]);

        Alert::success('Checkout berhasil, silahkan transfer pembayaran dan upload bukti pembayaran', 'Berhasil',"success")->persistent('Close');
        return redirect()->route('bayar.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id, Builder $htmlBuilder)
    {
        //
        if ($request->ajax()) {
            $pesans = Pesan::with('product')->where('bayar_id','=',$id);
            return Datatables::of($pesans)
            ->addColumn('hargapesan', function(Pesan $pesans) {
                return 'Rp. '.number_format($pesans->product->harga,0,",",".");
            })
            ->addColumn('total', function(Pesan $pesans) {
                return 'Rp. '.number_format($pesans->jumlah * $pesans->product->harga,0,",",".");
            })
            ->rawColumns(['column_foto'])
            ->make(true);
        }

        $html = $htmlBuilder
        ->addColumn(['data' => 'id', 'name'=>'id', 'title'=>'Kode Pesanan'])
        ->addColumn(['data' => 'product.nama', 'name'=>'product.nama', 'title'=>'Nama Product'])
        ->addColumn(['data' => 'jumlah', 'name'=>'jumlah', 'title'=>'Jumlah Lebar(meter)'])
        ->addColumn(['data' => 'hargapesan', 'product.name'=>'hargapesan', 'title'=>'Harga', 'orderable'=>false, 'searchable'=>false])
        ->addColumn(['data' => 'total', 'name'=>'total', 'title'=>'Total Harga', 'orderable'=>false, 'searchable'=>false]);

        $tablepesan = Pesan::where('bayar_id','=',$id)->get();

        $bayar = Bayar::find($id);

        return view('bayar.show')->with(compact('html','total','bayar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function checkout(Request $request)
    {
        $this->validate($request, [
            'foto' => 'required|image'
        ]);

        $bayar = Bayar::find($request->id);

        $uploadfoto = $request->file('foto');

        $extension_foto     = $request->foto->extension();
        $hasil_nama_foto    = md5(time());

        $destinationPath = base_path().'/public/konfirmasi';
        $uploadfoto->move($destinationPath, $hasil_nama_foto.".".$extension_foto);
        // $data['foto'] = $hasil_nama_foto.".".$extension_foto;

        $bayar->update([
            'statusbayar'   => '1',
            'foto'          => $hasil_nama_foto.".".$extension_foto
        ]);

        Alert::success('Berhasil upload foto konfirmasi pembayaran', 'Berhasil',"success")->persistent('Close');

        return redirect()->route('bayar.index');
    }
}
