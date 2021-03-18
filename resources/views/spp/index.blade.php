@extends('layouts.app')

@section('tab-title')
    Data SPP
@endsection

@section('page-title')
    <h3 class="page-title">
        <a href="">Data SPP</a>
    </h3>
@endsection

@section('content')
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">Kumpulan Data SPP</h3>
        </div>
        <div class="panel-body">
            <a href="{{route('spp.create')}}">
                <button type="button" class="btn btn-primary"><i class="fa fa-plus-square mr-1"></i> Tambah </button>
            </a>
            <table class="table table-bordered mt-2 text-center">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tahun</th>
                        <th>Nominal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($spp as $item)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$item->tahun}}</td>
                            <td>{{$item->nominal}}</td>
                            <td>
                                <form action="{{route('spp.destroy', $item->id_spp)}}" method="post">
                                    <a href="{{route('spp.edit', $item->id_spp)}}">
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
        </div>
    </div>
@endsection

