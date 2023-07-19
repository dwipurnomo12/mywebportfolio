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
                        <a href="/admin/project">Publikasi</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/project">Project</a>
                    </li>
                </ul>
                <a href="project/create" class="btn btn-primary ml-auto">Tambah</a>
			</div>
			<div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Semua Project</div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="table_id" class="display table table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Project</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($projects as $project)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $project->judul }}</td>
                                            <td>
                                                <a href="/detail-project/{{ $project->slug }}" target="_blank" class="btn btn-icon btn-success mb-2">
                                                    <i class="fas fa-eye align-items-center pt-2"></i>
                                                </a>
                                                <a href="/admin/project/{{ $project->id }}/edit" class="btn btn-icon btn-warning mb-2">
                                                    <i class="fas fa-edit align-items-center pt-2"></i>
                                                </a>
                                                <a href="javascript:void(0)" class="btn btn-icon btn-danger mb-2" id="button_hapus" data-id="{{ $project->id }}">
                                                    <i class="fa fa-trash align-items-center pt-2"></i>
                                                </a>
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
</div>

<!-- Datatables Jquery -->
<script>
    $(document).ready(function(){
        $('#table_id').DataTable();
    });
</script>

<!-- Function Hapus -->
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
                    url: '/admin/project/' + id,
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
                            timer: 1500,
                            timerProgressBar: true
                        });

                        Toast.fire({
                            icon: 'success',
                            title: 'Berhasil Menghapus Project'
                        }).then(function() {
                            $('html, body').animate({ scrollTop: 0 }, 'slow');
                        });

                        setTimeout(function() {
                            location.reload();
                        }, 1500);
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