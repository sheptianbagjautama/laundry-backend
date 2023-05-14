<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $groups = Group::all();
        $title = 'Grup';
        $subtitle = 'Halaman Grup';
        return view('moduls.group.index', [
            'title' => $title,
            'subtitle' => $subtitle
        ]);
    }
    // }

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
        $request->validate([
            'name' => 'required'
        ]);

        Group::create($request->all());

        return redirect()->route('groups.index')->with('success', 'Berhasil menyimpan grup');
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
    public function edit(Group $group): View
    {
        return view('moduls.group.edit', compact('group'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Group $group): RedirectResponse
    {
        $request->validate([
            'name' => 'required'
        ]);

        $group->update($request->all());

        return redirect()->route('groups.index')->with('success', 'Berhasil mengubah grup');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group): RedirectResponse
    {
        $group->delete();

        return redirect()->route('groups.index')->with('success', 'Berhasil menghapus grup');
    }
}
