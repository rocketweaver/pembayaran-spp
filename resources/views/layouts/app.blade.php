<!doctype html>
<html lang="en">

<head>
	<title>@yield('tab-title')</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('vendor/font-awesome/css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{asset('vendor/linearicons/style.css')}}">
	<link rel="stylesheet" href="{{asset('vendor/toastr/toastr.min.css')}}">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="{{asset('css/main.css')}}">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="{{asset('img/apple-icon.png')}}">
	<link rel="icon" type="image/png" sizes="96x96" href="{{asset('img/favicon.png')}}">
</head>

<body>
	<!-- WRAPPER -->
	@auth
		<div id="wrapper">
			<!-- NAVBAR -->
			<nav class="navbar navbar-default navbar-fixed-top">
				<div class="brand">
					<a href="index.html"><img src="{{asset('img/logo-dark.png')}}" alt="Klorofil Logo" class="img-responsive logo"></a>
				</div>
				<div class="container-fluid">
					<div class="navbar-btn">
						<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
					</div>
					<div id="navbar-menu">
						<ul class="nav navbar-nav navbar-right">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="{{asset('img/user.png')}}" class="img-circle" alt="Avatar"> <span>
									@if (auth()->user()->level == 'admin' || auth()->user()->level == 'petugas')
										{{auth()->user()->petugas->nama_petugas}}
									@elseif (auth()->user()->level == 'siswa')
										{{auth()->user()->siswa->nama}}
									@endif
								</span> 
								<i class="icon-submenu lnr lnr-chevron-down"></i>
							</a>
								<ul class="dropdown-menu">
									<li>
										<form action="{{route('logout')}}" method="POST">
											@csrf
											<button type="submit" class="href-btn"><i class="lnr lnr-exit"></i> <span>Logout</span></button>
										</form>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</nav>
			<!-- END NAVBAR -->
			<!-- LEFT SIDEBAR -->
			<div id="sidebar-nav" class="sidebar">
				<div class="sidebar-scroll">
					<nav>
						<ul class="nav">
							<li><a href="{{route('dashboard.index')}}" class="active"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
							@if (auth()->user()->level == 'admin')
								<li>
									<a href="#subPages" data-toggle="collapse" class="collapsed"><i class="lnr lnr-database"></i> <span>Kumpulan Tabel</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
									<div id="subPages" class="collapse ">
										<ul class="nav">
											<li><a href="{{route('petugas.index')}}" class="">Petugas</a></li>
											<li><a href="{{route('siswa.index')}}" class="">Siswa</a></li>
											<li><a href="{{route('kelas.index')}}" class="">Kelas</a></li>
											<li><a href="{{route('spp.index')}}" class="">SPP</a></li>
										</ul>
									</div>
									<li><a href="{{route('pembayaran.index')}}"><i class="lnr lnr-enter-down"></i> <span>Pembayaran SPP</span></a></li>
								</li>	
							@elseif (auth()->user()->level == 'petugas')
								<li><a href="{{route('pembayaran.index')}}"><i class="lnr lnr-enter-down"></i> <span>Pembayaran SPP</span></a></li>
							@endif
							<li><a href="{{route('history-pembayaran.index')}}"><i class="lnr lnr-history"></i> <span>Riwayat Pembayaran</span></a></li>
						</ul>
					</nav>
				</div>
			</div>	
			<!-- END LEFT SIDEBAR -->
			<!-- MAIN -->
			<div class="main">
				<!-- MAIN CONTENT -->
				<div class="main-content">
					<div class="container-fluid">
						@yield('page-title')
						<div class="row">
							<div class="col-md-12">
								@yield('content')
							</div>
						</div>
					</div>
				</div>
				<!-- END MAIN CONTENT -->
			</div>
			<!-- END MAIN -->
			<div class="clearfix"></div>
			<footer>
				<div class="container-fluid">
					<p class="copyright">&copy; 2017 <a href="https://www.themeineed.com" target="_blank">Theme I Need</a>. All Rights Reserved.</p>
				</div>
			</footer>
		</div>
	@endauth
	@guest
		@yield('login')
	@endguest
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
	<script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('vendor/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
	<script src="{{asset('vendor/toastr/toastr.min.js')}}"></script>
	<script src="{{asset('scripts/klorofil-common.js')}}"></script>
	<script>
		@if (session()->has('success'))
			toastr.success('{{ session('success') }}', 'BERHASIL!');
		@elseif (session()->has('error'))
			toastr.error('{{ session('error') }}', 'GAGAL!'); 
		@endif
	</script>
</body>

</html>
