@extends('layouts.app')

@section('tab-title')
    Data Siswa
@endsection

@section('page-title')
    <h3 class="page-title">
        Data Siswa
    </h3>
@endsection

@section('content')
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">Kumpulan Data Siswa</h3>
        </div>
        <div class="panel-body">
            <a href="{{route('siswa.create')}}">
                <button type="button" class="btn btn-primary"><i class="fa fa-plus-square mr-1"></i> Tambah </button>
            </a>
            <table class="table table-bordered mt-2 text-center">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>NISN</th>
                        <th>NIS</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Alamat</th>
                        <th>No. Telepon</th>
                        <th>SPP</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($siswa as $item)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$item->nisn}}</td>
                            <td>{{$item->nis}}</td>
                            <td>{{$item->nama}}</td>
                            <td>{{$item->kelas->nama_kelas}}</td>
                            <td>{{$item->alamat}}</td>
                            <td>{{$item->no_telp}}</td>
                            <td>{{$item->spp->nominal}}</td>
                            <td>
                                <form action="{{route('siswa.destroy', $item->nisn)}}" method="post">
                                    <a href="{{route('siswa.edit', $item->nisn)}}">
                                        <button type="button" class="btn btn-warning"><i class="fa fa-edit mr-sm"></i> Edit</button>
                                    </a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o mr-sm"></i> Hapus</button>
                                </form>
                            </td>
                        </tr>                            
                    @endforeach
                </tbody>
            </table>
            {{$siswa->links()}}
        </div>
    </div>
@endsection

