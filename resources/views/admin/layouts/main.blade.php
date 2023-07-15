<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Admin Dashboard</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<link rel="icon" href="/dashboard/assets/img/icon.ico" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="/dashboard/assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Open+Sans:300,400,600,700"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"], urls: ['/dashboard/assets/css/fonts.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- Jquery Script -->
	<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>
	
	<!-- CK Editor -->
	<script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/classic/ckeditor.js"></script>


	<!-- Datatables -->
	{{-- <link rel="stylesheet" href="//cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css"> --}}

	<!-- CSS Files -->
	<link rel="stylesheet" href="/dashboard/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="/dashboard/assets/css/azzara.min.css">

	<!-- CSS Just for demo purpose -->
	<link rel="stylesheet" href="/dashboard/assets/css/demo.css">

	<!-- Import CSS Front-end -->
	<link rel="stylesheet" href="/dashboard/assets/css/tooplate-style.css">
</head>
<body>
	<div class="wrapper">
		@include('admin.partials.navbar')

        @include('admin.partials.sidebar')

		@yield('container')
		
        @include('admin.partials.custom-template')
	</div>
</div>


<!--   Core JS Files   -->
<script src="/dashboard/assets/js/core/jquery.3.2.1.min.js"></script>
<script src="/dashboard/assets/js/core/popper.min.js"></script>
<script src="/dashboard/assets/js/core/bootstrap.min.js"></script>

<!-- jQuery UI -->
<script src="/dashboard/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="/dashboard/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

<!-- jQuery Scrollbar -->
<script src="/dashboard/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

<!-- Moment JS -->
<script src="/dashboard/assets/js/plugin/moment/moment.min.js"></script>

<!-- Chart JS -->
<script src="/dashboard/assets/js/plugin/chart.js/chart.min.js"></script>

<!-- jQuery Sparkline -->
<script src="/dashboard/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

<!-- Chart Circle -->
<script src="/dashboard/assets/js/plugin/chart-circle/circles.min.js"></script>

<!-- Datatables -->
<script src="/dashboard/assets/js/plugin/datatables/datatables.min.js"></script>

<!-- Bootstrap Notify -->
<script src="/dashboard/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

<!-- Bootstrap Toggle -->
<script src="/dashboard/assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>

<!-- jQuery Vector Maps -->
<script src="/dashboard/assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>
<script src="/dashboard/assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>

<!-- Google Maps Plugin -->
<script src="/dashboard/assets/js/plugin/gmaps/gmaps.js"></script>

<!-- Sweet Alert -->
<script src="/dashboard/assets/js/plugin/sweetalert/sweetalert.min.js"></script>

<!-- Azzara JS -->
<script src="/dashboard/assets/js/ready.min.js"></script>

<!-- Datatables -->
{{-- <script type="text/javascript" src="//cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script> --}}

<!-- Azzara DEMO methods, don't include it in your project! -->
<script src="/dashboard/assets/js/setting-demo.js"></script>

 <!-- Sweet Alert -->
 @include('sweetalert::alert')
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
 
</body>
</html>