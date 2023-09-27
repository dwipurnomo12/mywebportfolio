@extends('admin.layouts.main')

@section('container')

<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">Post</h4>
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
                        <a href="/admin/posts">Publikasi</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/posts">Post</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/posts/create">Tambah</a>
                    </li>
                </ul>
			</div>
   
            <div id="ajax-alert" class="alert alert-success alert-dismissable" role="alert" style="display:none"></div>
            <div id="ajax-alert-error" class="alert alert-danger alert-dismissable" role="alert" style="display:none"></div>

            <form action="/admin/posts/create" method="POST" id="store" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Post Baru</div>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="judul">Judul Post</label>
                                    <input type="text" class="form-control" id="judul" name="judul">
                                </div>
                                <div class="mb-4">
                                    <label for="slug">Slug</label>
                                    <input type="text" class="form-control" id="slug" name="slug">
                                </div>
                                <div class="mb-3">
                                    <label for="body">Isi Post</label>
                                    <textarea class="form-control" id="editor" name="body" rows="10"></textarea>
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
                                <div class="form-group">
                                    <label for="kategori">Kategori</label>
                                    <select class="form-control" id="kategori_id" name="kategori_id">
                                        @foreach ($kategoris as $kategori)
                                            @if (old('kategori_id') == $kategori->id)
                                                <option value="{{ $kategori->id }}" selected>{{ $kategori->kategori }}</option>
                                            @else
                                                <option value="{{ $kategori->id }}">{{ $kategori->kategori }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="gambar" class="form-label">Upload Image</label><br>
                                    <img src="" class="img-preview img-fluid mb-3 mt-2" id="preview" style="max-height: 300px; overflow:hidden; border: 1px solid black;">
                                    <input class="form-control" type="file" id="gambar" name="gambar" onchange="previewImage()">
                                </div>
                                <div class="form-group">
                                    <label for="status" class="form-label">Status</label><br>
                                    <select class="form-control" name="status_id" id="status_id">
                                        @foreach ($statusAll as $status)
                                            @if (old('status_id') == $status->id)
                                                <option value="{{ $status->id }}" selected>{{ $status->status }}</option>
                                            @else
                                                <option value="{{ $status->id }}">{{ $status->status }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="my-5">
                                    <button class="btn btn-primary float-right mx-2" type="submit">Simpan</button>
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
        .create( document.querySelector( '#editor' ), {
            ckfinder: {
                uploadUrl: '{{ route('upload.image').'?_token='.csrf_token() }}', 
                filebrowserUploadMethod: 'form',
                onRemoveFile: function (file) {
                    const imageUrl = file.data.url; // Mengakses data URL gambar
                    if (imageUrl) {
                        axios.post('{{ route('delete.image') }}', { imageUrl })
                            .then(response => {
                                console.log('Image deleted from storage.');
                            })
                            .catch(error => {
                                console.error('Error deleting image from storage:', error);
                            });
                    }
                }
            },
        })
        .then( editor => {
            editorInstance = editor;
        })
        .catch( error => {
            console.error( error );
        });
</script>




<!-- Preview Image -->
<script>
    function previewImage(){
        preview.src=URL.createObjectURL(event.target.files[0]);
    }
</script>

<!-- Eloquent Sluggable -->
<script>
    const judul = document.querySelector('#judul');
    const slug  = document.querySelector('#slug');
  
    judul.addEventListener('change', function(){
        fetch('/admin/posts/checkSlug?judul=' + judul.value)
            .then(response => response.json())
            .then(data     => slug.value = data.slug)
    });
</script>

<!-- Store Function -->
<script>
    $(document).ready(function(){
        $('#store').submit(function(e){
            e.preventDefault();

            let judul       = $('#judul').val();
            let slug        = $('#slug').val();
            let body        = editorInstance.getData(); 
            let gambar      = $('#gambar')[0].files[0];
            let kategori_id = $('#kategori_id').val();
            let status      = $('#status_id').val();
            let token       = $("meta[name='csrf-token']").attr("content");
        
            let formData = new FormData();
            formData.append('judul', judul);
            formData.append('slug', slug);
            formData.append('body', body);
            formData.append('gambar', gambar);
            formData.append('kategori_id', kategori_id);
            formData.append('status_id', status);
            formData.append('_token', token);
        
            $.ajax({
                url: '/admin/posts/create',
                type: "POST",
                cache: false,
                data: formData,
                contentType: false,
                processData: false,
                success: function(response){
                    if(response.success){
                        $('#ajax-alert').addClass('alert-sucess').show(function(){
                            $(this).html(response.message);
                            setTimeout(function() {
                                $('#ajax-alert').hide();
                                $('html, body').animate({ scrollTop: 0 }, 'slow');
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