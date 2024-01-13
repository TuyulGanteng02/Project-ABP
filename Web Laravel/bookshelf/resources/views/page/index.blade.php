@extends('layout/aplikasi')

@section('konten')
<header class="head_bar">
    <h1 class="head_bar__title">Rak Buku</h1>
  </header>
  <main>
    <section class="bagian_input">
      <h2>Masukkan Buku Baru</h2>
      <form id="masukkanBuku">
        <div class="input">
          <label for="judulBuku">Judul</label>
          <input id="judulBuku" type="text" required>
        </div>
        <div class="input">
          <label for="penulisBuku">Penulis</label>
          <input id="penulisBuku" type="text" required>
        </div>
        <div class="input">
          <label for="tahunTerbit">Tahun</label>
          <input id="tahunTerbit" type="number" required>
        </div>
        <div class="input_inline">
          <label for="statusBuku">Selesai dibaca</label>
          <input id="statusBuku" type="checkbox">
        </div>
        <button id="masukkan" type="submit">Masukkan Buku ke Rak</button>
      </form>
    </section>
    
    <section class="bagian_search">
      <h2>Cari Buku</h2>
      <form id="cariBuku">
        <label for="cariJudul">Judul</label>
        <input id="cariJudul" type="text">
        <button id="cariMasukkan" type="submit">Cari</button>
      </form>
    </section>
    
    <section class="rak_buku">
      <h2>Belum selesai dibaca</h2>    
      <div id="belumDibaca" class="book_list">
        <h1 class="book-title"></h1>  
        <p class="book-author">Nama Penulis : </p>  
        <p class="book-year">Tahun Terbit : </p> 
        <button class="edit-btn">Edit buku</button> 
        <button class="delete-btn">Hapus buku</button>
      </div>
    </section>
    
    <section class="rak_buku">
      <h2>Selesai dibaca</h2>    
      <div id="sudahDibaca" class="book_list">
        <h1 class="book-title"></h1>  
        <p class="book-author">Nama Penulis : </p>  
        <p class="book-year">Tahun Terbit : </p> 
        <button class="edit-btn">Edit buku</button> 
        <button class="delete-btn">Hapus buku</button>
      </div>
    </section>
  </main>
@endsection