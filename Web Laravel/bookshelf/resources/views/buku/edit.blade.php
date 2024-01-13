@extends('layout/aplikasi')

@section('konten')    
    <div class="header-create">
        <a href="/buku" class="btn btn-secondary">Kembali</a>
        <h2>Edit Buku</h2>
        <form method="post" action="{{'/buku/'.$data->id}}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="judulBuku" class="form-label">Judul</label>
                <input type="text" class="form-control" id="judul" name="judul" value="{{$data->judul}}">
            </div>
            <div class="mb-3">
                <label for="penulisBuku" class="form-label">Penulis</label>
                <input type="text" class="form-control" id="penulis" name="penulis" value="{{$data->penulis}}">
            </div>
            <div class="mb-3">
                <label for="tahunTerbit" class="form-label">Tahun Terbit</label>
                <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit" value="{{$data->tahun_terbit}}">
            </div>          
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="status_dibaca" name="status_dibaca">
                <label class="form-check-label" for="statusBuku">Selesai dibaca</label>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button class="btn btn-primary me-md-2" id="masukkan" type="submit">Simpan</button>
            </div>
        </form>
    </div>        
    <style>
        form, .header-create {
            margin: 15px;
        }

        h2 {
            margin-top: 15px;
        }
    </style>
@endsection