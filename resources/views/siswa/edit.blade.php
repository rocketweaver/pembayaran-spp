@extends('layouts.app')

@section('tab-title')
    Data Siswa - Edit Data
@endsection
@section('page-title')
    <h3 class="page-title"><a href="{{route('siswa.index')}}">Data Siswa</a> > Edit Data</h3>
@endsection
@section('content') 
    <div class="row">
        <div class="col-md-12 mx-auto">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Formulir Edit Data</h3>
                </div>
                <div class="panel-body">
                    <form class="form-auth-small" action="{{route('siswa.update', $siswa->nisn)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nisn" class="control-label sr-only">NISN</label>
                            <input type="text" name="nisn" class="form-control @error('nisn') border-red @enderror" id="nisn" placeholder="Ketikkan NISN" value="{{$siswa->nisn}}">
                            @error('nisn')
                                <small class="text-danger">
                                    {{$message}}
                                </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nis" class="control-label sr-only">NIS</label>
                            <input type="text" name="nis" class="form-control @error('nis') border-red @enderror" id="nis" placeholder="Ketikkan NIS" value="{{$siswa->nis}}">
                            @error('nis')
                                <small class="text-danger">
                                    {{$message}}
                                </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nama" class="control-label sr-only">Nama Siswa</label>
                            <input type="text" name="nama" class="form-control @error('nama') border-red @enderror" id="nama" placeholder="Ketikkan nama siswa" value="{{$siswa->nama}}">
                            @error('nama')
                                <small class="text-danger">
                                    {{$message}}
                                </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="id_kelas" class="control-label sr-only">Kelas</label>
                            <select type="text" name="id_kelas" class="form-control" id="id_kelas" placeholder="Pilih kelas">
                            @if (count($kelas) == 0)
                                <option>Pilihan tidak tersedia.</option>
                            @else
                                <option value="" disabled selected>Pilih kelas</option>
                                @foreach ($kelas as $item)
                                    <option value="{{$item->id_kelas}}">{{$item->nama_kelas}}</option>
                                @endforeach
                            @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="alamat" class="control-label sr-only">Alamat</label>
                            <textarea name="alamat" class="form-control @error('alamat') border-red @enderror" id="alamat" rows="4" placeholder="Ketikkan alamat lengkap">{{$siswa->alamat}}</textarea>
                            @error('alamat')
                                <small class="text-danger">
                                    {{$message}}
                                </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="no_telp" class="control-label sr-only">Nomor Telepon</label>
                            <input name="nomor_telepon" class="form-control @error('nomor_telepon') border-red @enderror" id="no_telp" placeholder="Ketikkan nomor telepon" value="{{$siswa->no_telp}}">
                            @error('nomor_telpon')
                                <small class="text-danger">
                                    {{$message}}
                                </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="id_spp" class="control-label sr-only">SPP</label>
                            <select name="id_spp" class="form-control" id="id_spp" placeholder="Pilih SPP">
                                @if (count($spp) == 0)
                                    <option>Pilihan tidak tersedia.</option>
                                @else
                                    <option value="" disabled selected>Pilih SPP</option>
                                    @foreach ($spp as $item)
                                        <option value="{{$item->id_spp}}">{{$item->tahun}}</option>
                                    @endforeach
                                @endif
                            </select>
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
                    <p>Nama siswa : <b class="ml-half-1">{{$siswa->nama}}</b></p>
                    <p>NISN : <b class="ml-half-1">{{$siswa->nisn}}</b></p>
                    <p>NIS: <b class="ml-half-1">{{$siswa->nis}}</b></p>
                    <p>Kelas: <b class="ml-half-1">{{$siswa->kelas->nama_kelas}}</b></p>
                    <p>Alamat : <b class="ml-half-1">{{$siswa->alamat}}</b></p>
                    <p>No. Telepon : <b class="ml-half-1">{{$siswa->no_telp}}</b></p>
                    <p>Nominal SPP : <b class="ml-half-1">{{$siswa->spp->nominal}}</b></p>
                    <p>Tahun SPP : <b class="ml-half-1">{{$siswa->spp->tahun}}</b></p>
                </div>
            </div>
        </div>
    </div>
@endsection