@extends('layouts.app')

@section('tab-title')
    Data SPP - Tambah Data
@endsection
@section('page-title')
    <h3 class="page-title"><a href="{{route('spp.index')}}">Data SPP</a> > Tambah Data</h3>
@endsection
@section('content') 
    <div class="row">
        <div class="col-md-12 mx-auto">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Formulir Tambah Data</h3>
                </div>
                <div class="panel-body">
                    <form class="form-auth-small" action="{{route('spp.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nominal" class="control-label sr-only">Nominal</label>
                            <input type="text" name="nominal" class="form-control" id="nominal" value="3600000" readonly>
                        </div>
                        <div class="form-group">
                            <label for="tahun" class="control-label sr-only">Tahun</label>
                            <input type="text" name="tahun" class="form-control @error('tahun') border-red @enderror" id="tahun" placeholder="Ketikkan tahun" value="{{old('tahun')}}">
                            @error('tahun')
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