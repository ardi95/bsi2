<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use Alert;
use App\Pesan;

use Illuminate\Support\Facades\File;

class ProductController extends Controller
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
            $products = Product::select(['id', 'nama', 'harga', 'deskripsi', 'foto']);
            return Datatables::of($products)
            ->addColumn('column_foto', 'product._columnfoto')
            ->addColumn('column_action', 'product._column_action')
            ->rawColumns(['column_foto', 'column_action'])
            ->make(true);
        }

        $html = $htmlBuilder
        ->addColumn(['data' => 'id', 'name'=>'id', 'title'=>'Kode Barang'])
        ->addColumn(['data' => 'nama', 'name'=>'nama', 'title'=>'Nama'])
        ->addColumn(['data' => 'harga', 'name'=>'harga', 'title'=>'Harga per meter'])
        ->addColumn(['data' => 'deskripsi', 'name'=>'deskripsi', 'title'=>'Deskripsi'])
        ->addColumn(['data' => 'column_foto', 'name'=>'column_foto', 'title'=>'Foto', 'orderable'=>false, 'searchable'=>false])
        ->addColumn(['data' => 'column_action', 'name'=>'column_action', 'title'=>'Action', 'orderable'=>false, 'searchable'=>false, 'width'=>'150px']);

        return view('product.index')->with(compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('product.create');
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
        $this->validate($request, [
            'nama' => 'required',
            'harga' => 'required|numeric',
            'deskripsi' => 'required',
            'foto' => 'required|image'
        ]);

        $data = $request->except([

            '_token',
            'foto'
            
        ]);

        $uploadfoto = $request->file('foto');

        $extension_foto     = $request->foto->extension();
        $hasil_nama_foto    = md5(time());

        $destinationPath = base_path().'/public/upload';
        $uploadfoto->move($destinationPath, $hasil_nama_foto.".".$extension_foto);
        $data['foto'] = $hasil_nama_foto.".".$extension_foto;

        Product::create($data);

        Alert::success('Berhasil menambah data product', 'Berhasil',"success")->persistent('Close');

        return redirect()->route('product.index');
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
        $data['product'] = Product::find($id);
        return view('product.edit',$data);
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
        $this->validate($request, [
            'nama' => 'required',
            'harga' => 'required|numeric',
            'deskripsi' => 'required',
            'foto' => 'image'
        ]);

        $product = Product::find($id);

        $data = $request->except([

            '_token',
            'foto'
            
        ]);

        if ($request->hasFile('foto')) {

            $uploadfoto = $request->file('foto');

            $extension_foto     = $request->foto->extension();
            $hasil_nama_foto    = md5(time());

            $destinationPath = base_path().'/public/upload';
            $uploadfoto->move($destinationPath, $hasil_nama_foto.".".$extension_foto);
            $data['foto'] = $hasil_nama_foto.".".$extension_foto;

            if ($product->foto) {
                // echo "sampe disini";die();
                $filepath = base_path() . DIRECTORY_SEPARATOR .  'public\upload' . DIRECTORY_SEPARATOR . $product->foto;
                // var_dump($filepath);die();
                try {
                    File::delete($filepath);
                } catch (FileNotFoundException $e) {
                    // File sudah dihapus/tidak ada
                }
            }

        }
        else{

            $data['foto'] = $product->foto;

        }

        $product->update($data);

        Alert::success('Berhasil mengubah data product', 'Berhasil',"success")->persistent('Close');

        return redirect()->route('product.index');
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
        $product = Product::find($id);

        $pesan = Pesan::where('product_id','=',$product->id)->count();

        if ($pesan != 0) {
            Alert::error('Tidak dapat menghapus product ini karna masih ada pesanan', 'Tidak Berhasil',"error")->persistent('Close');
            return redirect()->route('product.index');
        }

        $filepath = base_path() . DIRECTORY_SEPARATOR .  'public\upload' . DIRECTORY_SEPARATOR . $product->foto;

        try {
            File::delete($filepath);
        } catch (FileNotFoundException $e) {
            // File sudah dihapus/tidak ada
        }

        $product->delete();
        Alert::success('Berhasil menghapus data product', 'Berhasil',"success")->persistent('Close');

        return redirect()->route('product.index');
    }
}
