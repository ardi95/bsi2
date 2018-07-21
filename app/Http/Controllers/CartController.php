<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\Pesan;
use App\Product;
use Alert;

class CartController extends Controller
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
            $pesans = Pesan::with('product')->where('pesans.user_id','=',Auth::user()->id)->where('pesans.status','=','0');
            return Datatables::of($pesans)
            ->addColumn('hargapesan', function(Pesan $pesans) {
                return 'Rp. '.number_format($pesans->product->harga,0,",",".");
            })
            ->addColumn('total', function(Pesan $pesans) {
                return 'Rp. '.number_format($pesans->jumlah * $pesans->product->harga,0,",",".");
            })
            ->addColumn('column_action', 'cart._columnaction')
            ->rawColumns(['column_foto', 'column_action'])
            ->make(true);
        }

        $html = $htmlBuilder
        ->addColumn(['data' => 'id', 'name'=>'id', 'title'=>'Kode Pesanan'])
        ->addColumn(['data' => 'product.nama', 'name'=>'product.nama', 'title'=>'Nama Product'])
        ->addColumn(['data' => 'jumlah', 'name'=>'jumlah', 'title'=>'Jumlah Lebar(meter)'])
        ->addColumn(['data' => 'hargapesan', 'product.name'=>'hargapesan', 'title'=>'Harga', 'orderable'=>false, 'searchable'=>false])
        ->addColumn(['data' => 'total', 'name'=>'total', 'title'=>'Total Harga', 'orderable'=>false, 'searchable'=>false])
        ->addColumn(['data' => 'column_action', 'name'=>'column_action', 'title'=>'Action', 'orderable'=>false, 'searchable'=>false, 'width'=>'150px']);

        $total = 0;
        $pesan2 = Pesan::where('pesans.user_id','=',Auth::user()->id)->where('pesans.status','=','0')->get();
        
        foreach ($pesan2 as $p) {
            $totalharga = $p->jumlah * $p->product->harga;
            $total += $totalharga;

        }

        return view('cart.index')->with(compact('html','total'));
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
        $product = Product::find($request->id);
        $this->validate($request, [
            'jumlah'    => 'required|numeric'
        ]);
        
        $data = array(
            'jumlah'        => $request->jumlah,
            'status'        => '0',
            'product_id'    => $request->id,
            'user_id'       => Auth::user()->id
        );

        Pesan::create($data);
        Alert::success('Berhasil menambah pesanan ke keranjang belanja', 'Berhasil',"success")->persistent('Close');
        return redirect()->route('cart.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $pesan = Pesan::find($id);
        
        $product = Product::find($pesan->product_id);
        $stok = $product->stok + $pesan->jumlah;
        $product->update([
            'stok' => $stok
        ]);
        
        $pesan->delete();
        Alert::success('Berhasil menghapus pesanan', 'Berhasil',"success")->persistent('Close');

        return redirect()->route('cart.index');
    }
}
