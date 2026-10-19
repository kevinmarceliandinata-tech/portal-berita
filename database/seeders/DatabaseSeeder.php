<?php

namespace Database\Seeders;

use App\Models\Agenda;
use App\Models\Album;
use App\Models\Berita;
use App\Models\Kategori;
use App\Models\Pengumuman;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(UserSeeder::class);

        $admin = User::where('email', 'admin@berita.test')->first();
        $penulis = User::where('email', 'user@berita.test')->first();

        foreach (['Politik', 'Ekonomi', 'Olahraga', 'Teknologi'] as $nama) {
            Kategori::create(['nama' => $nama]);
        }

        foreach (range(1, 8) as $i) {
            Berita::create([
                'tanggal' => now()->subDays($i)->toDateString(),
                'judul' => "Contoh Berita Nomor $i",
                'isi' => "Ini isi lengkap berita nomor $i.",
                'kategori_id' => rand(1, 4),
                'user_id' => $i % 2 === 0 ? $admin->id : $penulis->id,
            ]);
        }

        Agenda::create([
            'judul_agenda' => 'Rapat Redaksi Mingguan',
            'isi_agenda' => 'Pembahasan liputan minggu depan.',
            'tanggal_mulai' => now()->addDays(2)->setTime(9, 0),
            'tanggal_selesai' => now()->addDays(2)->setTime(11, 0),
        ]);

        Pengumuman::create([
            'judul' => 'Jadwal Penerbitan Terbaru',
            'isi' => 'Berita diterbitkan setiap hari pukul 08.00 WIB.',
            'status' => 'published',
            'user_id' => $admin->id,
        ]);

        Album::create(['nama_album' => 'Kegiatan Redaksi', 'deskripsi' => 'Dokumentasi kegiatan tim redaksi.']);
    }
}