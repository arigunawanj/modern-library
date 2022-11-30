<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mengambil seluruh data yang ada dalam tabel Book
        $book = Book::all();

        // Mengambil seluruh data yang ada dalam tabel Category
        $category = Category::all();

        // Pindah ke halaman book dengan membawa data dari tabel category dan book
        return view('book', compact('book', 'category'));
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
        // Mengambil semua data yang ada di form
        $data = $request->all();

        // Menyimpan foto ke dalam folder img
        $file = $request->file('cover')->store('img');

        // Mengubah penyimpanan foto sesuai isi variabel file
        $data['cover'] = $file;

        // Menyimpan seluruh data form ke dalam database
        Book::create($data);

        // Jika berhasil akan di alihkan ke halaman book
        return redirect('book');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        // Mengambil seluruh data dari Form
        $data = $request->all();

        // Jika foto sudah ada dan ingin diganti
        if($request->hasFile('cover')){

            // Maka Foto akan disimpan ke dalam folder img
            $file = $request->file('cover')->store('img');

            // Foto sebelumnya akan dihapus didalam folder
            Storage::delete($book->cover);

            // Penyimpanan foto akan dirubah sesuai variabel file
            $data['cover'] = $file;

            // Data akan diupdate seluruhnya
            $book->update($data);
        } else {

            // Jika tidak ingin perubahan foto maka kolom foto tidak perlu disertakan
            $book->update([
                'isbn' => $request->isbn,
                'judul' => $request->judul,
                'penerbit' => $request->penerbit,
                'sinopsis' => $request->sinopsis,
                'keterangan' => $request->keterangan,
                'category_id' => $request->category_id,
            ]);
        }

        // Jika salah satu terpenuhi atau berhasil akan dialihkan ke halaman book
        return redirect('book');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        // Menghapus Foto dalam foler
        Storage::delete($book->cover);

        // Menghapus data book di tabel book
        $book->delete();

        // Jika berhasil akan dialihkan ke halaman book
        return redirect('book');
    }

    public function hide($id)
    {
        // Mencari ID dalam tabel Book
        $data = Book::findOrFail($id);

         // Jika Dalam database tampil bernilai 1 maka akan diganti ke 0
        if($data->tampil == 1){
            $data->update([
                'tampil' => 0
            ]);
        } else {
            $data->update([
                'tampil' => 1
            ]);
        }
        // Jika sudah akan dialihkan ke halaman book
        return redirect('book');
    }
}
