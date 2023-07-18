<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\About;
use App\Models\Skill;
use App\Models\Status;
use App\Models\Kategori;
use App\Models\Pekerjaan;
use App\Models\Pendidikan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name'      => 'Dwi Purnomo',
            'email'     => 'purnomodwi174@gmail.com',
            'password'  => bcrypt('dw10pkrm')
        ]);

        About::create([
            'h1'        => 'Saya, Dwi Purnomo',
            'h4'        => 'Seorang Junior Web Developer',
            'deskripsi' => 'Pengembangan website adalah bidang yang saya minati dan saya senang menghadapi tantangan yang terkait. Saya selalu bersemangat untuk belajar dan menerapkan teknologi terbaru dalam menciptakan pengalaman pengguna yang menarik dan responsi',
            'gambar'    => '/gambar/undraw_multitasking_re_ffpb.svg',
            'cv'        => 'cv/CV Dwi Purnomo.pdf'
        ]);
    
        Pendidikan::create([
            'nama_sekolah'  => 'Universitas Muhammadiyah Purworejo',
            'tahun'         => 2023,
            'jurusan'       => 'Teknologi Informasi',
            'deskripsi'     => 'Saya sedang menempuh pendidikan Sarjana Program Studi Teknologi Informasi di Universitas Muhammadiyah Purworejo'
        ]);

        Pekerjaan::create([
            'nama_perusahaan'   => 'Freelance',
            'posisi'            => 'Web Developer',
            'tahun'             => 2023,
            'deskripsi'         => 'Saat ini saya bekerja sebagai freelance atau pekerja lepas di bidang pengembagan website (Web Development)'
        ]);

        Status::create([
            'status'    => 'draft'
        ]);

        Status::create([
            'status'    => 'publish'
        ]);

        Kategori::create([
            'kategori'  => 'Laravel',
            'slug'      => 'laravel',
            'deskripsi' => 'Ini adalah deskripsi kategori Laravel',
            'user_id'   => 1
        ]);

        Kategori::create([
            'kategori'  => 'Wordpress',
            'slug'      => 'wordpress',
            'deskripsi' => 'Ini adalah deskripsi kategori Wordpress',
            'user_id'   => 1
        ]);
    }
}
