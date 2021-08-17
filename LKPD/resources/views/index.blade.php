@extends('sb-admin/app')

@section('content')

@section('judul','Data')

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
      @if(auth()->user()->role == "admin")
        <a href="/tambah" class="btn btn-primary mb-5"><i class="fas fa-plus mr-2"></i>Tambah</a>
      @endif
          <div class="row justify-content-center">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Content</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                     @foreach ($datas as $no => $data)
                      <tr>
                        <th Scope="col">{{$no+1}}</th>
                        <td><img src="{{ asset('/images/'.$data->gambar) }}" width="100" alt=""></td>
                        <td>{{$data->judul}}</td>
                        <td>{{$data->conten}}</td>
                        <td>
                        <a href="{{route('edit',$data->id)}}" class="btn btn-block btn-warning btn-sm mb-2 mt-2 "><i class="fas fa-edit"></i></a>
                        <form action="/delete{{$data->id}}" method="post">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-block btn-danger btn-sm" >
                              <i class="far fa-trash-alt">  </i>
                          </button>
                      </form>
                      </td>
                    @endforeach 
                  </tr>
                </tbody>
                </table>
          </div>
        </div>
    
@endsection