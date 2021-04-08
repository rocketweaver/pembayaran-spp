@extends('layouts.app')
@section('tab-title')
    Edit Profile
@endsection
@section('content')
    <div class="panel panel-profile">
        <div class="clearfix">
            <!-- LEFT COLUMN -->
            <div>

                <!-- PROFILE HEADER -->
                <div class="profile-header">
                    <div class="profile-main">
                        <img src="{{asset('img/user-medium.png')}}" class="img-circle" alt="Avatar">
                        <h3 class="name">
                            @if (is_null($users->nama_petugas))
                                {{$users->nama}}
                            @else
                                {{$users->nama_petugas}}
                            @endif
                        </h3>
                        <span class="online-status status-available">Available</span>
                    </div>
                    <div class="profile-stat">
                        
                    </div>
                </div>
                <!-- END PROFILE HEADER -->

                <!-- PROFILE DETAIL -->
                <div class="profile-detail">
                    <div class="profile-info">
                        <form class="form-auth-small" 
                        @if (auth()->user()->level != 'siswa')
                            action="{{route('users.update', $users->id_petugas)}}" 
                        @else
                            action="{{route('users.update', $users->nisn)}}"
                        @endif
                        method="POST">
                            @csrf
                            @method('PUT')
                            @if (session('berhasil'))
								<div class="alert alert-success alert-dismissible" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<i class="fa fa-times-circle"></i> {{session('berhasil')}}
								</div>
							@endif
                            <div class="form-group">
                                <label for="nama_lengkap" class="control-label sr-only">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" class="form-control @error('nama_lengkap') border-red @enderror" id="nama_lengkap" placeholder="Ubah nama lengkap" 
                                value="@if(is_null($users->nisn)) {{$users->nama_petugas}} @else {{$users->nama}} @endif"
                                @if (auth()->user()->username == 'arb002' || $users->nisn) readonly @endif>
                                @error('nama_lengkap')
                                    <small class="text-danger">
                                        {{$message}}
                                    </small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="username" class="control-label sr-only">Username</label>
                                <input type="text" name="username" class="form-control @error('username') border-red @enderror" id="username" placeholder="Ubah username" 
                                value="@if(is_null($users->nisn)) {{$users->username}} @else {{$users->nis}} @endif"
                                @if (auth()->user()->username == 'arb002' || $users->nisn) readonly @endif>
                                @error('username')
                                    <small class="text-danger">
                                        {{$message}}
                                    </small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password" class="control-label sr-only">Password</label>
                                <input type="password" name="password" class="form-control @error('password') border-red @enderror" id="password" placeholder="Ketikkan password baru" 
                                value="@if (auth()->user()->level != 'siswa'){{$users->password}} @else {{$users->nis}} @endif"
                                @if (auth()->user()->username == 'arb002' || $users->nisn) readonly @endif>
                                @error('password')
                                    <small class="text-danger">
                                        {{$message}}
                                    </small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation" class="control-label sr-only">Password Again</label>
                                <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') border-red @enderror" id="password_confirmation" placeholder="Ketikkan kembali password"
                                value="@if (auth()->user()->level != 'siswa'){{$users->password}} @else {{$users->nis}} @endif">
                                @error('password_confirmation')
                                    <small class="text-danger">
                                        {{$message}}
                                    </small>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg btn-block">Perbarui Profile</button>
                        </form>
                    </div>
                </div>
                <!-- END PROFILE DETAIL -->
            </div>
            <!-- END LEFT COLUMN -->

            <!-- RIGHT COLUMN -->
            
            <!-- END RIGHT COLUMN -->
        </div>
    </div>
@endsection