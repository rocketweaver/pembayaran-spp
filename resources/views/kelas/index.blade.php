@extends('layouts.app')

@section('tab-title')
    Data Kelas
@endsection

@section('page-title')
    <h3 class="page-title">
        Data Kelas
    </h3>
@endsection

@section('content')
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">Kumpulan Data Kelas</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <form action="{{route('kelas.index')}}" class="form-auth-small" method="GET">
                    <div class="col-md-2">
                        <label for="nama_kelas" class="control-label sr-only">Nama Kelas</label>
                        <input type="text" name="nama_kelas" class="form-control" id="nama_kelas" placeholder="Ketikkan nama kelas">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-success btn-md">Mencari</button>
                    </div>
                </form>   
            </div>
            <a href="{{route('kelas.create')}}">
                <button type="button" class="btn btn-primary mt-quarter"><i class="fa fa-plus-square mr-1"></i> Tambah </button>
            </a>
            <table class="table table-bordered mt-2 text-center">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Kelas</th>
                        <th>Kompetensi Keahlian</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        if (isset($filteredKelas)) {
                            $kelas = $filteredKelas;
                        }
                        $i = 1;
                    @endphp
                    @foreach ($kelas as $item)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$item->nama_kelas}}</td>
                            <td>{{$item->kompetensi_keahlian}}</td>
                            <td>
                                <form action="{{route('kelas.destroy', $item->id_kelas)}}" method="post">
                                    <a href="{{route('kelas.edit', $item->id_kelas)}}">
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
            {{$kelas->links()}}
        </div>
    </div>
@endsection

