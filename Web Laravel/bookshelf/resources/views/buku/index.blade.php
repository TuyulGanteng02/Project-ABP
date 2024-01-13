@extends('layout/aplikasi')

@section('konten')
  <main>
    <a href="/buku/create" class="btn btn-primary">Tambah Buku</a>    
    {{-- <section class="bagian_search">
      <h2>Cari Buku</h2>
      <form id="cariBuku">
        <label for="cariJudul">Judul</label>
        <input id="cariJudul" type="text">
        <button id="cariMasukkan" type="submit">Cari</button>
      </form>
    </section> --}}
    
    <section class="rak_buku">
      <h2>Belum selesai dibaca</h2>    
      <div id="belumDibaca" class="book_list">
        @foreach ($belumSelesaiDibaca as $item)
        <div class="book">
          <h1 class="book-title">{{$item->judul}}</h1>  
          <p class="book-author">Nama Penulis : {{$item->penulis}}</p>  
          <p class="book-year">Tahun Terbit : {{$item->tahun_terbit}}</p> 
          <form onsubmit="return confirm('Hapus???')" class="d-inline" action="{{'/buku/'.$item->id}}" method="post">
            @csrf
            @method('DELETE')
            <button class="btn btn-outline-danger" type="submit">Hapus Buku</button>
          </form>          
          <a href='{{url('/buku/'.$item->id.'/edit')}}' class="btn btn-outline-success">Edit Buku</a>
          <a href='{{ url('/buku/'.$item->id) }}' class="btn btn-outline-info">Lihat Buku</a>
        </div>
        @endforeach
      </div>
    </section>
    
    <section class="rak_buku">
      <h2>Selesai dibaca</h2>    
      <div id="sudahDibaca" class="book_list">
        @foreach ($sudahSelesaiDibaca as $item)
          <div class="book">
            <h1 class="book-title">{{$item->judul}}</h1>  
            <p class="book-author">Nama Penulis : {{$item->penulis}}</p>  
            <p class="book-year">Tahun Terbit : {{$item->tahun_terbit}}</p> 
            <form onsubmit="return confirm('Hapus???')" class="d-inline" action="{{'/buku/'.$item->id}}" method="post">
              @csrf
              @method('DELETE')
              <button class="btn btn-outline-danger" type="submit">Hapus Buku</button>
            </form>                      
            <a href='{{url('/buku/'.$item->id.'/edit')}}' class="btn btn-outline-success">Edit Buku</a>
            <a href='{{ url('/buku/'.$item->id) }}' class="btn btn-outline-info">Lihat Buku</a>     
          </div>
        @endforeach
      </div>
    </section>
  </main>
@endsection