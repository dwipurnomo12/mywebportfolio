@extends('layouts.main')

@section('container')
<section id="Project" class="portfolio-mf sect-pt4 route my-5 py-4">
    <div class="container mb-5">
      <div class="row">
        <div class="col-lg-12 py-4">
          <div class="title-box text-center py-4">
            <h2 class="title-a">
              Portfolio 
            </h2>
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
                <a href="/detail-project/{{ $portfolio->slug }}" class="btn custom-btn custom-btn-bg custom-btn-link"><i class="bi bi-eye-fill"></i> View Detail</a>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      <div class="pagination justify-content-center my-4">
        {{ $projects->links() }}
      </div>
    </div>
  </section>

@endsection