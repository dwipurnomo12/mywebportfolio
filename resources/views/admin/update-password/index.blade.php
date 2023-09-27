@extends('admin.layouts.main')

@section('container')
<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">Project</h4>
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
                        <a href="/admin/update-password">Update Password</a>
                    </li>
                </ul>
			</div>
			<div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Update Password</div>
                        </div>
                        <div class="card-body">
                            <form action="/admin/update-password" method="POST" id="updatePassword">
                                @method('put')
                                @csrf

                                <div class="mb-3">
                                    <label for="current_password" class="form-label @error('current_password') is-invalid @enderror">Masukkan Password Lama</label>
                                    <input type="password" class="form-control" id="current_password" name="current_password" required>
                                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-current_password"></div>
                                </div>
                        
                                <div class="mb-3">
                                    <label for="passwordNew" class="form-label @error('passwordNew') is-invalid @enderror">Masukkan password Baru</label>
                                    <input type="password" class="form-control" id="passwordNew" name="passwordNew" required>
                                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-passwordNew"></div>
                                </div>
                        
                                <div class="mb-3">
                                    <label for="konfirmasiPassword" class="form-label @error('konfirmasiPassword') is-invalid @enderror">konfirmasi password</label>
                                    <input type="password" class="form-control" id="konfirmasiPassword" name="konfirmasiPassword" required>
                                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-konfirmasiPassword"></div>
                                </div>
                        
                                <button type="submit" class="btn btn-primary mb-5 float-end">Reset Password</button>
                            </form>
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function(){
    $('#updatePassword').on('submit', function(e){
        e.preventDefault();

        let current_password    = $('#current_password').val();            
        let passwordNew         = $('#passwordNew').val();            
        let konfirmasiPassword  = $('#konfirmasiPassword').val();
        let token               = $("meta[name='csrf-token']").attr("content");

        let formData = new FormData();
        formData.append('current_password', current_password);
        formData.append('passwordNew', passwordNew);
        formData.append('konfirmasiPassword', konfirmasiPassword);
        formData.append('_token', token);

        $.ajax({
            url: '/admin/update-password',
            type: "POST",
            cache: false,
            data: formData,
            contentType: false,
            processData: false,

            success:function(response, textStatus, xhr){
                if (xhr.status === 200) {
                    $('#current_password').val('');
                    $('#passwordNew').val('');
                    $('#konfirmasiPassword').val('');

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
            error:function(error){
                if (error.responseJSON && error.responseJSON.current_password) {
                    $('#alert-current_password').removeClass('d-none');
                    $('#alert-current_password').text(error.responseJSON.current_password);
                }

                if (error.responseJSON && error.responseJSON.passwordNew) {
                    $('#alert-passwordNew').removeClass('d-none');
                    $('#alert-passwordNew').text(error.responseJSON.passwordNew);
                }

                if (error.responseJSON && error.responseJSON.konfirmasiPassword) {
                    $('#alert-konfirmasiPassword').removeClass('d-none');
                    $('#alert-konfirmasiPassword').text(error.responseJSON.konfirmasiPassword);
                }
            }
        });
    });
});

</script>

@endsection