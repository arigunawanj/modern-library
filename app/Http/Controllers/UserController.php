<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mengambil seluruh data di dalam tabel user
        $user = User::all();
        return view('user', compact('user'));
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
        // Membuat deklarasi yang isinya mengambil seluruh data pada form
        $data = $request->all();
        
        // Menyimpan data ke tabel user
        User::create($data);

        // Jika berhasil akan dialihkan ke halaman user
        return redirect('user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // Jika Password ada dan ingin diganti
        if($request->password){

            // Maka mengambil seluruh data yang ada dalam form
            $data = $request->all();

            // Data Password akan dirubah menggunakan Hash
            $data['password'] = Hash::make($request->password);

            // Setelah itu data baru diupdate
            $user->update($data);
        } else {
            // Jika tidak ingin perubahan maka password tidak disertakan dalam update
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
            ]);
        }

        return redirect('user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // Menghapus data di tabel User
        $user->delete();

        // Jika berhasil akan dialihkan ke dalam halaman user
        return redirect('user');
    }
}
