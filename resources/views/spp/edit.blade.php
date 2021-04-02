@extends('layouts.app')

@section('tab-title')
    Data Spp - Edit Data
@endsection
@section('page-title')
    <h3 class="page-title"><a href="{{route('spp.index')}}">Data Spp</a> > Edit Data</h3>
@endsection
@section('content') 
    <div class="row">
        <div class="col-md-12 mx-auto">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Formulir Edit Data</h3>
                </div>
                <div class="panel-body">
                    <form class="form-auth-small" action="{{route('spp.update', $spp->id_spp)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nominal" class="control-label sr-only">Nominal</label>
                            <input type="text" name="nominal" class="form-control @error('nominal') border-red @enderror" id="nominal" value="{{$spp->nominal}}" readonly>
                            @error('nominal')
                                <small class="text-danger">
                                    {{$message}}
                                </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tahun" class="control-label sr-only">Tahun</label>
                            <input type="text" name="tahun" class="form-control @error('tahun') border-red @enderror" id="tahun" placeholder="Ubah tahun" value="{{$spp->tahun}}">
                            @error('tahun')
                                <small class="text-danger">
                                    {{$message}}
                                </small>
                            @enderror
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
                    <p>Nominal : <b class="ml-half-1">Rp{{number_format($spp->nominal, 2, ',', '.')}}</b></p>
                    <p>Tahun : <b class="ml-half-1">{{$spp->tahun}}</b></p>
                </div>
            </div>
        </div>
    </div>
@endsection