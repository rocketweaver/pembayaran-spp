@extends('layouts.app')
@section('tab-title')
    Detail Pembayaran
@endsection
@section('page-title')
    <h3 class="page-title"><a href="{{route('pembayaran.show', auth()->user()->nisn)}}">Riwayat Pembayaran</a> > Detail Pembayaran</h3>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 mx-auto">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Detail</h3>
                </div>
                <div class="panel-body">
                    <p>Nama petugas : <b class="ml-half-1">{{$pembayaran->petugas->nama_petugas}}</b></p>
                    <p>Nama siswa : <b class="ml-half-1">{{$pembayaran->siswa->nama}}</b></p>
                    <p>Tanggal bayar : <b class="ml-half-1">{{$pembayaran->tgl_bayar}}</b></p>
                    <p>Bulan dibayar : <b class="ml-half-1">{{$pembayaran->bulan_dibayar}}</b></p>
                    <p>Tahun dibayar : <b class="ml-half-1">{{$pembayaran->tahun_dibayar}}</b></p>
                    <p>Jumlah bayar : <b class="ml-half-1">Rp{{number_format($pembayaran->jumlah_bayar, 2, ',', '.')}}</b></p>
                    <p>Nominal SPP : <b class="ml-half-1">Rp{{number_format($pembayaran->siswa->spp->nominal, 2, ',', '.')}}</b></p>
                    <p>Tahun SPP : <b class="ml-half-1">{{$pembayaran->siswa->spp->tahun}}</b></p>
                </div>
            </div>
        </div>
    </div>
@endsection