@extends('admin.layouts.main')

@section('container')
<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">Edit Project</h4>
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
                        <a href="/admin/project">Publikasi</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/project">Project</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/create">Tambah</a>
                    </li>
                </ul>
			</div>
   
            <div id="ajax-alert" class="alert alert-success alert-dismissable" role="alert" style="display:none"></div>
            <div id="ajax-alert-error" class="alert alert-danger alert-dismissable" role="alert" style="display:none"></div>

            <form action="/admin/project/{{ $project->id }}" method="POST" id="update" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Deskripsi Project</div>
                            </div>
                            <div class="card-body">

                                <input type="hidden" id="edit_id" value="{{ $project->id }}" data-id="{{ $project->id }}">

                                <div class="mb-3">
                                    <label for="judul">Nama Project</label>
                                    <input type="text" class="form-control" id="edit_judul" name="judul" value="{{ $project->judul }}">
                                </div>
                                <div class="mb-4">
                                    <label for="slug">Slug</label>
                                    <input type="text" class="form-control" id="edit_slug" name="slug" value="{{ $project->slug }}">
                                </div>
                                <div class="mb-3">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea class="form-control" id="editor" name="deskripsi" rows="10">{{ $project->deskripsi }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Featured Image</div>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="gambar" class="form-label">Upload Image</label><br>
                                    <img src="{{ asset('storage/'.$project->gambar) }}" class="img-preview img-fluid mb-3 mt-2" id="preview" style="max-height: 300px; overflow:hidden; border: 1px solid black;">
                                    <input class="form-control" type="file" id="edit_gambar" name="gambar" onchange="previewImage()">
                                </div>
                                <div class="my-5">
                                    <button class="btn btn-primary float-right" type="update">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    
            </form>

		</div>
	</div>
</div>

<!-- CK Editor -->
<script>
    let editorInstance;
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .then( editor => {
             editorInstance =editor;
        } )
        .catch( error => {
            console.error( error );
        } );
</script>

<!-- Preview Image -->
// Preview Image
<script>
    function previewImage() {
        var preview = document.getElementById('preview');
        var fileInput = document.getElementById('edit_gambar');
        var file = fileInput.files[0];
        var reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
        };

        reader.readAsDataURL(file);
    }
</script>


<!-- Eloquent Sluggable -->
<script>
        const judul = document.querySelector('#edit_judul');
        const slug  = document.querySelector('#edit_slug');
  
        judul.addEventListener('change', function(){
            fetch('/admin/project/checkSlug?judul=' + judul.value)
                .then(response => response.json())
                .then(data     => slug.value = data.slug)
        });
</script>

<!-- Function Update -->
<script>
    $(document).ready(function(){
        $('#update').submit(function(e){
            e.preventDefault();

            let id          = $('#edit_id').data('id');
            let judul       = $('#edit_judul').val();
            let slug        = $('#edit_slug').val();
            let deskripsi   = editorInstance.getData(); 
            let gambar      = $('#edit_gambar')[0].files[0];
            let token       = $("meta[name='csrf-token']").attr("content");

            let formData = new FormData();
            formData.append('judul', judul);
            formData.append('slug', slug);
            formData.append('deskripsi', deskripsi);
            formData.append('gambar', gambar);
            formData.append('_token', token);
            formData.append('_method', 'PUT');

            $.ajax({
                url: '/admin/project/' + id,
                type: 'POST',
                cache: false,
                data: formData,
                contentType: false,
                processData: false,
                success: function(response){
                    if (response.success) {
                        $('#ajax-alert').addClass('alert-sucess').show(function(){
                            $(this).html(response.message);
                            setTimeout(function() {
                                $('#ajax-alert').hide();
                            }, 3000); 
                        });
                    }
                },
                error: function (xhr, status, error){
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON;
                        if (errors) {
                            let errorMessage = '';
                            for (let key in errors) {
                                if (errors.hasOwnProperty(key)) {
                                    errorMessage += errors[key][0] + '<br>';
                                }
                            }
                            $('#ajax-alert-error').addClass('alert-danger').show(function() {
                                $(this).html(errorMessage);
                            });
                            setTimeout(function() {
                                $('#ajax-alert-error').hide();
                            }, 3000);
                        }
                    }
                }
            });
        });
    });
</script>

@endsection