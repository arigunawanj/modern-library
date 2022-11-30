@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @foreach ($book as $item)
            <div class="card ms-3" style="width: 15rem;">
                <img src="{{ asset('storage/'. $item->cover) }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $item->judul }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $item->category->name }}</h6>
                    <p class="card-text">{{ $item->sinopsis }}</p>
                    <p class="card-text">{{ $item->keterangan }}</p>
                    <blockquote class="blockquote mb-2">
                        <footer class="blockquote-footer"><cite title="Source Title">{{ $item->penerbit }}</cite>
                        </footer>
                    </blockquote>
                </div>
            </div>
        @endforeach
        </div>
    </div>
@endsection
