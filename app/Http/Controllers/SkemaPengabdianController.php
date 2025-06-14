<?php

namespace App\Http\Controllers;

use App\Models\SkemaPengabdian;
use Illuminate\Http\Request;

class SkemaPengabdianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = SkemaPengabdian::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            if (trim($search) === '') {
                return redirect()->route('skemaPengabdian.index')->with('search_error', 'Input pencarian tidak boleh kosong.');
            }
            $query->where('skema_pengabdian', 'like', "%{$search}%");
        }

        $skemas = $query->get();

        return view('skemaPengabdian.index', compact('skemas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('skemaPengabdian.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'skema_pengabdian' => 'required|string|max:255',
        ]);

        SkemaPengabdian::create($request->only('skema_pengabdian'));

        return redirect()->route('skemaPengabdian.index')->with('success', 'Skema berhasil ditambahkan.');

    }

    /**
     * Display the specified resource.
     */
    public function show(SkemaPengabdian $skemaPengabdian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SkemaPengabdian $skemaPengabdian)
    {
        return view('skemaPengabdian.edit', ['skema' => $skemaPengabdian]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SkemaPengabdian $skemaPengabdian)
    {
         $request->validate([
            'skema_pengabdian' => 'required|string|max:255',
        ]);

        $skemaPengabdian->update($request->only('skema_pengabdian'));

        return redirect()->route('skemaPengabdian.index')->with('success', 'Skema berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SkemaPengabdian $skemaPengabdian)
    {
        $skemaPengabdian->delete();

        return redirect()->route('skemaPengabdian.index')->with('success', 'Skema berhasil dihapus.');
    }
}
