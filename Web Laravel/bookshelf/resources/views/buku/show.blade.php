@extends('layout/aplikasi')

@section('konten')
    <div class="rak_buku">
        <a href='/buku' class="btn btn-secondary">KEMBALI</a>
        <div class="book">
            <h1 class="book-title">{{$data->judul}}</h1>  
            <p class="book-author">Nama Penulis  : {{$data->penulis}}</p>  
            <p class="book-year">Tahun Terbit : {{$data->tahun_terbit}}</p>
            <p class="book-status">Status dibaca : 
                @if ($data->status_dibaca == 1)
                    Selesai dibaca
                @else
                    Belum selesai dibaca
                @endif
            </p>
        </div>
    </div>
    <style>
        .rak_buku {
            margin: 5px;
        }
        .btn-secondary {
            margin-bottom: 15px;
        }
    </style>
@endsection