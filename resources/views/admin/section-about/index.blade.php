@extends('admin.layouts.main')

@section('container')
<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">Section About</h4>
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
                        <a href="/admin/section-about">Landing Page</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/section-about">Section About</a>
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
                           <div class="row">
                            <div class="col-lg-7 col-md-12 col-12 d-flex align-items-center" id="live-preview">
                                <div class="about-text">
                                    <h1 class="mr-2">{{ $about->h1 }}</h1>
                                    <h4>{{ $about->h4 }}</h4>
                                          
                                    <p>{{ $about->deskripsi }}</p>
                                    
                                    <div class="custom-btn-group mt-4">
                                      <a href="#" class="btn mr-lg-2 custom-btn"><i class='uil uil-file-alt'></i> Download Resume</a>
                                      <a href="#contact" class="btn custom-btn custom-btn-bg custom-btn-link">Hubungi Saya</a>
                                    </div>
                                </div>
                              </div>
                
                              <div class="col-lg-5 col-md-12 col-12 d-flex align-items-center">
                                <div class="about-image svg">
                                  <img src="{{ asset('storage/' . $about->gambar) }}" class="img-fluid" alt="svg image" id="gambar-preview">
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
                            <form action="/admin/section-about/{{ $about->id }}" method="POST" id="section-about-form">
                                @method('put')
                                @csrf

                                <div class="form-group">
                                    <label for="h1">Heading H1</label>
                                    <input type="text" class="form-control" id="h1" name="h1" value="{{ $about->h1 }}">
                                </div>
                                <div class="form-group">
                                    <label for="h4">Heading H4</label>
                                    <input type="text" class="form-control" id="h4" name="h4"  value="{{ $about->h4 }}">
                                </div>

                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="10">
                                        {!!  $about->deskripsi  !!}
                                    </textarea>
                                </div>

                                <div class="form-group mb-2">
                                    <label for="gambar">Gambar</label>
                                    <img src="{{ asset('storage/' . $about->gambar) }}" class="img-preview img-fluid mb-3 mt-2" id="preview" style="max-height: 200px; overflow:hidden;">
                                    <input type="file" class="form-control-file" id="gambar" name="gambar" onchange="previewImage()">
                                </div>

                                <div class="form-group">
                                    <label for="cv">Resume</label><br>
                                    <span id="fileNameDisplay"></span>
                                    <input type="file" class="form-control-file" id="cv" name="cv" data-default-value="{{ $about->cv }}" onchange="updateFileName()">
                                </div>

                                <button type="submit" class="btn btn-primary my-4 float-right">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>

			</div>
		</div>
	</div>
</div>

<!-- Image Live Preview -->
<script>
    function previewImage(){
        preview.src = URL.createObjectURL(event.target.files[0]);
    }
</script>

<!-- PDF File Preview -->
<script>
    function updateFileName() {
      const fileInput = document.getElementById('cv');
      const fileNameDisplay = document.getElementById('fileNameDisplay');
      
      if (fileInput.files.length > 0) {
        const fileName = fileInput.files[0].name;
        fileNameDisplay.textContent = fileName;
      } else {
        const defaultValue = fileInput.getAttribute('data-default-value');
        fileNameDisplay.textContent = defaultValue;
      }
    }

    window.addEventListener('load', updateFileName);
  </script>

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

<!-- Live Preview -->
<script>
    // Tangkap elemen-elemen input form
    var h1Input         = document.getElementById('h1');
    var h4Input         = document.getElementById('h4');
    var deskripsiInput  = document.getElementById('deskripsi');

    // Tangkap elemen live preview
    var livePreview = document.getElementById('live-preview');

    // Tambahkan event listener pada setiap input form untuk memperbarui live preview
    h1Input.addEventListener('input', updateLivePreview);
    h4Input.addEventListener('input', updateLivePreview);
    deskripsiInput.addEventListener('input', updateLivePreview);

    // Fungsi untuk memperbarui live preview
    function updateLivePreview() {
        var h1Value         = h1Input.value;
        var h4Value         = h4Input.value;
        var deskripsiValue  = deskripsiInput.value;

        // Perbarui konten live preview
        livePreview.innerHTML = `
            <div class="about-text">
                <h1 class="mr-2">${h1Value}</h1>
                <h4>${h4Value}</h4>
                <p>${deskripsiValue}</p>
                <div class="custom-btn-group mt-4">
                    <a href="#" class="btn mr-lg-2 custom-btn"><i class='uil uil-file-alt'></i> Download Resume</a>
                    <a href="#contact" class="btn custom-btn custom-btn-bg custom-btn-link">Hubungi Saya</a>
                </div>
            </div>
        `;
    }
</script>

@endsection