@extends('layouts.main')

@section('container')

<section id="Project" class="portfolio-mf sect-pt4 route my-5 py-4">
    <div class="container mb-5">
      <div class="row justify-content-center">
        <div class="col-lg-10 py-4">
          <div class="title-box py-4">
            <h2 class="title-a">
              {{ $project->judul }}
            </h2>
            <div class="line-mf"></div>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <img src="{{ asset('storage/' . $project->gambar) }}" alt="" class="img-fluid" style="max-height: 400px">
            </div>
            <div class="col-lg-6">
              <p class="text-left">{!! $project->deskripsi !!}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  

@endsection
