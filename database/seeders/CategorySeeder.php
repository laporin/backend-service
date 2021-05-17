<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Kemacetan',
            'Sampah',
            'Bencana Banjir',
            'Pelanggaran',
            'Kebakaran',
            'Jalan Rusak',
            'Pengemis',
            'Kaki Lima Liar',
            'Kriminal',
            'Lampu Jalan Rusak',
            'Pohon Tumbang',
            'Fasilitas Umum',
            'Parkir Liar',
            'Pelanggaran Izin Bangunan',
            'Joki 3 in 1',
            'Kawasan',
            'Dilarang Merokok',
            'Iklan Tidak Berizin',
            'Makanan Non Higienis',
            'Transjakarta',
            'Potensi Teroris',
            'Fogging DBD',
            'Narkoba',
            'Pajak Kos-kosan',
            'Pencegahan Banjir',
            'Ruang Publik Terpadu Ramah Anak',
            'Hukum',
            'Kearsipan',
            'Kebudayaan dan Pariwisata',
            'Keluarga Berencana dan Keluarga Sejahtera',
            'Kependudukan dan Catatan Sipil',
            'Kesatuan Bangsa dan Politik',
            'Kesehatan',
            'Ketenagakerjaan',
            'Komunikasi dan Informatika',
            'Koperasi dan Usaha Kecil Menengah',
            'Lingkungan Hidup',
            'Olahraga dan Pemuda',
            'Pekerjaan Umum',
            'Pemberdayaan Perempuan dan Perlindungan Anak',
            'Penanaman Modal',
            'Penataan Ruang',
            'Pendidikan',
            'Perdagangan',
            'Perencanaan Pembangunan',
            'Perhubungan',
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(['name' => $category]);
        }
    }
}
