@extends('layouts.app')

@section('tab-title')
    Data Siswa - Tambah Data
@endsection
@section('page-title')
    <h3 class="page-title"><a href="{{route('siswa.index')}}">Data Siswa</a> > Tambah Data</h3>
@endsection
@section('content') 
    <div class="row">
        <div class="col-md-12 mx-auto">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Formulir Tambah Data</h3>
                </div>
                <div class="panel-body">
                    <form class="form-auth-small" action="{{route('siswa.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nisn" class="control-label sr-only">NISN</label>
                            <input type="text" name="nisn" class="form-control @error('nisn') border-red @enderror" id="nisn" placeholder="Ketikkan NISN" value="{{old('nisn')}}">
                            @error('nisn')
                                <small class="text-danger">
                                    {{$message}}
                                </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nis" class="control-label sr-only">NIS</label>
                            <input type="text" name="nis" class="form-control @error('nis') border-red @enderror" id="nis" placeholder="Ketikkan NIS" value="{{old('nis')}}">
                            @error('nis')
                                <small class="text-danger">
                                    {{$message}}
                                </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nama" class="control-label sr-only">Nama Siswa</label>
                            <input type="text" name="nama" class="form-control @error('nama') border-red @enderror" id="nama" placeholder="Ketikkan nama siswa" value="{{old('nama')}}">
                            @error('nama')
                                <small class="text-danger">
                                    {{$message}}
                                </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="id_kelas" class="control-label sr-only">Kelas</label>
                            <select type="text" name="id_kelas" class="form-control @error('kelas') border-red @enderror" id="id_kelas" placeholder="Pilih kelas" value="{{old('id_kelas')}}">
                            @if (count($kelas) == 0)
                                <option>Pilihan tidak tersedia.</option>
                            @else
                                @foreach ($kelas as $item)
                                    <option value="{{$item->id_kelas}}">{{$item->nama_kelas}}</option>
                                @endforeach
                            @endif
                            </select>
                            @error('id_kelas')
                                <small class="text-danger">
                                    {{$message}}
                                </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="alamat" class="control-label sr-only">Alamat</label>
                            <textarea name="alamat" class="form-control @error('alamat') border-red @enderror" id="alamat" rows="4" placeholder="Ketikkan alamat lengkap" value="{{old('alamat')}}"></textarea>
                            @error('alamat')
                                <small class="text-danger">
                                    {{$message}}
                                </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="no_telp" class="control-label sr-only">Nomor Telepon</label>
                            <input name="no_telp" class="form-control @error('no_telp') border-red @enderror" id="no_telp" placeholder="Ketikkan nomor telepon" value="{{old('no_telp')}}">
                            @error('no_telp')
                                <small class="text-danger">
                                    {{$message}}
                                </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="id_spp" class="control-label sr-only">SPP</label>
                            <select name="id_spp" class="form-control @error('id_spp') border-red @enderror" id="id_spp" placeholder="Pilih SPP" value="{{old('id_spp')}}">
                                @if (count($spp) == 0)
                                    <option>Pilihan tidak tersedia.</option>
                                @else
                                    @foreach ($spp as $item)
                                        <option value="{{$item->id_spp}}">{{$item->nominal}}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('id_spp')
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