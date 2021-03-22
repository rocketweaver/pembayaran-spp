@extends('layouts.app')

@section('login')
    <div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box ">
					<div class="left">
						<div class="content">
							<div class="header">
								<div class="logo text-center"><img src="{{asset('img/logo-dark.png')}}" alt="Klorofil Logo"></div>
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

