@extends('admin.layouts.main')

@section('container')
<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">Section Skill</h4>
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
                        <a href="/admin/section-skill">Landing Page</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/section-skill">Section Skill</a>
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
                                <div class="col-lg-11 text-center mx-auto col-12">
                                  <div class="col-lg-12 mx-auto mb-5">
                                    <h2>Skills</h2>
                                    <div class="row justify-content-center my-4"> 
                                        <div id="live-preview-skills" class="row justify-content-center my-4">
                                            @foreach ($skills as $skill)
                                                <div class="col-md-2 my-2 mx-3">
                                                <img src="{{ asset('/storage' . $skill->logo) }}" alt="" width="75px"; height="75px" class="d-block mx-auto img-icon">
                                                <h4>{{ $skill->skill }}</h4>
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

				<div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Edit Section SKill</div>
                        </div>
                        <div class="card-body">
                            <div id="skill-list" class="list-group sortable">
                                @foreach ($skills as $skill)
                                  <div class="list-group-item skill sortable-item d-flex justify-content-between" draggable="true" data-skill-id="{{ $skill->id }}">
                                    <img src="{{ asset('storage/' . $skill->logo) }}" alt="" width="50px" width="50px">
                                    <span>{{ $skill->skill }}</span>
                                    <button class="remove-skill btn btn-danger btn-sm float-right"><i class="fa fas fa-times"></i></button>
                                  </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="#"><p id="add-skill-link" class="text-primary"><u>Tambah Skill</u></p></a>
                            <div id="add-skill-form" class="d-none">
                              <input type="text" class="form-control my-2" id="skill-input"  placeholder="Masukkan skill baru">
                              <input type="file" class="form-control" id="logo-input" name="logo">
                              <button id="add-skill-btn" class="btn btn-primary float-right mt-2">Tambah</button>
                            </div> 
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>


<!-- Drag and Drop Function -->
<script>
    $(document).ready(function(){
        $("#skill-list").sortable({
            handle: ".sortable-item",
            cursor: "move",
            placeholder: "skill-placeholder",
            forcePlaceholderSize:true
        });
    });
</script>

<!-- Tambah Skill Item -->
<script>
    $(document).ready(function() {
        $("#add-skill-link").click(function(e) {
            e.preventDefault();
            $("#add-skill-form").removeClass("d-none");
        });

        $("#add-skill-btn").click(function() {
            var skill = $("#skill-input").val();
            var logo = $("#logo-input").prop("files")[0];

            var formData = new FormData();
            formData.append('skill', skill);
            formData.append('logo', logo);

            if (skill.trim() !== "") {
                $.ajax({
                    url: "/admin/section-skill",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
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
                        
                        var newSkill = '<div class="list-group-item skill d-flex justify-content-between" draggable="true">' +
                            '<img src="' + response.logo + '" alt="Logo" width="50px" height="50px">' +
                            '<span>' + skill + '</span>' +
                            '<button class="remove-skill btn btn-danger btn-sm"><i class="fa fas fa-times"></i></button>' +
                            '</div>';

                        var $newSkillElement = $(newSkill);
                        $("#skill-list").append($newSkillElement);
                        $("#skill-input").val("");
                        $("#logo-input").val("");
                        $("#add-skill-form").addClass("d-none");

                        $newSkillElement.data('skill-id', response.skillId);
                        updateLivePreview();
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }
        });
        function updateLivePreview() {
            $('#live-preview-skills').load('/admin/section-skill/ #live-preview-skills');
        }
    });
</script>

<!-- Remove Skill -->
<script>
    $(document).ready(function(){
        $(document).on("click", ".remove-skill", function(){
            var skillId = $(this).closest(".skill").data("skill-id");
            var skillElement = $(this).closest(".skill");

            $.ajax({
                url: "/admin/section-skill/" + skillId,
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
                    skillElement.remove();
                    updateLivePreview();
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });

            function updateLivePreview() {
                $('#live-preview-skills').load('/admin/section-skill #live-preview-skills');
            }
        });
    });
</script>
@endsection