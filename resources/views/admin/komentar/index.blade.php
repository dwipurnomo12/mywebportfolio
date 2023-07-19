@extends('admin.layouts.main')

@section('container')
<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">Komentar</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="/admin">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/komentar">Publikasi</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/komentar">Komentar</a>
                    </li>
                </ul>

			</div>
			<div class="row">
                <div class="col-lg-12">
                    <div id="ajax-alert" class="alert alert-success alert-dismissable" role="alert" style="display:none"></div>
                    <div id="ajax-alert-error" class="alert alert-danger alert-dismissable" role="alert" style="display:none"></div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Semua Komentar</div>
                        </div>
                        <div class="card-body">
                            <table id="table_id" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Komentar</th>
                                        <th>Balasan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($comments as $comment)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                {{ $comment->body }} <br>
                                                Pada post : <a href="/post/{{ $comment->post->slug }}"target="_blank">{{ $comment->post->judul }}</a>
                                                <form action="/admin/komentar/{{ $comment->id }}" method="POST" id="delete-comment" class="float-right" data-id="{{ $comment->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-link"><u>Hapus</u></button>
                                                </form>
                                            </td>
                                            <td>
                                                <a href="javascript:void(0)" class="btn btn-sm btn-primary my-2" onclick="toggleReplyForm({{ $comment->id }})">Balas Komentar</a>
                                                <a href="javascript:void(0)" class="btn btn-sm btn-success my-2" onclick="toggleReplies({{ $comment->id }})">Lihat Balasan</a>
                                                @if($comment->replies->count() > 0)
                                                    <div id="replies{{ $comment->id }}" class="my-3" style="display: none;">
                                                        @foreach ($comment->replies as $reply)
                                                        <div style="display: flex; align-items: center;">
                                                            <div style="flex: 1;">
                                                                @if ($reply->user_id)
                                                                    <p><i class="fas fa-user-check"></i> : {{ $reply->body }} </p>
                                                                @else
                                                                    <p><i class="fas fa-user"></i> : {{ $reply->body }}</p>
                                                                @endif
                                                            </div>
                                                            <form action="/admin/komentar/{{ $reply->id }}/reply" method="POST" class="delete-reply-form" data-id="{{ $reply->id }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-link"><u>Hapus</u></button>
                                                            </form>
                                                        </div>
                                                        <hr>
                                                        @endforeach                                                    
                                                    </div>
                                                @else
                                                    <div id="replies{{ $comment->id }}" class="mt-2" style="display: none; ">
                                                        <p style="text-align: center">Tidak Ada Balasan</p>
                                                    </div>
                                                @endif

                                                <div id="replyForm{{ $comment->id }}" style="display: none;">
                                                    <form action="/admin/komentar/{{$comment->id}}" id="replyForm" data-comment-id="{{ $comment->id }}" method="POST">
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label for="body" class="form-label">Komentar :</label>
                                                            <textarea class="form-control" id="body" name="body" rows="3"></textarea>
                                                        </div>
                                                        <input type="hidden" name="comment_id" value="{{ $comment->id }}">

                                                        <button type="submit" class="btn btn-sm btn-primary">Kirim Balasan</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>

<!-- Datatables Jquery -->
<script>
    $(document).ready(function(){
        $('#table_id').DataTable();
    });
</script>


<!-- Show form balas Komentar -->
<script>
    function toggleReplies(commentId) {
        const repliesDiv = document.getElementById('replies' + commentId);
        if (repliesDiv.style.display === 'none') {
            repliesDiv.style.display = 'block';
        } else {
            repliesDiv.style.display = 'none';
        }
    }

    function toggleReplyForm(commentId) {
        const replyForm = document.getElementById('replyForm' + commentId);
        if (replyForm.style.display === 'none') {
            replyForm.style.display = 'block';
        } else {
            replyForm.style.display = 'none';
        }
    }
</script>


