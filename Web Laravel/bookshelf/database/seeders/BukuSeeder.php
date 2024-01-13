<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('buku')->insert([
            'judul'=>'Harry Potter',
            'penulis'=>'JK Rowling',
            'tahun_terbit'=>'1998',
            'status_dibaca'=>'0',
            'created_at'=>date('Y-m-d H:i:s')
        ]);

        DB::table('buku')->insert([
            'judul'=>'Bumi',
            'penulis'=>'Tere Liye',
            'tahun_terbit'=>'2014',
            'status_dibaca'=>'1',
            'created_at'=>date('Y-m-d H:i:s')
        ]);
    }
}
