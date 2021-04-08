@extends('layouts.app')

@section('login')
    <div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box ">
					<div class="left">
						<div class="content">
							<div class="header">
								
								<div class="logo text-center"><img src="{{asset('img/logo.png')}}" alt="Klorofil Logo"></div>
								<p class="lead">Login to your account</p>
							</div>
							<form class="form-auth-small" action="{{route('login.store')}}" method="POST">
								@if (session('status'))
									<div class="alert alert-danger alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<i class="fa fa-times-circle"></i> {{session('status')}}
									</div>
								@endif
                                @csrf
								<div class="form-group">
                                    <label for="username" class="control-label sr-only">Username</label>
                                    <input type="text" name="username" class="form-control @error('username') border-red @enderror" id="username" placeholder="Ketikkan username" value="{{old('username')}}">
                                    @error('username')
                                        <small class="text-danger">
                                            {{$message}}
                                        </small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password" class="control-label sr-only">Password</label>
                                    <input type="password" name="password" class="form-control @error('password') border-red @enderror" id="password" placeholder="Ketikkan password">
                                    @error('password')
                                        <small class="text-danger">
                                            {{$message}}
                                        </small>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg btn-block">LOGIN</button>
							</form>
							<a href="#" id="info-user" data-toggle="modal" data-target="#userInfoModal"><i class="fa fa-info-circle mr-1"></i>Tata cara penggunaan website</a>
							<div class="modal fade" id="userInfoModal" tabindex="-1" role="dialog" aria-labelledby="userInfoModal" aria-hidden="true">
								<div class="modal-dialog modal-lg">
								  <div class="modal-content">
									<div class="modal-header">
									  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									  <h4 class="modal-title" id="myModalLabel">Tata Cara Penggunaan Website</h4>
									</div>
									<div class="modal-body text-left">
										<p>Untuk menggunakan website ini, Anda harus mengikuti langkah - langkah di bawah:</p>
										<ol>
											<li>Isi username dengan <b>arb002</b> dan password dengan <b>arbhy123</b></li>
											<li>Tambahkan data pada tabel petugas yang diisi level petugas dan siswa sehingga Anda bisa login sebagai petugas atau siswa</li>
											<li><i>Voila!</i> Sekarang Anda bisa mencoba fitur - fitur yang ada di dalamnya</li>
										</ol>
									  	<p><small><span class="text-danger">Note: </span> Apabila terjadi error, silakan lapor error tersebut melalui email ke <b>arbhyaditya@gmail.com</b></small></p>
										<p class="text-right"><small>&copy;<i>Arbhy Adityabrahma, </i>4 April 2021</small></p>
									</div>
									<div class="modal-footer">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									</div>
								  </div>
								</div>
							</div>
						</div>
					</div>
					<div class="right">
						<div class="overlay"></div>
						<div class="content text">
							<h1 class="heading">Free Bootstrap dashboard template</h1>
							<p>by The Develovers</p>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
@endsection

