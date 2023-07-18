<!-- MENU -->
<nav class="navbar navbar-expand-sm navbar-light">
    <div class="container">
        <a class="navbar-brand" href="/"><i class='uil uil-user'></i>Dwi Purnomo</a>
  
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            <span class="navbar-toggler-icon"></span>
            <span class="navbar-toggler-icon"></span>
        </button>
  
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a href="/" class="nav-link"><span data-hover="Home">Home</span></a>
                </li>

                @foreach ($kategoris as $kategori)
                    <li class="nav-item">
                        <a href="{{ $kategori->slug }}" class="nav-link"><span data-hover="{{ $kategori->slug }}">{{ $kategori->kategori }}</span></a>
                    </li>
                @endforeach
            </ul>
  
            <ul class="navbar-nav ml-lg-auto">
                <div class="ml-lg-4">
                  <div class="color-mode d-lg-flex justify-content-center align-items-center">
                    <i class="color-mode-icon"></i>
                    Color mode
                  </div>
                </div>
            </ul>
        </div>
    </div>
  </nav>