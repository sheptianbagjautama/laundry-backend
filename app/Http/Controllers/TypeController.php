<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Http\JsonResponse;

class TypeController extends Controller
{

    public function getTypes(Request $request)
    {
        if ($request->ajax()) {
            $data = Type::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editType">Ubah</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteType">Hapus</a>';

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
        $title = 'Tipe';
        $subtitle = 'Halaman Tipe';
        return view('moduls.type.index', [
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
        Type::updateOrCreate(
            [
                'id' => $request->type_id
            ],
            [
                'name' => $request->name
            ]
        );

        return response()->json(['success' => 'Berhasil menyimpan tipe']);
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
        $type = Type::find($id);
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
        Type::find($id)->delete();

        return response()->json(['success' => 'Berhasil menghapus tipe']);
    }

    public function getSearchTypes(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $types = Type::orderby('name', 'asc')->select('id', 'name')->limit(5)->get();
        } else {
            $types = Type::orderby('name', 'asc')->select('id', 'name')->where('name', 'like', '%' . $search . '%')->limit(5)->get();
        }

        $response = array();
        foreach ($types as $type) {
            $response[] = array(
                "id" => $type->id,
                "text" => $type->name
            );
        }
        return response()->json($response);
    }
}
