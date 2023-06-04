<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller
{
    public function authSession()
    {
        $user = Auth::user();
        return $user;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Sales';
        $subtitle = 'Halaman Sales';
        return view('moduls.sales.index', [
            'user' => $this->authSession(),
            'title' => $title,
            'subtitle' => $subtitle
        ]);
    }

    public function getSales(Request $request)
    {
        if ($request->ajax()) {
            $data = Sales::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editSales">Ubah</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteSales">Hapus</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Sales::updateOrCreate(
            [
                'id' => $request->sales_id
            ],
            [
                'name' => $request->name,
                'date_of_birth' => $request->date_of_birth,
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
            ]
        );

        return response()->json([
            'isError' => false,
            'data' => $request->all(),
            'message' => 'Berhasil menyimpan sales'
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
        $type = Sales::findOrFail($id);
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
        Sales::find($id)->delete();

        return response()->json([
            'isError' => false,
            'message' => 'Berhasil menghapus sales'
        ]);
    }

    public function getSelectSales(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $sales = Sales::orderby('name', 'asc')->select('id', 'name')->limit(5)->get();
        } else {
            $sales = Sales::orderby('name', 'asc')->select('id', 'name')->where('name', 'like', '%' . $search . '%')->limit(5)->get();
        }

        $response = array();
        foreach ($sales as $s) {
            $response[] = array(
                "id" => $s->id,
                "text" => $s->name
            );
        }
        return response()->json($response);
    }
}
