@extends('layouts.app')

@section('tab-title')
    Entri Transaksi Pembayaran
@endsection
@section('page-title')
    <h3 class="page-title">Entri Transaksi Pembayaran</h3>
@endsection
@section('content') 
    <div class="row">
        <div class="col-md-12 mx-auto">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Formulir Entri Transaksi Pembayaran</h3>
                </div>
                <div class="panel-body">
                    <form class="form-auth-small" action="{{route('pembayaran.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="id_petugas" class="control-label sr-only">Petugas</label>
                            @if (auth()->user()->level == 'petugas')
                                <select name="petugas" class="form-control @error('petugas') border-red @enderror" id="id_petugas" placeholder="Pilih petugas" readonly>
                                    <option value="{{auth()->user()->id_petugas}}">{{auth()->user()->petugas->nama_petugas}}</option>
                                </select>
                                @error('petugas')
                                    <small class="text-danger">
                                        {{$message}}
                                    </small>
                                @enderror
                            @else
                                <select name="petugas" class="form-control @error('petugas') border-red @enderror" id="id_petugas" placeholder="Pilih petugas">
                                @if (count($petugas) == 0)
                                    <option>Pilihan tidak tersedia.</option>
                                @else
                                    @foreach ($petugas as $item)
                                        <option value="{{$item->id_petugas}}">{{$item->nama_petugas}}</option>
                                    @endforeach
                                @endif
                                </select>
                                @error('petugas')
                                    <small class="text-danger">
                                        {{$message}}
                                    </small>
                                @enderror
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="nisn" class="control-label sr-only">Siswa</label>
                            <select name="siswa" class="form-control @error('siswa') border-red @enderror" id="nisn" placeholder="Pilih siswa">
                            @if (count($siswa) == 0)
                                <option>Pilihan tidak tersedia.</option>
                            @else
                                @foreach ($siswa as $item)
                                    <option value="{{$item->nisn}}">{{$item->nama}}</option>
                                @endforeach
                            @endif
                            </select>
                            @error('siswa')
                                <small class="text-danger">
                                    {{$message}}
                                </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tgl_bayar" class="control-label sr-only">Tanggal Bayar</label>
                            <input type="date" name="tanggal_pembayaran" class="form-control @error('tanggal_pembayaran') border-red @enderror" id="tgl_bayar" placeholder="Masukkan tanggal pembayaran" value="{{old('tgl_bayar')}}">
                            @error('tanggal_pembayaran')
                                <small class="text-danger">
                                    {{$message}}
                                </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="bulan_dibayar" class="control-label sr-only">Bulan Dibayar</label>
                            <select name="bulan_pembayaran" class="form-control {{session('error-border')}}" id="bulan_dibayar" placeholder="Masukkan bulan pembayaran">
                                <option value="Januari">Januari</option>
                                <option value="Februari">Februari</option>
                                <option value="Maret">Maret</option>
                                <option value="April">April</option>
                                <option value="Mei">Mei</option>
                                <option value="Juni">Juni</option>
                                <option value="Juli">Juli</option>
                                <option value="Agustus">Agustus</option>
                                <option value="September">September</option>
                                <option value="Oktober">Oktober</option>
                                <option value="November">November</option>
                                <option value="Desember">Desember</option>
                            </select>
                            @if (session('custom-message'))
                                <small class="text-danger">
                                    {{session('custom-message')}}
                                </small>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="tahun_dibayar" class="control-label sr-only">Tahun Dibayar</label>
                            <input type="text" name="tahun_pembayaran" class="form-control @if(session('error-border')) {{session('error-border')}} @else @error('tahun_pembayaran') border-red @enderror @endif" id="tahun_dibayar" placeholder="Masukkan tahun pembayaran" value="{{old('tahun_dibayar')}}">
                            @if (session('custom-message'))
                                <small class="text-danger">
                                    {{session('custom-message')}}
                                </small>
                            @else
                                @error('tahun_pembayaran')
                                    <small class="text-danger">
                                        {{$message}}    
                                    </small>
                                @enderror
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="jumlah_bayar" class="control-label sr-only">Jumlah Bayar</label>
                            <input type="text" name="jumlah_pembayaran" class="form-control @error('jumlah_pembayaran') border-red @enderror" id="jumlah_bayar" placeholder="Ketikkan jumlah pembayaran" value="300000" readonly>
                            @error('jumlah_pembayaran')
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