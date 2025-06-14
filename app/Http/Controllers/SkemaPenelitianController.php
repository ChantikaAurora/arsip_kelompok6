<?php

namespace App\Http\Controllers;

use App\Models\SkemaPenelitian;
use Illuminate\Http\Request;

class SkemaPenelitianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = SkemaPenelitian::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            if (trim($search) === '') {
                return redirect()->route('skemaPenelitian.index')->with('search_error', 'Input pencarian tidak boleh kosong.');
            }
            $query->where('skema_penelitian', 'like', "%{$search}%");
        }

        $skemas = $query->get();

        return view('skemaPenelitian.index', compact('skemas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('skemaPenelitian.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'skema_penelitian' => 'required|string|max:255',
        ]);

        SkemaPenelitian::create($request->only('skema_penelitian'));

        return redirect()->route('skemaPenelitian.index')->with('success', 'Skema berhasil ditambahkan.');

    }

    /**
     * Display the specified resource.
     */
    public function show(SkemaPenelitian $skemaPenelitian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SkemaPenelitian $skemaPenelitian)
    {
        return view('skemaPenelitian.edit', ['skema' => $skemaPenelitian]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SkemaPenelitian $skemaPenelitian)
    {
         $request->validate([
            'skema_penelitian' => 'required|string|max:255',
        ]);

        $skemaPenelitian->update($request->only('skema_penelitian'));

        return redirect()->route('skemaPenelitian.index')->with('success', 'Skema berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SkemaPenelitian $skemaPenelitian)
    {
        $skemaPenelitian->delete();

        return redirect()->route('skemaPenelitian.index')->with('success', 'Skema berhasil dihapus.');
    }
}
