@extends('layouts.main')

@section('container')
   <!-- ABOUT -->
   <section class="about full-screen d-lg-flex justify-content-center align-items-center" id="about">
      <div class="container">
        <div class="row">
            @foreach ($abouts as $about)
              <div class="col-lg-7 col-md-12 col-12 d-flex align-items-center">
                <div class="about-text">
                    <h1 class="mr-2">{{ $about->h1 }}</h1>
                    <h4>{{ $about->h4 }}</h4>
                          
                    <p>{{ $about->deskripsi }}</p>
                    
                    <div class="custom-btn-group mt-4">
                      <a href="{{ asset('storage/' . $about->cv) }}" class="btn mr-lg-2 custom-btn"><i class='uil uil-file-alt'></i> Download Resume</a>
                      <a href="#contact" class="btn custom-btn custom-btn-bg custom-btn-link">Hubungi Saya</a>
                    </div>
                </div>
              </div>

              <div class="col-lg-5 col-md-12 col-12">
                  <div class="about-image svg">
                    <img src="{{ asset('storage/' . $about->gambar) }}" class="img-fluid" alt="svg image">
                  </div>
              </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Skills -->
<section class="skills py-5" id="skills">
  <div class="container">
    <div class="row">
      <div class="col-lg-11 text-center mx-auto col-12">
        <div class="col-lg-12 mx-auto mb-5">
          <h2>Skills</h2>
          <p>Keahlian Yang Saya Miliki</p>
          <div class="row justify-content-center my-4"> 
            @foreach ($skills as $skill)
              <div class="col-md-2 my-2 mx-3">
                <img src="{{ asset('/storage' . $skill->logo) }}" alt="" width="120px"; height="120px" class="d-block mx-auto img-icon">
                <h4>{{ $skill->skill }}</h4>
              </div>
            @endforeach
          </div>
        </div>    
      </div>
    </div>
  </div>
</section>


<!-- PROJECTS -->
<section id="Project" class="portfolio-mf sect-pt4 route my-5 py-4">
  <div class="container mb-5">
    <div class="row">
      <div class="col-lg-12 py-4">
        <div class="title-box text-center py-4">
          <h2 class="title-a">
            Portfolio
          </h2>
          <p class="subtitle-a mb-4">
            Beberapa Project Yang Pernah Saya Kerjakan
          </p>
          <div class="line-mf"></div>
        </div>
      </div>
    </div>
    
    <div class="row">
      @foreach ($projects as $portfolio)
        <div class="col-md-4 my-3">
          <div class="work-box">
            <div class="work-img">
              <img src="{{ asset('storage/' . $portfolio->gambar) }}" alt="" class="img-fluid">
            </div>
            <div class="work-content">
              <h3 class="work-title">{{ $portfolio->judul }}</h3><br>
              <a href="detail-project/{{ $portfolio->slug }}" class="btn custom-btn custom-btn-bg custom-btn-link"><i class="bi bi-eye-fill"></i> View Detail</a>
            </div>
          </div>
        </div>
      @endforeach

      <div class="col-lg-12 text-center">
        <a href="/projects" class="btn custom-btn custom-btn-bg custom-btn-link mx-auto mt-5">Lihat Lainnya</a>
      </div>
    </div>
  </div>
</section>
<!--/ Section Portfolio End /-->

