<?php

namespace App\Http\Controllers;

use App\Models\GroupProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use DataTables;

use function PHPUnit\Framework\isEmpty;

class ProductController extends Controller
{
    public function getProducts(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::with(['type', 'groups'])->latest()->get();

            foreach ($products as $key => $product) {
                $stocks = '';
                foreach ($product['groups'] as $key => $gp) {
                    $stocks = $stocks . 'Stok : ' . $gp['name'] . ' = ' . $gp['pivot']['qty'] . ' pcs, Harga = ' . $gp['pivot']['price'] . '';
                }
                $product['stocks'] = $stocks;
            }

            return DataTables::of($products)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="CheckQty" class="edit btn btn-success btn-sm qtyProduct">Cek Stok Barang</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Ubah</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Hapus</a>';
                    return $btn;
                })
                ->rawColumns(['action'])


                ->make(true);
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $products = Product::with(['type', 'groups'])->latest()->get();


        // foreach ($products as $key => $product) {
        //     $stocks = '';
        //     foreach ($product['groups'] as $key => $gp) {
        //         $stocks = $stocks . 'Stok : ' . $gp['name'] . ' = ' . $gp['pivot']['qty'] . ' pcs, Harga = ' . $gp['pivot']['price'] . '<br>';
        //     }
        //     $product['stocks'] = $stocks;
        // }



        // return response()->json([
        //     // 'data' => $datas,
        //     'data' => $products,

        // ]);


        $title = 'Barang';
        $subtitle = 'Halaman Barang';
        return view('moduls.products.index', [
            'title' => $title,
            'subtitle' => $subtitle
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $group_products = $request->group_product;

        if (count($group_products) < 1) {
            return response()->json([
                'isError' => true,
                'data' => $request->all(),
                'message' => 'Barang minimal mempunyai 1 detail jenis corak, silahkan isi terlebih dahulu.'
            ]);
        }

        foreach ($group_products as $key => $gp) {
            if ($gp['group_id'] == 0) {
                return response()->json([
                    'isError' => true,
                    'data' => $request->all(),
                    'message' => 'Ada jenis corak yang masih kosong, silahkan isi terlebih dahulu.'
                ]);
            }

            if ($gp['qty'] == null) {
                return response()->json([
                    'isError' => true,
                    'data' => $request->all(),
                    'message' => 'Ada kuantitas yang masih kosong, silahkan isi terlebih dahulu.'
                ]);
            }

            if ($gp['price'] == null) {
                return response()->json([
                    'isError' => true,
                    'data' => $request->all(),
                    'message' => 'Ada harga yang masih kosong, silahkan isi terlebih dahulu.'
                ]);
            }
        }

        // if ($request->product_id == null) {
        //     $product =  Product::create($request->all());

        //     foreach ($group_products as $key => $gp) {
        //         $gp['product_id'] = $product->id;
        //         GroupProduct::create($gp);
        //     }
        // }

        return response()->json([
            'isError' => false,
            'data' => $request->all(),
            'message' => 'Berhasil menyimpan barang'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $type = Product::with(['type', 'groups'])->find($id);
        return response()->json($type);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
