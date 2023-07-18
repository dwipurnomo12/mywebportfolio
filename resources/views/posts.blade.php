@extends('layouts.main')

@section('container')
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
        <a href="/posts" class="btn custom-btn custom-btn-bg custom-btn-link mx-auto mt-5">Lihat Lainnya</a>
      </div>
    </div>
  </section>
@endsection