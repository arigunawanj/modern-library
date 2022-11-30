@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <a href="" data-bs-toggle="modal" data-bs-target="#tambahModal" class="btn btn-primary mb-3">Tambah
                    Data</a>
                <div class="card">
                    <div class="card-header">Data Kategori</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">ISBN</th>
                                    <th scope="col">Judul Buku</th>
                                    <th scope="col">Penerbit</th>
                                    <th scope="col">Sinopsis</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Cover</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($book as $item)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $item->isbn }}</td>
                                        <td>{{ $item->judul }}</td>
                                        <td>{{ $item->penerbit }}</td>
                                        <td>{{ $item->sinopsis }}</td>
                                        <td>{{ $item->keterangan }}</td>
                                        <td>{{ $item->category->name }}</td>
                                        <td><img src="{{ asset('storage/'. $item->cover) }}" width="100px" alt=""></td>
                                        <td>
                                            <a href="" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}" class="btn btn-warning">Edit</a>
                                            <a href="/book/{{ $item->id }}" class="btn btn-danger">Hapus</a>
                                            @if ($item->tampil == 1)
                                                <a href="/tampil/{{ $item->id }}" class="btn btn-warning">Sembunyi</a>
                                            @else
                                                <a href="/tampil/{{ $item->id }}" class="btn btn-info">Tampilkan</a>
                                            @endif
                                        </td>
                                    </tr>
                                    {{-- Modal Edit --}}
                                    <!-- Modal -->
                                    <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Buku</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('book.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-3">
                                                            <label class="form-label">ISBN</label>
                                                            <input type="text" class="form-control" value="{{ $item->isbn }}" name="isbn">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Judul Buku</label>
                                                            <input type="text" class="form-control" value="{{ $item->judul }}" name="judul">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Penerbit</label>
                                                            <input type="text" class="form-control" value="{{ $item->penerbit }}" name="penerbit">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Sinopsis</label>
                                                            <input type="text" class="form-control" value="{{ $item->sinopsis }}" name="sinopsis">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Keterangan</label>
                                                            <input type="text" class="form-control" value="{{ $item->keterangan }}" name="keterangan">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Kategori</label>
                                                            <select name="category_id" class="form-select" id="">
                                                                @foreach ($category as $data)
                                                                <option value="{{ $data->id }}" @selected($data->id == $item->category_id)>{{ $data->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Foto</label>
                                                            <input type="file" class="form-control" name="cover">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="">Foto Sebelumnya : </label>
                                                        </div>
                                                        <div class="mb-3">
                                                            <img src="{{ asset('storage/'. $item->cover) }}" width="100px" alt="">
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Kategori</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('book.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">ISBN</label>
                            <input type="text" class="form-control" name="isbn">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Judul Buku</label>
                            <input type="text" class="form-control" name="judul">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Penerbit</label>
                            <input type="text" class="form-control" name="penerbit">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sinopsis</label>
                            <input type="text" class="form-control" name="sinopsis">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Keterangan</label>
                            <input type="text" class="form-control" name="keterangan">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <select name="category_id" class="form-select" id="">
                                @foreach ($category as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Foto</label>
                            <input type="file" class="form-control" name="cover">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
