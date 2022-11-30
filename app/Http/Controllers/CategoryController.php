<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mengambil semua data di tabel Kategori
        $category = Category::all();

        // Pindah ke halaman kategori dan membawa data dari tabel kategori
        return view('kategori', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Memvalidasi Data jika ada
        $data = $request->validate([
            'name' => 'required',
        ]);

        // Setelah di Validasi berhasil, Data akan dimasukkan ke database
        Category::create($data);

        // Jika berhasil dibuat akan di alihkan ke halaman kategori
        return redirect('category');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        // Mengupdate Semua data yang ada dalam tabel Kategori
        $category->update($request->all());

        // Jika berhasil akan dialihkan ke halaman kategori
        return redirect('category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        // Menghapus data yang ada dalam tabel kategori
        $category->delete();

        // Setelah berhasil akan dialihkan ke halaman kategori
        return redirect('category');
    }
}
