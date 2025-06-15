<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $data = ['Teknologi', 'Politik', 'Ekonomi', 'Olahraga', 'Hiburan'];

        foreach ($data as $nama) {
            Kategori::create(['nama' => $nama]);
        }
    }
}

