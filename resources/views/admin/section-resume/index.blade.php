@extends('admin.layouts.main')

@section('container')
<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">Section Resume</h4>
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
                        <a href="/admin/section-resume">Landing Page</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/section-resume">Section Resume</a>
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
                                <div class="col-lg-6 col-12" >
                                    <h2 class="mb-4 mobile-mt-2">Pendidikan</h2>
                                    <div class="timeline" id="live-preview-pendidikan">
                                        @foreach ($pendidikans as $pendidikan)
                                            <div class="timeline-wrapper">
                                                <div class="timeline-yr">
                                                    <span>{{ $pendidikan->tahun }}</span>
                                                </div>
                                                <div class="timeline-info">
                                                    <h3><span>{{ $pendidikan->nama_sekolah }}</span><small> - {{ $pendidikan->jurusan }}</small></h3>
                                                    <p>{{ $pendidikan->deskripsi }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <h2 class="mb-4">Pekerjaan</h2>
                                    <div class="timeline" id="live-preview-pekerjaan">
                                        @foreach ($pekerjaans as $pekerjaan)
                                            <div class="timeline-wrapper">
                                                <div class="timeline-yr">
                                                    <span>{{ $pekerjaan->tahun }}</span>
                                                </div>
                                                <div class="timeline-info">
                                                    <h3><span>{{ $pekerjaan->nama_perusahaan }}</span><small> - {{ $pekerjaan->posisi }}</small></h3>
                                                    <p>{{ $pekerjaan->deskripsi }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                      <div class="card-header">
                        <div class="card-title">Edit Section Resume</div>
                      </div>
                      <div class="card">
                        <div class="card-header">
                          <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                              <a class="nav-link active" id="pendidikan-tab" data-toggle="tab" href="#pendidikan" role="tab" aria-controls="pendidikan" aria-selected="true">Pendidikan</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="pekerjaan-tab" data-toggle="tab" href="#pekerjaan" role="tab" aria-controls="pekerjaan" aria-selected="false">Pekerjaan</a>
                            </li>
                          </ul>
                        </div>
                        <div class="card-body">
                          <div class="tab-content" id="myTabContent">

                            <div class="tab-pane fade show active" id="pendidikan" role="tabpanel" aria-labelledby="pendidikan-tab">
                                <div id="pendidikan-list" class="list-group sortable">
                                    @foreach ($pendidikans as $pendidikan)
                                    <div class="list-group-item pendidikan sortable-item d-flex justify-content-between align-items-center" draggable="true" data-pendidikan-id="{{ $pendidikan->id }}">
                                        <i class="fas fa-user-graduate mr-2"></i>
                                        <span class="ml-2">{{ $pendidikan->nama_sekolah }}</span>
                                        <button class="remove-pendidikan btn btn-danger btn-sm float-right"><i class="fas fa-times"></i></button>
                                    </div>
                                    @endforeach
                                </div>

                              <a href="#" class="btn btn-link my-3" id="tambahPendidikan"><u>Tambah Pendidikan</u></a>
                              <div id="pendidikan-form" class="d-none">
                                <form action="#" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nama_sekolah">Nama Sekolah</label>
                                        <input type="text" class="form-control" id="nama_sekolah" name="nama_sekolah">
                                    </div>
                                    <div class="form-group">
                                        <label for="jurusan">Tahun</label>
                                        <input type="text" class="form-control" id="tahun" name="tahun">
                                    </div>
                                    <div class="form-group">
                                        <label for="jurusan">Jurusan</label>
                                        <input type="text" class="form-control" id="jurusan" name="jurusan">
                                    </div>
                                    <div class="form-group">
                                        <label for="deskripsi">Deskripsi</label>
                                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5"></textarea>
                                    </div>
                                    <button id="submit-pendidikan" class="btn btn-primary my-4 float-right">Simpan</button>
                                </form>
                              </div>
                            </div>

                            <!-- Pekerjaan -->
                            <div class="tab-pane fade" id="pekerjaan" role="tabpanel" aria-labelledby="pekerjaan-tab">
                              <div id="pekerjaan-list" class="list-group sortable">
                                @foreach ($pekerjaans as $pekerjaan)
                                    <div class="list-group-item pekerjaan sortable-item d-flex justify-content-between align-items-center" draggable="true" data-pekerjaan-id="{{ $pekerjaan->id }}">
                                        <i class="fas fa-user-tie mr-2"></i>
                                        <span class="ml-2">{{ $pekerjaan->nama_perusahaan }}</span>
                                        <button class="remove-pekerjaan btn btn-danger btn-sm float-right"><i class="fas fa-times"></i></button>
                                    </div>
                                @endforeach
                              </div>

                              <a href="#" class="btn btn-link my-3" id="tambahPekerjaan"><u>Tambah Pekerjaan</u></a>
                              <div id="pekerjaan-form" class="d-none">
                                <form action="#" method="POST">
                                  <div class="form-group">
                                    <label for="nama_perusahaan">Perusahaan</label>
                                    <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan">
                                  </div>
                                  <div class="form-group">
                                    <label for="posisi">Posisi</label>
                                    <input type="text" class="form-control" id="posisi" name="posisi">
                                  </div>
                                  <div class="form-group">
                                    <label for="tahun_krja">Tahun</label>
                                    <input type="text" class="form-control" id="tahun_krja" name="tahun_krja">
                                  </div>
                                  <div class="form-group">
                                    <label for="deskripsi_krja">Deskripsi</label>
                                    <textarea class="form-control" id="deskripsi_krja" name="deskripsi_krja" rows="5"></textarea>
                                  </div>
                                  <button id="submit-pekerjaan" class="btn btn-primary my-4 float-right">Simpan</button>
                                </form>
                              </div>
                            </div>

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  

				
			</div>
		</div>
	</div>
</div>

<!-- Navigasi Card Tambah Pendidikan & Pekerjaan -->
<script>
    $(document).ready(function() {
      $('#tambahPendidikan').click(function(e) {
        e.preventDefault();
        $('#pendidikan-form').toggleClass('d-none');
      });
    
      $('#tambahPekerjaan').click(function(e) {
        e.preventDefault();
        $('#pekerjaan-form').toggleClass('d-none');
      });
    });
</script>

<!-- Function Store Pendidikan -->
<script>
    $(document).ready(function(){
        $("#tambahPendidikan").click(function(e) {
            e.preventDefault();
            $("#pendidikan-form").removeClass("d-none");
        });

        $('#submit-pendidikan').click(function(e){
            e.preventDefault();

            var nama_sekolah = $('#nama_sekolah').val();
            var tahun        = $('#tahun').val();
            var jurusan      = $('#jurusan').val();
            var deskripsi    = $('#deskripsi').val();

            var formData = new FormData();
            formData.append('nama_sekolah', nama_sekolah);
            formData.append('tahun', tahun);
            formData.append('jurusan', jurusan);
            formData.append('deskripsi', deskripsi);

            $.ajax({
                url: "/admin/section-resume/pendidikan-store",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                processData: false,
                contentType: false,
                success: function(response){
                    console.log(response);
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
                        title: 'Berhasil Ditambahkan !'
                    });

                    var newPendidikan = '<div class="list-group-item pendidikan sortable-item d-flex justify-content-between align-items-center" draggable="true">' +
                        '<i class="fas fa-user-graduate mr-2"></i>' +
                        '<span class="ml-2">' + nama_sekolah + '</span>' +       
                        '<button class="remove-pendidikan btn btn-danger btn-sm float-right"><i class="fas fa-times"></i></button>' +          
                        '</div>';

                    var $newPendidikanElement = $(newPendidikan);
                    $('#pendidikan-list').append($newPendidikanElement);
                    $('#nama_sekolah').val('');
                    $('#tahun').val('');
                    $('#jurusan').val('');
                    $('#deskripsi').val('');
                    $('#add-pendidikan-form').addClass("d-none");

                    $newPendidikanElement.data('pendidikan-id', response.pendidikanId);
                    updateLivePreview();
                },
                error: function(xhr, status, error) {
                    var response = JSON.parse(xhr.responseText);
                    var errorMessage = response.message;

                    // Tampilkan pesan error dalam alert toast
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-right',
                        iconColor: '#dc3545',
                        customClass: {
                            popup: 'colored-toast'
                        },
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });

                    Toast.fire({
                        icon: 'error',
                        title: 'Opppss.. Gagal Menambahkan Data !'
                    });
                }
            });
        });
        function updateLivePreview(){
            $('#live-preview-pendidikan').load('/admin/section-resume/ #live-preview-pendidikan');
        }
    });
