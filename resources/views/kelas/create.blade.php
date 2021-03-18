@extends('layouts.app')

@section('tab-title')
    Data Kelas - Tambah Data
@endsection
@section('page-title')
    <h3 class="page-title"><a href="{{route('kelas.index')}}">Data Kelas</a> > Tambah Data</h3>
@endsection
@section('content') 
    <div class="row">
        <div class="col-md-12 mx-auto">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Formulir Tambah Data</h3>
                </div>
                <div class="panel-body">
                    <form class="form-auth-small" action="{{route('kelas.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama_kelas" class="control-label sr-only">Nama Kelas</label>
                            <input type="text" name="nama_kelas" class="form-control @error('nama_kelas') border-red @enderror" id="nama_kelas" placeholder="Ketikkan nama kelas" value="{{old('nama_kelas')}}">
                            @error('nama_kelas')
                                <small class="text-danger">
                                    {{$message}}
                                </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kompetensi_keahlian" class="control-label sr-only">Kompetensi Keahlian</label>
                            <input type="text" name="kompetensi_keahlian" class="form-control @error('kompetensi_keahlian') border-red @enderror" id="kompetensi_keahlian" placeholder="Ketikkan kompetensi keahlian" value="{{old('kompetensi_keahlian')}}">
                            @error('kompetensi_keahlian')
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