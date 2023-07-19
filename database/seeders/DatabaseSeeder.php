<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\About;
use App\Models\Contact;
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

        Contact::create([
            'linkedIn'       => 'LinkedIn',
            'whatsapp'       => 'Whatsapp',
            'github'         => 'Github',
            'maps_link'      => 'https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d480.0667962022264!2d110.01783319529528!3d-7.7823405883458525!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sid!4v1688263101722!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade',
            'linkedIn_link'  => 'https://www.linkedin.com/in/dwi-purnomo-094119268/',
            'whatsapp_link'  => 'https://wa.me/+6281229248179',
            'github_link'    => 'https://github.com/dwipurnomo12'
        ]);
    }
}
