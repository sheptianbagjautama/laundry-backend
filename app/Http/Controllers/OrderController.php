<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    public function getOrder(Request $request)
    {
        if ($request->ajax()) {
            // $orders = Order::with(['sale', 'orderdetails'])->latest()->get();
            $orders = Order::latest()->get();

            return DataTables::of($orders)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editOrder">Ubah</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteOrder">Hapus</a>';

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
        // $orders = Order::with(['sale', 'orderdetails'])->latest()->get();
        // $orders = Order::with(['sale'])->latest()->get();
        // return response()->json($orders);

        $title = 'Penjualan';
        $subtitle = 'Halaman Penjualan';
        return view('moduls.order.index', [
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
        $order_details = $request->order_details;

        if (count($order_details) < 1) {
            return response()->json([
                'isError' => true,
                'data' => $request->all(),
                'message' => 'penjualan minimal mempunyai 1 penjualan detail, silahkan isi terlebih dahulu.'
            ]);
        }

        foreach ($order_details as $key => $od) {
            if ($od['product_id'] == 0) {
                return response()->json([
                    'isError' => true,
                    'data' => $request->all(),
                    'message' => 'Ada barang yang belum dipilih, silahkan pilih terlebih dahulu.'
                ]);
            }

            if ($od['group_id'] == 0) {
                return response()->json([
                    'isError' => true,
                    'data' => $request->all(),
                    'message' => 'Ada jenis corak barang yang belum dipilih, silahkan pilih terlebih dahulu.'
                ]);
            }

            if ($od['qty'] == null) {
                return response()->json([
                    'isError' => true,
                    'data' => $request->all(),
                    'message' => 'Ada qty yang belum diisi, silahkan isi terlebih dahulu.'
                ]);
            }

            if ($od['total'] == null) {
                return response()->json([
                    'isError' => true,
                    'data' => $request->all(),
                    'message' => 'Ada total yang belum diisi, silahkan isi terlebih dahulu.'
                ]);
            }
        }


        $order = Order::create($request->all());

        $total_price = 0;
        $qty = 0;

        foreach ($order_details as $key => $od) {
            $od['order_id'] = $order->id;
            $od['code'] = $this->generateCode();
            OrderDetail::create($od);
            $total_price += $od['total'];
            $qty += $od['qty'];
        }

        $order->total_price = $total_price;
        $order->total_qty = $qty;
        $order->save();

        return response()->json([
            'isError' => false,
            'data' => $request->all(),
            'message' => 'Berhasil menyimpan penjualan'
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
        $order =  Order::with(['sale', 'orderdetails', 'orderdetails.product', 'orderdetails.group'])->find($id);
        return response()->json($order);
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

    public function code()
    {
        $code = DB::select('SELECT IFNULL(MAX(id),0) + 1 AS nextCode FROM orders');
        $result = "ORD-00" . $code[0]->nextCode;
        return response()->json([
            "data" => $result
        ]);
    }

    public function testing()
    {
        return 'Whyyy';
    }

    private function generateCode()
    {
        $code = DB::select('SELECT IFNULL(MAX(id),0) + 1 AS nextCode FROM order_details');
        $result = "ORDT-00" . $code[0]->nextCode;
        return $result;
    }

    // public function generateUniqueCode()
    // {
    //     $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    //     $charactersNumber = strlen($characters);
    //     $codeLength = 6;

    //     $code = '';

    //     while (strlen($code) < 6) {
    //         $position = rand(0, $charactersNumber - 1);
    //         $character = $characters[$position];
    //         $code = $code . $character;
    //     }

    //     if (Order::where('code', $code)->exists()) {
    //         $this->generateUniqueCode();
    //     }

    //     return $code;
    // }
}
