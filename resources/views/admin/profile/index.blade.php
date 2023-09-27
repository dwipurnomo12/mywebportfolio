@extends('admin.layouts.main')

@section('container')
<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">Profil</h4>
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
                        <a href="/admin/profile">Profil</a>
                    </li>
                </ul>
			</div>
            <form action="/admin/profile/{{ $profile->id }}" method="POST" id="profile-form" enctype="multipart/form-data">
                @method('put')
                @csrf

                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Profile Ku</div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" class="form-control" name="name" id="name" value="{{ $profile->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" value="{{ $profile->email }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Photo</div>
                            </div>
                            <div class="card-body">
                                <img src="{{ asset('storage/' . $profile->profile_photo_path) }}" alt="Foto Profil" id="preview" class="img-fluid rounded mb-5" width="100%" height="100%">

                                <div class="input-group mb-3">
                                    <input type="file" class="form-control" id="profile_photo_path" name="profile_photo_path" onchange="previewImage()">
                                    <label class="input-group-text" for="profile_photo_path">Upload</label>
                                </div>
                            </div>
                            <div class="card-action">
                                <button type="submit" class="btn btn-success float-right is-loading:none">Simpan</button>
                            </div>
                        </div>
                    </div>      
                </div>
            </form>
		</div>
	</div>
</div>

<!-- Image Live Preview -->
<script>
    function previewImage(){
        preview.src = URL.createObjectURL(event.target.files[0]);
    }
</script>

<!-- Update Profile -->
<script>
    $(document).ready(function(){
        $('#profile-form').on('submit', function(e){
            e.preventDefault();

            var form     = $(this);
            var url      = form.attr('action');
            var method   = form.attr('method');
            var formData = new FormData(form[0]);

            var submitButton = form.find('button[type="submit"]');
            submitButton.addClass('is-loading');

            $.ajax({
                url: url,
                type: method,
                data: formData,
                processData: false,
                contentType: false,
                success: function(response){
                    if(response.success){
                        submitButton.removeClass('is-loading');
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-right',
                            iconColor: '#a5dc86',
                            customClass: {
                                popup: 'colored-toast'
                            },
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true
                        });

                        Toast.fire({
                            icon: 'success',
                            title: 'Berhasil Mengupdate Data'
                        }).then(function() {
                            $('html, body').animate({ scrollTop: 0 }, 'slow');
                        });
                    }
                },
                error: function (xhr, status, error) {
                        submitButton.removeClass('is-loading');
                        var errorMessage = JSON.parse(xhr.responseText);

                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-right',
                            iconColor: '#dc3545',
                            customClass: {
                                popup: 'colored-toast'
                            },
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true
                        });

                        var errorMessages = Object.values(errorMessage);
                        var message = errorMessages[0]; 
                        Toast.fire({
                            icon: 'error',
                            title: message
                        });
                    },
                    complete: function(){
                        submitButton.removeClass('is-loading');
                    }
            });
        });
    });
</script>
@endsection