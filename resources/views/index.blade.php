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

<!-- PROJECTS -->
<section class="project py-5" id="project">
    <div class="container">
            
            <div class="row">
              <div class="col-lg-11 text-center mx-auto col-12">

                  <div class="col-lg-8 mx-auto mb-4">
                    <h2>Beberapa Project Yang Pernah Saya Kerjakan</h2>
                  </div>

                  <div class="owl-carousel owl-theme">
                    <div class="item">
                      <div class="project-info">
                        <img src="images/project/project-1.png" class="img-fluid" alt="project image">
                      </div>
                    </div>

                    <div class="item">
                      <div class="project-info">
                        <img src="images/project/project-2.png" class="img-fluid" alt="project image">
                      </div>
                    </div>

                    <div class="item">
                      <div class="project-info">
                        <img src="images/project/project-3.png" class="img-fluid" alt="project image">
                      </div>
                    </div>

                    <div class="item">
                      <div class="project-info">
                        <img src="images/project/project-4.png" class="img-fluid" alt="project image">
                      </div>
                    </div>
                  </div>

              </div>
            </div>
    </div>
</section>

<!-- FEATURES -->
<section class="resume py-5 d-lg-flex justify-content-center align-items-center" id="resume">
    <div class="container">
        <div class="row">

            <div class="col-lg-6 col-12" >
              <h2 class="mb-4 mobile-mt-2">Pendidikan</h2>

                <div class="timeline">
                    <div class="timeline-wrapper">
                         <div class="timeline-yr">
                              <span>Now</span>
                         </div>
                         <div class="timeline-info">
                              <h3><span>Universitas Muhammadiyah Purworejo</span><small> - Teknologi Informasi</small></h3>
                              <p>Saya sedang menempuh pendidikan Sarjana Program Studi Teknologi Informasi di Universitas Muhammadiyah Purworejo</p>
                         </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-6 col-12">
                <h2 class="mb-4">Pekerjaan</h2>

                  <div class="timeline">
                      <div class="timeline-wrapper">
                           <div class="timeline-yr">
                                <span>Now</span>
                           </div>
                           <div class="timeline-info">
                                <h3><span>Freelance</span><small>Web Developer</small></h3>
                                <p>Saa ini saya bekerja sebagai freelance atau pekerja lepas di bidang pengembagan website (Web Development)</p>
                           </div>
                      </div>

                  </div>
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
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d480.0667962022264!2d110.01783319529528!3d-7.7823405883458525!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sid!4v1688263101722!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        <div class="contact-info d-flex justify-content-between align-items-center py-4 px-lg-5">
            <div class="contact-info-item text-white">
                <a href="https://www.linkedin.com/in/dwi-purnomo-094119268/" class="bi bi-linkedin" data-toggle="tooltip">&nbsp; dwi-purnomo-094119268</a><br>
                <a href="https://wa.me/+6281229248179" class="bi bi-whatsapp" data-toggle="tooltip">&nbsp; 0812-2924-8179</a><br>
                <a href="https://github.com/dwipurnomo12" class="bi bi-github" data-toggle="tooltip">&nbsp; Dwipurnomo12</a>
            </div>
        </div>
      </div>

      <div class="col-lg-6 col-12">
        <div class="contact-form">
          <h2 class="mb-4">Tertarik untuk bekerja sama ? Hubungi saya : </h2>

          <form action="" method="get">
            <div class="row">
              <div class="col-lg-6 col-12">
                <input type="text" class="form-control" name="name" placeholder="Your Name" id="name">
              </div>

              <div class="col-lg-6 col-12">
                <input type="email" class="form-control" name="email" placeholder="Email" id="email">
              </div>

              <div class="col-12">
                <textarea name="message" rows="6" class="form-control" id="message" placeholder="Message"></textarea>
              </div>

              <div class="ml-lg-auto col-lg-5 col-12">
                <input type="submit" class="form-control submit-btn" value="Send Button">
              </div>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>
</section>
@endsection