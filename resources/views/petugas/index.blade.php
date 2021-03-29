@extends('layouts.app')

@section('tab-title')
    Data Petugas
@endsection

@section('page-title')
    <h3 class="page-title">
        Data Petugas
    </h3>
@endsection

@section('content')
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">Kumpulan Data Petugas</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <form action="{{route('petugas.index')}}" class="form-auth-small" method="GET">
                    <div class="col-md-2">
                        <label for="nama_or_level" class="control-label sr-only">Nama Kelas</label>
                        <input type="text" name="nama_or_level" class="form-control" id="nama_or_level" placeholder="Ketikkan nama atau level petugas">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-success btn-md">Search</button>
                    </div>
                </form>   
            </div>
            <a href="{{route('petugas.create')}}">
                <button type="button" class="btn btn-primary mt-quarter"><i class="fa fa-plus-square mr-1"></i> Tambah </button>
            </a>
            <table class="table table-bordered mt-2 text-center">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Nama Petugas</th>
                        <th>Level</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        if (isset($filteredPetugas)) {
                            $petugas = $filteredPetugas;
                        }
                        $i = 1;
                    @endphp
                    @foreach ($petugas as $item)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$item->username}}</td>
                            <td>{{$item->password}}</td>
                            <td>{{$item->nama_petugas}}</td>
                            <td>{{$item->level}}</td>
                            <td>
                                <form action="{{route('petugas.destroy', $item->id_petugas)}}" method="post">
                                    <a href="{{route('petugas.edit', $item->id_petugas)}}">
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
            {{$petugas->links()}}
        </div>
    </div>
@endsection

