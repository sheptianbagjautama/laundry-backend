<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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

        $title = 'Akun Pengguna';
        $subtitle = 'Halaman Akun Pengguna';
        return view('moduls.user.index', [
            'user' => $this->authSession(),
            'title' => $title,
            'subtitle' => $subtitle
        ]);
    }

    public function getUser(Request $request)
    {
        if ($request->ajax()) {
            $data = User::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editUser">Ubah</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteUser">Hapus</a>';

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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->user_id == null) {

            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->type = $request->type;
            $user->save();

            return response()->json([
                'isError' => false,
                'data' => $request->all(),
                'message' => 'Berhasil menyimpan akun pengguna'
            ]);
        } else {
            $user = User::findOrFail($request->user_id);
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->password != null) {
                $user->password = Hash::make($request->password);
            }
            $user->type = $request->type;
            $user->save();

            return response()->json([
                'isError' => false,
                'data' => $request->all(),
                'message' => 'Berhasil mengubah akun pengguna'
            ]);
        }

        return response()->json([
            'isError' => true,
            'data' => $request->all(),
            'message' => 'Ada sesuatu yang salah.'
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
        $type = User::findOrFail($id);
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
        User::find($id)->delete();

        return response()->json([
            'isError' => false,
            'message' => 'Berhasil menghapus akun pengguna'
        ]);
    }
}
