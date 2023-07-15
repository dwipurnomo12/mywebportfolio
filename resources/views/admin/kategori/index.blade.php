@extends('admin.layouts.main')

@section('container')
<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">kategori</h4>
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
                        <a href="/admin/kategori">Publikasi</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/kategori">Kategori</a>
                    </li>
                </ul>
			</div>
			<div class="row">
                <div class="col-lg-12">
                    <div id="ajax-alert" class="alert alert-success alert-dismissable" role="alert" style="display:none"></div>
                    <div id="ajax-alert-error" class="alert alert-danger alert-dismissable" role="alert" style="display:none"></div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Semua Kategori</div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="table_id" class="display table table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kategori</th>
                                            <th>Slug</th>
                                            <th>Deskripsi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="kategori-table-id">
                                        {{-- @foreach ($kategoris as $kategori)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $kategori->kategori }}</td>
                                            <td>{{ $kategori->slug }}</td>
                                            <td>{{ $kategori->deskripsi }}</td>
                                            <td>
                                                <a href="javascript:void(0)" class="btn btn-icon btn-danger mb-2" id="button_hapus" data-id="{{ $kategori->id }}">
                                                    <i class="fa fa-trash align-items-center pt-2"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Tambah Kategori</div>
                        </div>
                        <div class="card-body">
                            <form action="/admin/kategori" method="POST" id="store">
                                <div class="form-group">
                                    <label for="katagori">Nama Kategori</label>
                                    <input type="text" class="form-control" id="kategori" name="kategori">
                                </div>
                                <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <input type="text" class="form-control" id="slug" name="slug">
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea class="form-control" id="deskripsi" rows="5"></textarea>
                                </div>
                                <button class="btn btn-primary float-right" type="submit">Simpan</button>
                            </form>
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

<!-- Eloquent Sluggable -->
<script>
    const kategori = document.querySelector('#kategori');
    const slug     = document.querySelector('#slug');

    kategori.addEventListener('change', function(){
        fetch('/admin/kategori/checkSlug?kategori=' + kategori.value)
            .then(response  => response.json())
            .then(data      => slug.value = data.slug)
    });
</script>

<!-- Fetch All Kategori -->
<script>
    $(document).ready(function(){
        fetchKategoris();
    });

    function fetchKategoris(){
        $.ajax({
            url: '/admin/kategori/fetchData',
            type: 'GET',
            success: function(response){
                let counter = 1;
                $('#table_id').DataTable().clear();
                $.each(response.data, function(key, value){
                    let kategori = `<tr>
                                        <td>${counter++}</td>
                                        <td>${value.kategori}</td>
                                        <td>${value.slug}</td>
                                        <td>${value.deskripsi}</td>
                                        <td>
                                            <a href="javascript:void(0)" class="btn btn-icon btn-danger mb-2" id="button_hapus" data-id="${value.id}">
                                                <i class="fa fa-trash align-items-center pt-2"></i>
                                            </a>
                                        </td>
                                    </tr>`;
                    $('#table_id').DataTable().row.add($(kategori)).draw(false);
                });
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    }
</script>

<!-- Store Function -->
<script>
    $(document).ready(function(){
        $('#store').submit(function(e){
            e.preventDefault();

            let kategori    = $('#kategori').val();
            let slug        = $('#slug').val();
            let deskripsi   = $('#deskripsi').val();
            let token       = $("meta[name='csrf-token']").attr("content");

            let formData = new FormData();
            formData.append('kategori', kategori);
            formData.append('slug', slug);
            formData.append('deskripsi', deskripsi);
            formData.append('_token', token);

            $.ajax({
                url: '/admin/kategori',
                type: 'POST',
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
                        
                        let table = $('#table_id').DataTable();
                        table.row.add([
                            table.rows().count() + 1,
                            response.data.kategori,
                            response.data.slug,
                            response.data.deskripsi,
                            `<a href="javascript:void(0)" class="btn btn-icon btn-danger mb-2" id="button_hapus" data-id="${response.data.id}">
                                <i class="fa fa-trash align-items-center pt-2"></i>
                            </a>`
                        ]).draw();

                        // Mengupdate nomor urut pada tabel
                        table.column(0).nodes().each(function(cell, index) {
                            cell.innerHTML = index + 1;
                        });

                        $('#kategori').val('');
                        $('#slug').val('');
                        $('#deskripsi').val('');
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

<!-- Remove Function -->
<script>
    $('body').on('click', '#button_hapus', function(){
        let id      = $(this).data('id');
        let token   = $("meta[name='csrf-token']").attr("content");

        Swal.fire({
            title: 'Apakah Kamu Yakin?',
            text: "ingin menghapus data ini!",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'TIDAK',
            confirmButtonText: 'YA, HAPUS!'
        }).then((result) => {
            if(result.isConfirmed){
                $.ajax({
                    url: '/admin/kategori/' + id,
                    type: "DELETE",
                    cache: false,
                    data: {
                        "_token": token
                    },
                    success:function(response){
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-right',
                            iconColor: '#a5dc86',
                            customClass: {
                                popup: 'colored-toast'
                            },
                            showConfirmButton: false,
                            timer: 1000,
                            timerProgressBar: true
                        });

                        const reloadPromise = new Promise((resolve, reject) => {
                            location.reload();
                            resolve();
                        });

                        Toast.fire({
                            icon: 'success',
                            title: 'Sukses'
                        }).then(function() {
                            $('html, body').animate({ scrollTop: 0 }, 'slow');
                        });
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            type: 'error',
                            icon: 'error',
                            title: 'Terjadi Kesalahan',
                        });
                    }
                });
            }
        });
    });
</script>
@endsection