@extends('admin.layouts.main')

@section('container')
<style>
    /* CSS untuk mengatur posisi tombol delete */
    .delete-button {
        position: absolute;
        top: 0;
        right: 0;
        opacity: 0; /* Tombol sembunyi secara default */
        transition: opacity 0.2s ease-in-out; /* Efek transisi */
    }

    /* CSS untuk menampilkan tombol delete ketika mengarahkan kursor ke gambar (hover) */
    .position-relative:hover .delete-button {
        opacity: 1;
    }
</style>
<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">Media</h4>
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
                        <a href="/admin/media">Publikasi</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/media">Media</a>
                    </li>
                </ul>
			</div>
			<div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Project Media</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($projectMedia as $media)
                                    <div class="col-md-3">
                                        <div class="position-relative mb-3">
                                            <img src="{{ asset(Storage::url($media)) }}" alt="Image" class="img-fluid">
                                            <button type="button" class="btn btn-danger delete-button" data-media="{{ $media }}"><i class="fas fa-trash-alt"></i></button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Post Media</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($postMedia as $media)
                                    <div class="col-md-3">
                                        <div class="position-relative mb-3">
                                            <img src="{{ asset(Storage::url($media)) }}" alt="Image" class="img-fluid">
                                            <button type="button" class="btn btn-danger delete-button" data-media="{{ $media }}"><i class="fas fa-trash-alt"></i></button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

			</div>
		</div>
	</div>
</div>

<script>
    // Menampilkan SweetAlert sebagai konfirmasi hapus
    const deleteButtons = document.querySelectorAll('.delete-button');

    deleteButtons.forEach((button) => {
        button.addEventListener('click', function() {
            const media = this.getAttribute('data-media');

            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: 'Anda yakin ingin menghapus gambar ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Lakukan permintaan penghapusan ke rute yang menangani penghapusan gambar di server
                    fetch(`/admin/media/delete?media=${media}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    }).then((response) => {
                        if (response.ok) {
                             const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-right',
                                    icon: 'success',
                                    title: 'Gambar berhasil dihapus',
                                    showConfirmButton: false,
                                    timer: 1500,
                                    timerProgressBar: true
                                });
                                Toast.fire();

                                setTimeout(function() {
                                    location.reload();
                                }, 1500);
                        } else {
                            const ToastError = Swal.mixin({
                                toast: true,
                                position: 'top-right',
                                icon: 'error',
                                title: 'Gagal menghapus gambar',
                                showConfirmButton: false,
                                timer: 1500,
                                timerProgressBar: true
                            });
                            ToastError.fire();
                        }
                    }).catch((error) => {
                        const ToastError = Swal.mixin({
                            toast: true,
                            position: 'top-right',
                            icon: 'error',
                            title: 'Gagal menghapus gambar',
                            showConfirmButton: false,
                            timer: 1500,
                            timerProgressBar: true
                        });
                        ToastError.fire();
                    });
                }
            });
        });
    });
</script>

@endsection