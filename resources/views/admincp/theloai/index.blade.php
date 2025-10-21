@extends('layouts.app')

@section('content')

@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Liệt kê thể loại truyện</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Tên</th>
                          <th scope="col">Hình ảnh</th>
                          <th scope="col">Slug</th>
                          <th scope="col">Mô tả</th>
                          <th scope="col">Kích hoạt</th>
                          <th scope="col">Quản lý</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($theloai as $key => $loai)
                        <tr>
                          <th scope="row">{{$key}}</th>
                          <td>{{$loai->tentheloai}}</td>
                          <td>  <img src="{{asset('public/uploads/theloai/'.$loai->hinhanh)}}" height="250" width="180">  </td>
                          <td>{{$loai->slug_theloai}}</td>
                          <td>{{$loai->mota}}</td>
                          <td>
                              @if($loai->kichhoat==0)
                                <span class="text text-success">Kích hoạt</span> 
                              @else
                                <span class="text text-danger">Không Kích hoạt</span> 
                              @endif

                          </td>
                          <td>
                                <a href="{{route('theloai.edit',[$loai->id])}}" class="btn btn-primary ">Edit</a>

                              <form action="{{route('theloai.destroy',[$loai->id])}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button onclick="return confirm('Bạn muốn xóa thể loại truyện này không?');" class="btn btn-danger">Delete</button>
                                  
                              </form>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
