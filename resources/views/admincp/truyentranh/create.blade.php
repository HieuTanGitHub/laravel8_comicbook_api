@extends('layouts.app')



@section('content')



@include('layouts.nav')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card">

                <div class="card-header">Thêm truyện tranh</div>
                

                @if ($errors->any())

                    <div class="alert alert-danger">

                        <ul>

                            @foreach ($errors->all() as $error)

                                <li>{{ $error }}</li>

                            @endforeach

                        </ul>

                    </div>

                @endif

                <div class="card-body">

                    @if (session('status'))

                        <div class="alert alert-success" role="alert">

                            {{ session('status') }}

                        </div>

                    @endif

                    

                    <form method="POST" action="{{route('truyentranh.store')}}" enctype='multipart/form-data'>

                        @csrf

                      <div class="form-group">

                        <label for="exampleInputEmail1">Tên truyện</label>

                        <input type="text" class="form-control" value="{{old('tentruyen')}}" onkeyup="ChangeToSlug();" name="tentruyen" id="slug" aria-describedby="emailHelp" placeholder="Tên truyện">

                        

                      </div>
                      <div class="form-group">

                        <label for="exampleInputEmail1">Lượt xem</label>

                        <input type="text" class="form-control" value="{{old('views')}}" name="views"  aria-describedby="emailHelp" placeholder="Tên truyện">

                        

                      </div>

                       <div class="form-group">

                        <label for="exampleInputEmail1">Từ khóa</label>

                        <input type="text" data-role="tagsinput" class="form-control" value="{{old('tukhoa')}}" name="tukhoa"  aria-describedby="emailHelp" placeholder="">

                        

                      </div>

                      <div class="form-group">

                        <label for="exampleInputEmail1">Tác giả</label>

                        <input type="text" class="form-control" value="{{old('tacgia')}}" name="tacgia" aria-describedby="emailHelp" placeholder="Tác giả">

                        

                      </div>

                      <div class="form-group">

                        <label for="exampleInputEmail1">Slug truyện</label>

                        <input type="text" class="form-control" value="{{old('slug_truyen')}}" name="slug_truyen" id="convert_slug" aria-describedby="emailHelp" placeholder="Slug truyện...">

                        

                      </div>

                      <div class="form-group">

                        <label for="exampleInputEmail1">Tóm tắt truyện</label>

                        <textarea name="tomtat" id="ckeditor_truyen" class="form-control" rows="5" style="resize: none"></textarea>

              

                      </div>
                      <label for="exampleInputEmail1">Danh mục truyện</label>
                      @foreach($danhmuc as $key => $muc)
                      <div class="form-check">
                          
                          <input class="form-check-input" name="danhmuc[]" type="checkbox" id="danhmuc_{{$muc->id}}" value="{{$muc->id}}">
                          <label class="form-check-label" for="danhmuc_{{$muc->id}}">{{$muc->tendanhmuc}}</label>
                         
                      </div>
                       @endforeach

                      <label for="exampleInputEmail1">Thể loại</label>
                      @foreach($theloai as $key => $the)
                      <div class="form-check">
                          
                          <input class="form-check-input" name="theloai[]" type="checkbox" id="theloai_{{$the->id}}" value="{{$the->id}}">
                          <label class="form-check-label" for="theloai_{{$the->id}}">{{$the->tentheloai}}</label>
                         
                      </div>
                       @endforeach
                     {{--  <div class="form-group">

                        <label for="exampleInputEmail1">Danh mục truyện</label>

                        <select name="danhmuc" class="custom-select">

                          @foreach($danhmuc as $key => $muc)

                          <option value="{{$muc->id}}">{{$muc->tendanhmuc}}</option>

                          @endforeach

                        </select>

                      </div>
 --}}
                     {{--   <div class="form-group">

                        <label for="exampleInputEmail1">Thể loại truyện</label>

                        <select name="theloai" class="custom-select">

                          @foreach($theloai as $key => $the)

                          <option value="{{$the->id}}">{{$the->tentheloai}}</option>

                          @endforeach

                        </select>

                      </div> --}}

                      <div class="form-group">

                        <label for="exampleInputEmail1">Hình ảnh truyện</label>

                        <input type="file" class="form-control-file" name="hinhanh">

                        

                      </div>

                       <div class="form-group">

                        <label for="exampleInputEmail1">Kích hoạt</label>

                        <select name="kichhoat" class="custom-select">

                          <option value="0">Kích hoạt</option>

                          <option value="1">Không kích hoạt</option>

                        </select>

                        </div>

                     

                      <button type="submit" name="themtruyen" class="btn btn-primary">Thêm</button>

                    </form>

                    

                </div>

            </div>

        </div>

    </div>

</div>

@endsection

