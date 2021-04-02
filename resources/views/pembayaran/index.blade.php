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
            <div class="row">
                <form action="{{route('pembayaran.index')}}" class="form-auth-small" method="GET">
                    <div class="col-md-4">
                        <label for="bulan_or_tahun" class="control-label sr-only">Bulan atau Tahun</label>
                        <input type="text" name="bulan_or_tahun" class="form-control" id="bulan_or_tahun" placeholder="Ketikkan bulan atau tahun pembayaran">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-success btn-md">Search</button>
                    </div>
                </form>   
            </div>
            @if (auth()->user()->level == 'admin' || auth()->user()->level == 'petugas')
                <a href="{{route('pembayaran.export')}}">
                    <button type="button" class="btn btn-default mt-quarter"><i class="fa fa-print mr-1"></i> Cetak </button>
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
                        <th>Jumlah Bayar</th>
                        <th>SPP</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        if (isset($filteredPembayaran)) {
                            $pembayaran = $filteredPembayaran;
                        }
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
                            <td>Rp{{number_format($item->jumlah_bayar, 2, ',', '.')}}</td>
                            @if (is_null($item->nisn))
                                <td class="text-danger">Kosong</td>
                            @else
                                <td>Rp{{number_format($item->siswa->spp->nominal, 2, ',', '.')}}</td>
                            @endif
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
                            @elseif (auth()->user()->level == 'siswa')
                                <td>
                                    <a href="{{route('pembayaran.detail', $item->id_pembayaran)}}">
                                        <button class="btn btn-primary"><i class="fa fa-info mr-sm"></i> Detail</button>
                                    </a>
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