<!-- Balas Komentar -->
<script>
    $(document).on('submit', '#replyForm', function (e) {
        e.preventDefault(); 

        var form = $(this);
        var url = form.attr('action');
        var commentId = form.data('comment-id');

        var formData = form.serialize();

        $.ajax({
            type: "POST",
            url: url,
            data: formData,
            dataType: 'json',
            success: function (response) {
                const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-right',
                                iconColor: '#a5dc86',
                                customClass: {
                                    popup: 'colored-toast'
                                },
                                showConfirmButton: false,
                                timer: 1500,
                                timerProgressBar: true
                            });

                            Toast.fire({
                                icon: 'success',
                                title: 'Komentar Berhasil Ditambahkan !'
                            });

                            
                    var repliesContainer = $('#replies' + commentId);

                    if (repliesContainer.length) {
                        var newReply = '<p><i class="fas fa-user"></i> : ' + response.comment.body + '</p><hr>';
                        repliesContainer.append(newReply);
                    } else {
                        var newContainer = '<div id="replies' + commentId + '" class="mb-3">';
                        newContainer += '<p><i class="fas fa-user"></i> : ' + response.comment.body + '</p><hr>';
                        newContainer += '</div>';
                        form.closest('.media-body').append(newContainer);
                    }
                    form.find('textarea[name="body"]').val('');
            },
            error: function (xhr, status, error) {
                var response = JSON.parse(xhr.responseText);
                var errorMessage = response.message;

                    // Tampilkan pesan error dalam alert toast
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-right',
                        iconColor: '#dc3545',
                        customClass: {
                            popup: 'colored-toast'
                        },
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });

                    Toast.fire({
                        icon: 'error',
                        title: 'Opppss.. Gagal Membalas Komentar !'
                    });
            }
        });
    });
</script>

<!-- Delete Comment Reply -->
<script>
    $(document).ready(function(){
        $('#delete-comment').on('submit', function(event){
            event.preventDefault();

            var form = $(this);
            var commentId = form.data('id');

            Swal.fire({
                title: 'Apakah Kamu Yakin?',
                text: "ingin menghapus Komentar ini!",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: 'TIDAK',
                confirmButtonText: 'YA, HAPUS!'
            }).then((result) => {
                if(result.isConfirmed){
                    $.ajax({
                        type: 'POST',
                        url: form.attr('action'),
                        data: form.serialize(),
                        success: function(response) {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-right',
                                iconColor: '#a5dc86',
                                customClass: {
                                    popup: 'colored-toast'
                                },
                                showConfirmButton: false,
                                timer: 1500,
                                timerProgressBar: true
                            });

                            Toast.fire({
                                icon: 'success',
                                title: 'Komentar Berhasil Dihapus !'
                            });

                            setTimeout(function() {
                                location.reload();
                            }, 1500); 
                        },
                        error: function (xhr, status, error) {
                            var response = JSON.parse(xhr.responseText);
                            var errorMessage = response.message;

                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-right',
                                iconColor: '#dc3545',
                                customClass: {
                                    popup: 'colored-toast'
                                },
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true
                            });

                            Toast.fire({
                                icon: 'error',
                                title: 'Opppss.. Gagal Menghapus Komentar !'
                            });
                        }
                    });
                }
            });
        });
    });
</script>


<!-- Delete Comment Reply -->
<script>
    $(document).ready(function () {
        var table = $('#table_id').DataTable();

        $('.delete-reply-form').each(function () {
            $(this).on('submit', function (event) {
                event.preventDefault();

                var form = $(this);
                var replyId = form.data('id');

                Swal.fire({
                    title: 'Apakah Kamu Yakin?',
                    text: "ingin menghapus Balasan Komentar ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'TIDAK',
                    confirmButtonText: 'YA, HAPUS!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'DELETE',
                            url: form.attr('action'),
                            data: form.serialize(),
                            success: function(response) {
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-right',
                                    iconColor: '#a5dc86',
                                    customClass: {
                                        popup: 'colored-toast'
                                    },
                                    showConfirmButton: false,
                                    timer: 1500,
                                    timerProgressBar: true
                                });

                                Toast.fire({
                                    icon: 'success',
                                    title: 'Komentar Berhasil Dihapus !'
                                });

                                setTimeout(function() {
                                    location.reload();
                                }, 1500); 
                            },
                            error: function (xhr, status, error) {
                                var response = JSON.parse(xhr.responseText);
                                var errorMessage = response.message;

                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-right',
                                    iconColor: '#dc3545',
                                    customClass: {
                                        popup: 'colored-toast'
                                    },
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true
                                });

                                Toast.fire({
                                    icon: 'error',
                                    title: 'Opppss.. Gagal Menghapus Komentar !'
                                });
                            }
                        });
                    }
                });
            });
        });
    });
</script>


@endsection