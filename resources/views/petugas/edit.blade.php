@extends('layouts.app')

@section('tab-title')
    Data Petugas - Edit Data
@endsection
@section('page-title')
    <h3 class="page-title"><a href="{{route('petugas.index')}}">Data Petugas</a> > Edit Data</h3>
@endsection
@section('content') 
    <div class="row">
        <div class="col-md-12 mx-auto">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Formulir Edit Data</h3>
                </div>
                <div class="panel-body">
                    <form class="form-auth-small" action="{{route('petugas.update', $petugas->id_petugas)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nama_petugas" class="control-label sr-only">Nama Petugas</label>
                            <input type="text" name="nama_petugas" class="form-control @error('nama_petugas') border-red @enderror" id="nama_petugas" placeholder="Ubah nama petugas" value="{{$petugas->nama_petugas}}">
                            @error('nama_petugas')
                                <small class="text-danger">
                                    {{$message}}
                                </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="username" class="control-label sr-only">Username</label>
                            <input type="text" name="username" class="form-control @error('username') border-red @enderror" id="username" placeholder="Ubah username" value="{{$petugas->username}}">
                            @error('username')
                                <small class="text-danger">
                                    {{$message}}
                                </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password" class="control-label sr-only">Password</label>
                            <input type="password" name="password" class="form-control @error('password') border-red @enderror" id="password" placeholder="Ketikkan password baru">
                            @error('password')
                                <small class="text-danger">
                                    {{$message}}
                                </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation" class="control-label sr-only">Password Again</label>
                            <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') border-red @enderror" id="password_confirmation" placeholder="Ketikkan kembali password">
                            @error('password_confirmation')
                                <small class="text-danger">
                                    {{$message}}
                                </small>
                            @enderror
                        </div>
                        <div class="form-group" id="select-input">
                            <label for="level" class="control-label sr-only">Level</label>
                            <select id="level" name="level" class="form-control @error('level') border-red @enderror" id="form-control">
                                <option value="admin">Admin</option>
                                <option value="petugas">Petugas</option>
                            </select>
                            @error('level')
                                <small class="text-danger">
                                    {{$message}}
                                </small>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Perbarui Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mx-auto">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Detail</h3>
                </div>
                <div class="panel-body">
                    <p>Nama petugas : <b class="ml-half-1">{{$petugas->nama_petugas}}</b></p>
                    <p>Username : <b class="ml-half-1">{{$petugas->username}}</b></p>
                    <p>Password : <b class="ml-half-1">{{$petugas->password}}</b></p>
                    <p>Level : <b class="ml-half-1">{{$petugas->level}}</b></p>
                </div>
            </div>
        </div>
    </div>
@endsection