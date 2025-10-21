@extends('layouts.app')

@section('content')

@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Thêm chapter truyện</div>
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
                    
                    <form method="POST" action="{{route('chapter.store')}}">
                        @csrf
                      <div class="form-group">
                        <label for="exampleInputEmail1">Tên chapter</label>
                        <input type="text" class="form-control" value="{{old('tieude')}}" onkeyup="ChangeToSlug();" name="tieude" id="slug" aria-describedby="emailHelp" placeholder="">
                        
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Slug chapter</label>
                        <input type="text" class="form-control" value="{{old('slug_chapter')}}" name="slug_chapter" id="convert_slug" aria-describedby="emailHelp" placeholder="">
                        
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Tóm tắt chapter</label>
                        <input type="text" class="form-control" value="{{old('tomtat')}}" name="tomtat" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
                        
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Nội dung</label>
                        <textarea name="noidung" id="noidung_chapter" class="form-control" rows="5" style="resize: none"></textarea>
                        
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Thuộc truyện</label>
                         <select name="truyen_id" class="custom-select">
                          @foreach($truyen as $key => $value)
                          <option value="{{$value->id}}">{{$value->tentruyen}}</option>
                          @endforeach
                        </select>
                        
                      </div>

                       <div class="form-group">
                        <label for="exampleInputEmail1">Kích hoạt</label>
                        <select name="kichhoat" class="custom-select">
                          <option value="0">Kích hoạt</option>
                          <option value="1">Không kích hoạt</option>
                        </select>
                        </div>
                     
                      <button type="submit" name="themdanhmuc" class="btn btn-primary">Thêm</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
