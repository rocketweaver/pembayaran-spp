@extends('layouts.app')

@section('tab-title')
    Riwayat Pembayaran
@endsection

@section('page-title')
    <h3 class="page-title">
        Riwayat Pembayaran
    </h3>
@endsection

@section('content')
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">Riwayat Pembayaran</h3>
        </div>
        <div class="panel-body">
            @if (auth()->user()->level == 'admin' || auth()->user()->level == 'petugas')
                <a href="{{route('pembayaran.export')}}">
                    <button type="button" class="btn btn-danger"><i class="fa fa-print mr-1"></i> Cetak </button>
                </a>
            @endif
            <table class="table table-bordered mt-2 text-center">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Petugas</th>
                        <th>Nama Siswa</th>
                        <th>Tanggal Pembayaran</th>
                        <th>Bulan Dibayar</th>
                        <th>Tahun Dibayar</th>
                        <th>SPP</th>
                        <th>Total Pembayaran</th>
                        @if (auth()->user()->level == 'admin' || auth()->user()->level == 'petugas')
                            <th>Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($pembayaran as $item)
                        <tr>
                            <td>{{$i++}}</td>
                            @if (is_null($item->id_petugas))
                                <td class="text-danger">Kosong</td>
                            @else
                                <td>{{$item->petugas->nama_petugas}}</td>
                            @endif
                            @if (is_null($item->nisn))
                                <td class="text-danger">Kosong</td>
                            @else
                                <td>{{$item->siswa->nama}}</td>
                            @endif
                            <td>{{$item->tgl_bayar}}</td>
                            <td>{{$item->bulan_dibayar}}</td>
                            <td>{{$item->tahun_dibayar}}</td>
                            @if (is_null($item->nisn))
                                <td class="text-danger">Kosong</td>
                            @else
                                <td>{{$item->siswa->spp->nominal}}</td>
                            @endif
                            <td>{{$item->jumlah_bayar}}</td>
                            @if (auth()->user()->level == 'admin' || auth()->user()->level == 'petugas')
                                <td>
                                    <form action="{{route('pembayaran.destroy', $item->id_pembayaran)}}" method="post">
                                        <a href="{{route('pembayaran.edit', $item->id_pembayaran)}}">
                                            <button type="button" class="btn btn-warning"><i class="fa fa-edit mr-sm"></i> Edit</button>
                                        </a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o mr-sm"></i> Hapus</button>
                                    </form>  
                                </td>
                            @endif
                        </tr>                            
                    @endforeach
                </tbody>
            </table>
            {{$pembayaran->links()}}
        </div>
    </div>
@endsection

