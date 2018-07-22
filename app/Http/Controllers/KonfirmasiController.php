<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\Bayar;
use App\Pesan;
use Alert;

class KonfirmasiController extends Controller
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
            $bayars = Bayar::with('user')->where('statusbayar','!=','3');
            return Datatables::of($bayars)
            ->addColumn('rpstatusbayar', function(Bayar $bayars) {
                if ($bayars->statusbayar == '0') {
                    return 'Menunggu pembayaran customer';
                }
                else {
                    return 'Sudah konfirmasi';
                }
            })
            ->addColumn('rptotalbayar', function(Bayar $bayars) {
                return 'Rp. '.number_format($bayars->totalbayar,0,",",".");
            })
            // ->addColumn('column_action', 'bayar._columnaction')
            // ->rawColumns(['column_action'])
            ->orderColumn('rpstatusbayar', 'statusbayar $1')
            ->orderColumn('rptotalbayar', 'totalbayar $1')
            ->addColumn('column_action', 'konfirmasi._columnaction')
            ->rawColumns(['column_action'])
            ->make(true);
        }

        $html = $htmlBuilder
        ->addColumn(['data' => 'id', 'name'=>'id', 'title'=>'Kode Pembayaran'])
        ->addColumn(['data' => 'user.name', 'name'=>'user.name', 'title'=>'Nama Customer'])
        ->addColumn(['data' => 'rpstatusbayar', 'name'=>'rpstatusbayar', 'title'=>'Status', 'searchable'=>false])
        ->addColumn(['data' => 'rptotalbayar', 'name'=>'rptotalbayar', 'title'=>'Total Pembayaran', 'searchable'=>false])
        ->addColumn(['data' => 'updated_at', 'name'=>'updated_at', 'title'=>'Tanggal'])
        ->addColumn(['data' => 'column_action', 'name'=>'column_action', 'title'=>'Action', 'orderable'=>false, 'searchable'=>false, 'width'=>'300px']);
        // ->addColumn(['data' => 'column_action', 'name'=>'column_action', 'title'=>'Action', 'orderable'=>false, 'searchable'=>false, 'width'=>'300px']);

        return view('konfirmasi.index')->with(compact('html'));
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
        $id = $request->id;
        $bayar = Bayar::find($id);
        $bayar->update([
            'statusbayar' => '2'
        ]);
        Alert::success('Berhasil konfirmasi', 'Berhasil',"success")->persistent('Close');

        return redirect()->route('konfirmasi.index');
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

    public function ajaxkonfirmasi(Request $request)
    {
        $id = $request->id;
        $bayar = Bayar::find($id);
        $data['foto'] = $bayar->foto;

        return response()->json($data);
    }
}
