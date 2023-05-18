<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class ProductController extends Controller
{
    public function getProducts(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Ubah</a>';

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

        return response()->json([
            'isError' => false,
            'data' => $request->all(),
            'message' => 'berhasil'
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
        //
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
