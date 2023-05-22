<?php

namespace App\Http\Controllers;

use App\Models\GroupProduct;
use App\Models\ItemReceive;
use Illuminate\Http\Request;
use DataTables;

class ItemReceiveController extends Controller
{
    public function getItemReceive(Request $request)
    {
        if ($request->ajax()) {
            $item_receives = ItemReceive::with(['product', 'group'])->latest()->get();

            return DataTables::of($item_receives)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteItemReceive">Hapus</a>';
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
        // $item_receives = ItemReceive::with(['product', 'group'])->latest()->get();
        // return response()->json([
        //     'data' => $item_receives
        // ]);


        $title = 'Penerimaan Barang';
        $subtitle = 'Halaman Penerimaan Barang';
        return view('moduls.itemreceives.index', [
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
        ItemReceive::create($request->all());

        $group_product = GroupProduct::where('product_id', $request->product_id)
            ->where('group_id', $request->group_id)->get();

        if (count($group_product)) {
            $group_product[0]['qty'] += $request->qty;
            $group_product[0]->save();
        }

        return response()->json([
            'isError' => false,
            'data' => $request->all(),
            'group_product' => $group_product,
            'message' => 'Berhasil menyimpan penerimaan barang.'
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
        $type = ItemReceive::with(['product', 'group'])->find($id);
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
        $item_receive = ItemReceive::findOrFail($id);

        //KURANGI STOK TERLEBIH DAHULU SEBELUM HAPUS PENERIMAAN BARANG
        $group_product = GroupProduct::where('product_id', $item_receive->product_id)
            ->where('group_id', $item_receive->group_id);

        $group_product->qty -= $item_receive->qty;
        $group_product->update();

        $item_receive->delete();

        return response()->json([
            'isError' => false,
            'message' => "Berhasil menghapus penerimaan barang."
        ]);
    }
}