</script>

<!-- Remove list pendidikan -->
<script>
    $(document).ready(function(){
        $(document).on("click", ".remove-pendidikan", function(){
            var pendidikanId = $(this).closest(".pendidikan").data("pendidikan-id");
            var pendidikanElement = $(this).closest(".pendidikan");

            $.ajax({
                url: "/admin/section-resume/" + pendidikanId,
                method: "DELETE",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response){
                    if (response.success) {
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
                            title: 'Berhasil Dihapus !'
                        });
                    }
                    pendidikanElement.remove();
                    updateLivePreview();
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
        function updateLivePreview(){
            $('#live-preview-pendidikan').load('/admin/section-resume/ #live-preview-pendidikan');
        }
    });
</script>

 

<!-- Function Store Pekerjaan -->
<script>
    $(document).ready(function(){
        $("#tambahPekerjaan").click(function(e) {
            e.preventDefault();
            $("#pekerjaan-form").removeClass("d-none");
        });

        $('#submit-pekerjaan').click(function(e){
            e.preventDefault();

            var nama_perusahaan = $('#nama_perusahaan').val();
            var tahun           = $('#tahun_krja').val();
            var posisi          = $('#posisi').val();
            var deskripsi       = $('#deskripsi_krja').val();

            var formData = new FormData();
            formData.append('nama_perusahaan', nama_perusahaan);
            formData.append('tahun_krja', tahun);
            formData.append('posisi', posisi);
            formData.append('deskripsi_krja', deskripsi);

            $.ajax({
                url: "/admin/section-resume/pekerjaan-store",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                processData: false,
                contentType: false,
                success: function(response){
                    console.log(response);
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
                        title: 'Berhasil Ditambahkan !'
                    });

                    var newPekerjaan = '<div class="list-group-item pendidikan sortable-item d-flex justify-content-between align-items-center" draggable="true">' +
                        '<i class="fas fa-user-graduate mr-2"></i>' +
                        '<span class="ml-2">' + nama_perusahaan + '</span>' +       
                        '<button class="remove-pekerjaan btn btn-danger btn-sm float-right"><i class="fas fa-times"></i></button>' +          
                        '</div>';

                    var $newPekerjaanElement = $(newPekerjaan);
                    $('#pekerjaan-list').append($newPekerjaanElement);
                    $('#nama_perusahaan').val('');
                    $('#tahun_krja').val('');
                    $('#posisi').val('');
                    $('#deskripsi_krja').val('');
                    $('#add-pekerjaan-form').addClass("d-none");

                    $newPekerjaanElement.data('pekerjaan-id', response.pekerjaanId);
                    updateLivePreview();
                },
                error: function(xhr, status, error) {
                    var response = JSON.parse(xhr.responseText);
                    var errorMessage = response.message;

                    // Tampilkan pesan error dalam alert toast
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-right',
                        iconColor: '#dc3545',
                        customClass: {
                            popup: 'colored-toast'
                        },
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });

                    Toast.fire({
                        icon: 'error',
                        title: 'Opppss.. Gagal Menambahkan Data !'
                    });
                }
            });
        });
        function updateLivePreview(){
            $('#live-preview-pekerjaan').load('/admin/section-resume/ #live-preview-pekerjaan');
        }
    });
</script>

<!-- Remove List Pekerjaan -->
<script>
    $(document).ready(function(){
        $(document).on("click", ".remove-pekerjaan", function(){
            var pekerjaanId = $(this).closest('.pekerjaan').data("pekerjaan-id");
            var pekerjaanElement   = $(this).closest('.pekerjaan');

            $.ajax({
                url: "/admin/section-resume/" + pekerjaanId,
                method: "DELETE",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response){
                    if (response.success) {
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
                            title: 'Berhasil Dihapus !'
                        });
                    }
                    pekerjaanElement.remove();
                    updateLivePreview();;
                },
                error: function(xhr, status, error){
                    console.error(error);
                }
            });
        });
        function updateLivePreview(){
            $('#live-preview-pekerjaan').load('/admin/section-resume/ #live-preview-pekerjaan');
        }
    });
</script>
@endsection