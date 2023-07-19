@extends('admin.layouts.main')

@section('container')
<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">Section Contact</h4>
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
                        <a href="/admin/section-contact">Landing Page</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/section-contact">Section Contact</a>
                    </li>
                </ul>
			</div>
            <div id="alert-success"></div>
			<div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Live Preview</div>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                  <div class="col-lg-12 mr-lg-5 col-12">
                                    <div class="google-map w-100">
                                        <iframe src={{ $contact->maps_link }}></iframe>
                                    </div>
                                    <div class="contact-info d-flex justify-content-between align-items-center py-4 px-lg-5">
                                        <div class="contact-info-item text-white">
                                            <a href="{{ $contact->linkedIn_link }}" class="bi bi-linkedin" data-toggle="tooltip">&nbsp; {{ $contact->linkedIn }}</a><br>
                                            <a href="{{ $contact->whatsapp_link }}" class="bi bi-whatsapp" data-toggle="tooltip">&nbsp; {{ $contact->whatsapp }}</a><br>
                                            <a href="{{ $contact->github_link }}" class="bi bi-github" data-toggle="tooltip">&nbsp; {{ $contact->github }}</a>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

				<div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Edit Section About</div>
                        </div>
                        <div class="card-body">
                            
                        </div>
                    </div>
                </div>

			</div>
		</div>
	</div>
</div>



<!-- Update Data -->
<script>
    $(document).ready(function(){
        $('#section-about-form').on('submit', function(e){
            e.preventDefault();

            var form        = $(this);
            var url         = form.attr('action');
            var method      = form.attr('method');
            var formData    = new FormData(form[0]);

            $.ajax({
                url: url,
                type: method,
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.success) {
                        var preview  = document.getElementById('gambar-preview');
                        preview.src  = response.image_url;
                        console.log(response.image_url);

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
                            title: 'Sukses'
                        }).then(function() {
                            $('html, body').animate({ scrollTop: 0 }, 'slow');
                        });
                    }
                },
                error: function (xhr, status, error) {
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

                    // Mengambil nilai pesan error dari objek errorMessage
                    var errorMessages = Object.values(errorMessage);
                    var message = errorMessages[0]; // Mengambil pesan pertama dari daftar errorMessages

                    Toast.fire({
                        icon: 'error',
                        title: message
                    });
                }
            });
        });
    });
</script>


@endsection