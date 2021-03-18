@extends('layouts.app')

@section('tab-title')
    Data Petugas - Tambah Data
@endsection
@section('page-title')
    <h3 class="page-title"><a href="{{route('petugas.index')}}">Data Petugas</a> > Tambah Data</h3>
@endsection
@section('content') 
    <div class="row">
        <div class="col-md-12 mx-auto">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Formulir Tambah Data</h3>
                </div>
                <div class="panel-body">
                    <form class="form-auth-small" action="{{route('petugas.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama_petugas" class="control-label sr-only">Nama Petugas</label>
                            <input type="text" name="nama_petugas" class="form-control @error('nama_petugas') border-red @enderror" id="nama_petugas" placeholder="Ketikkan nama petugas" value="{{old('nama_petugas')}}">
                            @error('nama_petugas')
                                <small class="text-danger">
                                    {{$message}}
                                </small>
                            @enderror
                        </div>
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
                        <div class="form-group">
                            <label for="password_confirmation" class="control-label sr-only">Password Again</label>
                            <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') border-red @enderror" id="password_confirmation" placeholder="Ketikkan kembali password">
                            @error('password_confirmation')
                                <small class="text-danger">
                                    {{$message}}
                                </small>
                            @enderror
                        </div>
                        <div class="form-group">
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
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Tambah Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection