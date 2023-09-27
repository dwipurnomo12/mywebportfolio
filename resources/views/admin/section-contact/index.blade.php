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
                            <div class="card-title">Edit Section Contact</div>
                        </div>
                        <div class="card-body">
                            <form action="/admin/section-contact/{{ $contact->id }}" method="POST" id="section-contact-form">
                                @method('put')
                                @csrf

                                <div class="form-group">
                                    <label for="maps_link">Google Maps Locations</label>
                                    <input type="text" class="form-control" id="maps_link" name="maps_link" value="{{ $contact->maps_link }}">
                                </div>
                                <div class="form-group">
                                    <label for="linkedIn_link">linkedIn</label>
                                    <input type="text" class="form-control" id="linkedIn_link" name="linkedIn_link" value="{{ $contact->linkedIn_link }}">
                                </div>
                                <div class="form-group">
                                    <label for="whatsapp_link">Whatsapp</label>
                                    <input type="text" class="form-control" id="whatsapp_link" name="whatsapp_link" value="{{ $contact->whatsapp_link }}">
                                </div>
                                <div class="form-group">
                                    <label for="github_link">Whatsapp</label>
                                    <input type="text" class="form-control" id="github_link" name="github_link" value="{{ $contact->github_link }}">
                                </div>
                                <button type="submit" class="btn btn-primary my-4 float-right is-loading:none">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>

			</div>
		</div>
	</div>
</div>

<!-- Update Section Contact -->
<script>
    $(document).ready(function(){
        $('#section-contact-form').on('submit', function(e){
            e.preventDefault();

            var form        = $(this);
            var url         = form.attr('action');
            var method      = form.attr('method');
            var formData    = new FormData(form[0]);

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