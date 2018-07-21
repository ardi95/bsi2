<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;

class ProductuserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth')->only('show');

        $this->middleware('role:member')->only('show');
    }

    public function index(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {
            $products = Product::select(['id', 'nama', 'harga', 'deskripsi', 'foto']);
            return Datatables::of($products)
            ->addColumn('column_foto', 'productuser._columnfoto')
            ->addColumn('column_action', 'productuser._columnaction')
            ->rawColumns(['column_foto', 'column_action'])
            ->make(true);
        }

        $html = $htmlBuilder
        ->addColumn(['data' => 'id', 'name'=>'id', 'title'=>'Kode Barang'])
        ->addColumn(['data' => 'nama', 'name'=>'nama', 'title'=>'Nama'])
        ->addColumn(['data' => 'harga', 'name'=>'harga', 'title'=>'Harga'])
        ->addColumn(['data' => 'deskripsi', 'name'=>'deskripsi', 'title'=>'Deskripsi'])
        ->addColumn(['data' => 'column_foto', 'name'=>'column_foto', 'title'=>'Foto', 'orderable'=>false, 'searchable'=>false])
        ->addColumn(['data' => 'column_action', 'name'=>'column_action', 'title'=>'Action', 'orderable'=>false, 'searchable'=>false, 'width'=>'150px']);

        return view('productuser.index')->with(compact('html'));
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
        //
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
        $data['products'] = Product::find($id);
        return view('productuser.show',$data);
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
}
