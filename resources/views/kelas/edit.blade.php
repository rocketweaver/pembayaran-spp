@extends('layouts.app')

@section('tab-title')
    Data Kelas - Edit Data
@endsection
@section('page-title')
    <h3 class="page-title"><a href="{{route('kelas.index')}}">Data Kelas</a> > Edit Data</h3>
@endsection
@section('content') 
    <div class="row">
        <div class="col-md-12 mx-auto">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Formulir Edit Data</h3>
                </div>
                <div class="panel-body">
                    <form class="form-auth-small" action="{{route('kelas.update', $kelas->id_kelas)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nama_kelas" class="control-label sr-only">Nama Kelas</label>
                            <input type="text" name="nama_kelas" class="form-control @error('nama_kelas') border-red @enderror" id="nama_kelas" placeholder="Ubah nama kelas" value="{{$kelas->nama_kelas}}">
                            @error('nama_kelas')
                                <small class="text-danger">
                                    {{$message}}
                                </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kompetensi_keahlian" class="control-label sr-only">Kompetensi Keahlian</label>
                            <input type="text" name="kompetensi_keahlian" class="form-control @error('kompetensi_keahlian') border-red @enderror" id="kompetensi_keahlian" placeholder="Ubah kompetensi keahlian" value="{{$kelas->kompetensi_keahlian}}">
                            @error('kompetensi_keahlian')
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
@endsection