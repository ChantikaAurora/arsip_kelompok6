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
            'skema_penelitian' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Z\s]+$/',
            ],
        ], [
            'skema_penelitian.required' => 'Nama skema penelitian wajib diisi.',
            'skema_penelitian.string' => 'Nama skema penelitian harus berupa teks.',
            'skema_penelitian.max' => 'Nama skema penelitian maksimal 255 karakter.',
            'skema_penelitian.regex' => 'Nama skema penelitian hanya boleh berisi huruf dan spasi.',
        ]);

        // Simpan data skema penelitian
        SkemaPenelitian::create([
            'skema_penelitian' => $request->skema_penelitian,
        ]);

        return redirect()->route('skemaPenelitian.index')->with('success', 'Skema penelitian berhasil ditambahkan.');
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
            'skema_penelitian' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Z\s]+$/',
            ],
        ], [
            'skema_penelitian.required' => 'Nama skema penelitian wajib diisi.',
            'skema_penelitian.string' => 'Nama skema penelitian harus berupa teks.',
            'skema_penelitian.max' => 'Nama skema penelitian maksimal 255 karakter.',
            'skema_penelitian.regex' => 'Nama skema penelitian hanya boleh berisi huruf dan spasi.',
        ]);

        // Perbarui data skema penelitian
        $skemaPenelitian->update([
            'skema_penelitian' => $request->skema_penelitian,
        ]);

        return redirect()->route('skemaPenelitian.index')->with('success', 'Skema penelitian berhasil diperbarui.');
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
