@extends('sb-admin/app')

@section('content')

@section('judul','form edit')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">@yield('judul')</h1>
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
</div>
<div class="row">
      <div class="container">
             @if (session('status'))
                <div class="alert alert-primary">{{session('status')}}</div>
                @endif

                <form action="{{route('update',$datas->id)}}" method="POST">
    @csrf
    @method('PUT')
        <div class="row mb-3">
            <label for="judul_buku" class="col-sm-2 col-form-label">Pilih Gambar</label>
            <div class="col-sm-10">
            <input type="file" class="form-control-file" id="gambar" name="gambar"  value="{{$datas->gambar}}">
            </div>
        </div>
    
        <div class="row mb-3">
            <label for="judul_buku" class="col-sm-2 col-form-label">Judul</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="judul" name="judul"  value="{{$datas->judul}}">
            </div>
        </div>
        <div class="row mb-3">
            <label for="deskripsi" class="col-sm-2 col-form-label">Content</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="conten" name="conten"  value="{{$datas->conten}}">
            </div>
        </div>
       
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
</div>
        
        
@endsection