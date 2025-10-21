@extends('layouts.app')

@section('content')

@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Liệt kê chapter truyện tranh</div>

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
                          <th scope="col">Tên chapter</th>
                          <th scope="col">Slug chapter</th>
                          <th scope="col">Tóm tắt</th>
                          <th scope="col">Thuộc Truyện</th>
                          <th scope="col">Kích hoạt</th>
                          <th scope="col">Quản lý</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($chapter as $key => $chap)
                        <tr>
                          <th scope="row">{{$key}}</th>
                          <td>{{$chap->tieude}}</td>
                          <td><a href="{{url('/chapter_truyentranh/'.$chap->slug_chapter)}}">{{$chap->slug_chapter}}</a></td>
                          <td>{{$chap->tomtat}}</td>
                          <td>{{$chap->truyen->tentruyen}}</td>
                          <td>
                              @if($chap->kichhoat==0)
                                <span class="text text-success">Kích hoạt</span> 
                              @else
                                <span class="text text-danger">Không Kích hoạt</span> 
                              @endif

                          </td>
                          <td>
                                <a href="{{route('chaptertranh.edit',[$chap->id])}}" class="btn btn-primary ">Edit</a>

                              <form action="{{route('chaptertranh.destroy',[$chap->id])}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button onclick="return confirm('Bạn muốn xóa chapter truyện này không?');" class="btn btn-danger">Delete</button>
                                  
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
