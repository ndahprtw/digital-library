<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::create([
            'judul' => 'Laskar Pelangi',
            'penulis' => 'Andrea Hirata',
            'penerbit' => 'Bentang Pustaka',
            'tahun_terbit' => 2005,
            'stok' => 10,
            'category_id' => 1,
        ]);

        Book::create([
            'judul' => 'Bumi',
            'penulis' => 'Tere Liye',
            'penerbit' => 'Gramedia',
            'tahun_terbit' => 2014,
            'stok' => 8,
            'category_id' => 1,
        ]);

        Book::create([
            'judul' => 'Naruto Vol. 1',
            'penulis' => 'Masashi Kishimoto',
            'penerbit' => 'Elex Media',
            'tahun_terbit' => 2000,
            'stok' => 15,
            'category_id' => 2,
        ]);

        Book::create([
            'judul' => 'Laravel Up & Running',
            'penulis' => 'Matt Stauffer',
            'penerbit' => "O'Reilly",
            'tahun_terbit' => 2023,
            'stok' => 5,
            'category_id' => 4,
        ]);

        Book::create([
            'judul' => 'Sejarah Indonesia Modern',
            'penulis' => 'M.C. Ricklefs',
            'penerbit' => 'UGM Press',
            'tahun_terbit' => 2008,
            'stok' => 7,
            'category_id' => 3,
        ]);

        Book::create([
            'judul' => 'Matematika Dasar',
            'penulis' => 'Bambang Riyanto',
            'penerbit' => 'Erlangga',
            'tahun_terbit' => 2020,
            'stok' => 12,
            'category_id' => 3,
        ]);
    }
}
