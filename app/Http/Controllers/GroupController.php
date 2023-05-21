<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\GroupProduct;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Grup';
        $subtitle = 'Halaman Grup';
        return view('moduls.group.index', [
            'title' => $title,
            'subtitle' => $subtitle
        ]);
    }

    public function getGroups(Request $request)
    {
        if ($request->ajax()) {
            $data = Group::latest()->get();
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Buat Grup';
        $subtitle = 'Form Buat Grup';

        return view('moduls.group.create', [
            'title' => $title,
            'subtitle' => $subtitle
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Group::updateOrCreate(
            [
                'id' => $request->group_id
            ],
            [
                'name' => $request->name
            ]
        );

        return response()->json(['success' => 'Berhasil menyimpan grup']);
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
    public function edit($id)
    {
        // return view('moduls.group.edit', compact('group'));
        $group = Group::find($id);
        return response()->json($group);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Group $group)
    {
        // $request->validate([
        //     'name' => 'required'
        // ]);

        // $group->update($request->all());

        // return redirect()->route('groups.index')->with('success', 'Berhasil mengubah grup');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Group::find($id)->delete();

        return response()->json(['success' => 'Berhasil menghapus grup']);
    }


    public function getSearchGroups(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $groups = Group::orderby('name', 'asc')->select('id', 'name')->limit(5)->get();
        } else {
            $groups = Group::orderby('name', 'asc')->select('id', 'name')->where('name', 'like', '%' . $search . '%')->limit(5)->get();
        }

        $response = array();
        foreach ($groups as $group) {
            $response[] = array(
                "id" => $group->id,
                "text" => $group->name
            );
        }
        return response()->json($response);
    }

    public function getSelectGroups(Request $request)
    {
        $search = $request->search;
        $product_id = $request->product_id;

        if ($search == '') {
            $groups = GroupProduct::with(['product', 'group'])
                ->where('product_id', $product_id)
                ->limit(5)
                ->get();
        } else {
            $groups = GroupProduct::whereHas('group', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orderby('name', 'asc');
            })
                ->where('product_id', $product_id)
                ->limit(5)
                ->get();
        }

        $response = array();
        foreach ($groups as $group) {
            $response[] = array(
                "id" => $group->group->id,
                "text" => $group->group->name
            );
        }
        return response()->json($response);
    }
}
