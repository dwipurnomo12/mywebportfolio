<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\About;
use App\Models\Skill;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

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
    
    }
}
