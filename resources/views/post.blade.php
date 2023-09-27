@extends('layouts.main')

@section('container')

<section id="posts" class="portfolio-mf sect-pt4 route my-5 py-4">
    <div class="container mb-5">
      <div class="row">
        <div class="col-lg-8 py-4">
            <p> Post >> {{ $post->judul }} </p>

            <a href="#" type="button" class="btn btn-secondary btn-sm">{{ $post->kategori->kategori }}</a>

            <h1>{{ $post->judul }}</h1>
            <p class="mb-5 d-flex justify-content-between">
                {{ $post->user->name }}
                <i class="bi bi-fire">Dibaca {{ $post->views }} Kali</i> 
            </p>

            <img src="{{ asset('storage/' . $post->gambar) }}" alt="Gambar Andalan" class="img-fluid rounded mb-5" width="100%" height="100%">

            <p>{!! $post->body !!}</p>

            <div id="social-links" class="my-5"> 
                <h6 class="my-4"><i class="bi bi-share"></i>  Share Post : </h6>
                <ul>
                    <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url('/post/' . $post->slug)) }}" class="social-button" id=""><span class="bi bi-facebook"></span></a></li>
                    <li><a href="https://twitter.com/intent/tweet?url={{ urlencode(url('/post/' . $post->slug)) }}" class="social-button" id=""><span class="bi bi-twitter"></span></a></li>
                    <li><a href="https://www.linkedin.com/shareArticle?url={{ urlencode(url('/post/' . $post->slug)) }}" class="social-button" id=""><span class="bi bi-linkedin"></span></a></li>
                    <li><a href="https://wa.me/?text={{ urlencode(url('/post/' . $post->slug)) }}" class="social-button" id=""><span class="bi bi-whatsapp"></span></a></li>    
                </ul>
            </div>

            <hr class="line my-5">

            <h5 class="mb-4">Komentar :</h5>

            <div class="container mb-5">
                @foreach ($comments as $comment)
                @php
                    $emailHash = md5(strtolower(trim($comment->email)));
                    $avatarUrl = "https://www.gravatar.com/avatar/{$emailHash}?s=60";
                @endphp
                <div class="media mb-3">
                    <img src="{{ $avatarUrl }}" alt="Avatar" class="mr-3 rounded-circle" width="60">
                    <div class="media-body">
                        <h6 class="mt-0">{{ $comment->nama }} <p><u>{{ $comment->email }}</u></p></h6>
                        <p>{{ $comment->body }}</p>
                        <a href="javascript:void(0)" class="btn btn-sm btn-link float-right" onclick="toggleReplyForm({{ $comment->id }})"><u>Balas Komentar</u></a>
                        
                        @foreach ($comment->replies as $reply)
                            @php
                                $emailHash = md5(strtolower(trim($reply->email)));
                                $avatarUrl = "https://www.gravatar.com/avatar/{$emailHash}?s=60";
                            @endphp
                            <div class="media ml-5 mt-4">
                                <img src="{{ $avatarUrl }}" alt="Avatar" class="mr-3 rounded-circle" width="60">
                                <div class="media-body">
                                    @if ($reply->user_id)
                                        <h6>{{ $reply->nama }} <i class="bi bi-check2-circle"></i> <p><u>{{ $reply->email }}</u></p></h6>
                                    @else
                                        <h6>{{ $reply->nama }} <p><u>{{ $reply->email }}</u></p></h6>
                                    @endif
                                    <p class="mb-2">{{ $reply->body }}</p>
                                </div>
                            </div>
                        @endforeach
                        <hr>
            
                        <!-- Comment Reply -->
                        <div id="replyForm{{ $comment->id }}" style="display: none;">
                            <h6>Balas Komentar :</h6>
                            <form action="/post/{{ $post->slug }}/reply" method="POST">
                                @csrf
                                <input type="hidden" value="{{ $comment->id }}" name="comment_id">
                                <div class="mb-3">
                                    <label for="replyNama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="replyNama" name="replyNama">
                                </div>
                                <div class="mb-3">
                                    <label for="replyEmail" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="replyEmail" name="replyEmail">
                                </div>
                                <div class="mb-3">
                                    <label for="replyBody" class="form-label">Komentar</label>
                                    <textarea class="form-control" id="replyBody" name="replyBody" rows="3"></textarea>
                                </div>
                                <input type="hidden" name="parent_id" value="{{ $comment->id }}">

                                <button type="submit" class="btn btn-sm btn-primary">Kirim Balasan</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            

            <!-- Create a new Coment -->
            <h5 class="mb-4">Tinggalkan Komentar : </h5>
            <form action="/post/{{ $post->slug }}" method="POST">
                @csrf
    
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama">
                    @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
    
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
    
                <div class="mb-3">
                    <label for="body" class="form-label">Komentar</label>
                    <textarea class="form-control @error('body') is-invalid @enderror" id="body" name="body" rows="6"></textarea>
                    @error('body')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
    
                <button type="submit" class="btn btn-primary">Kirim Komentar</button>
            </form>

            <span id="bottom"></span>
        </div>


        <!-- Sidebar -->
        <div class="col-lg-4 py-4">
            <div class="populer-post mb-5">
                <h5>Populer post</h5>
                @foreach ($populerPost as $post)
                <div class="row mt-3">
                    <div class="col-md-5">
                         <img src="{{ asset('storage/' . $post->gambar) }}" width="100%" height="100%">
                    </div>
                    <div class="col-md-7 mt-2">
                        <a href="/post/{{ $post->slug }}" style="color: inherit;"><h6>{{ $post->judul }}</h6></a>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="kategori-list">
                <h5>Kategori</h5>
                <div class="row mt-3">
                    <div class="col">
                        @foreach ($kategoris as $kategori)
                        <ul>
                            <li><p><i class="bi bi-hash"></i> <a href="/kategori/{{ $kategori->kategori }}" style="color: inherit;">{{ $kategori->kategori }}</a></p></li>
                        </ul>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
</section>

<script>
    function toggleReplyForm(commentId) {
        var replyForm = document.getElementById('replyForm' + commentId);
        var formDisplayStyle = window.getComputedStyle(replyForm).getPropertyValue('display');
        if (formDisplayStyle === 'none') {
            replyForm.style.display = 'block';
        } else {
            replyForm.style.display = 'none';
        }
    }
</script>


@endsection