<!-- FEATURES -->
<section class="resume py-5 d-lg-flex justify-content-center align-items-center" id="resume">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-12" >
              <h2 class="mb-4 mobile-mt-2">Pendidikan</h2>
                <div class="timeline">
                  @foreach ($pendidikans as $pendidikan)
                    <div class="timeline-wrapper">
                        <div class="timeline-yr">
                          <span>{{ $pendidikan->tahun }}</span>
                        </div>
                        <div class="timeline-info">
                          <h3><span>{{ $pendidikan->nama_sekolah }}</span><small> - {{ $pendidikan->jurusan }}</small></h3>
                          <p>{{ $pendidikan->deskripsi }}</p>
                        </div> 
                    </div>
                  @endforeach
                </div>
            </div>
            <div class="col-lg-6 col-12">
                <h2 class="mb-4">Pekerjaan</h2>
                  <div class="timeline">
                    @foreach ($pekerjaans as $pekerjaan)
                      <div class="timeline-wrapper">
                        <div class="timeline-yr">
                           <span>{{ $pekerjaan->tahun }}</span>
                        </div>
                        <div class="timeline-info">
                           <h3><span>{{ $pekerjaan->nama_perusahaan }}</span><small> - {{ $pekerjaan->posisi }}</small></h3>
                           <p>{{ $pekerjaan->deskripsi }}</p>
                        </div>
                      </div>
                    @endforeach
                  </div>
              </div>
        </div>
    </div>
</section>

<!-- POSTS -->
<section id="posts" class="portfolio-mf sect-pt4 route my-5 py-4">
  <div class="container mb-5">
    <div class="row">
      <div class="col-lg-12 py-4">
        <div class="title-box text-center py-4">
          <h2 class="title-a">
            Posts
          </h2>
          <p class="subtitle-a mb-4">
            Baca Blog Saya
          </p>
          <div class="line-mf"></div>
        </div>
      </div>
    </div>
    
    <div class="row">
      @foreach ($posts as $post)
      <div class="col-lg-3 mb-4">
          <div class="card">
            <a href="/post/{{ $post->slug }}" style="text-decoration: none; color: #5b5b5b;">
              <img class="card-img-top" src="{{ asset('storage/' . $post->gambar) }}" alt="Card image cap">
              <div class="card-body">
                <p class="card-text">{{ $post->user->name }}</p>
                <h5 class="card-title mb-2 fw-mediumbold">{{ $post->judul }}</h5>
                <p class="card-text">{{ $post->excerpt }}</p>
              </div>
            </a>
          </div>
      </div>
      @endforeach
      <div class="col-lg-12 text-center"> 
        <a href="/posts" class="btn custom-btn custom-btn-bg custom-btn-link mx-auto mt-5">Lihat Lainnya</a>
      </div>
    </div>
  </div>
</section>


<!-- CONTACT -->
<section class="contact py-5" id="contact">
  <div class="container">
    <div class="row">
      
      <div class="col-lg-5 mr-lg-5 col-12">
        <div class="google-map w-100">
            <iframe src={{ $contact->maps }}></iframe>
        </div>

        <div class="contact-info d-flex justify-content-between align-items-center py-4 px-lg-5">
            <div class="contact-info-item text-white">
                <a href="{{ $contact->linkedIn }}" class="bi bi-linkedin" data-toggle="tooltip">&nbsp; {{ $contact->linkedIn }}</a><br>
                <a href="{{ $contact->whatsapp }}" class="bi bi-whatsapp" data-toggle="tooltip">&nbsp; {{ $contact->whatsapp }}</a><br>
                <a href="{{ $contact->github }}" class="bi bi-github" data-toggle="tooltip">&nbsp; {{ $contact->github }}2</a>
            </div>
        </div>
      </div>

      <div class="col-lg-6 col-12">
        <div class="contact-form">
          <h2 class="mb-4">Tertarik untuk bekerja sama ? Hubungi saya : </h2>

          <form action="" method="get">
            <div class="row">
              <div class="col-lg-6 col-12">
                <input type="text" class="form-control" name="name" placeholder="Nama Anda" id="name">
              </div>

              <div class="col-lg-6 col-12">
                <input type="email" class="form-control" name="email" placeholder="Email" id="email">
              </div>

              <div class="col-12">
                <textarea name="message" rows="6" class="form-control" id="message" placeholder="Pesan"></textarea>
              </div>

              <div class="ml-lg-auto col-lg-5 col-12">
                <input type="submit" class="form-control submit-btn" value="Kirim">
              </div>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>
</section>
@endsection